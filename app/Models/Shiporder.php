<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shiporder extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['order_id','person_id'];

    //public $timestamps = false;

    public function moveFile($file) {
        try
        {
            if(is_array($file)) {
                $file = reset($file);
                $path = storage_path( 'app/public' );
                $nameFile = $file->getClientOriginalName();
                @$file->move($path, $nameFile);
                return  $path . '/' . $nameFile;
            }
            return false;
        }catch(\Exception $error) 
        {
            return false;
        }
    }

    public function checkExtension($file) {
        $file = reset($file);
        $extension = $file->getClientOriginalExtension();
        if($extension != 'xml')
            return false;
        return true;
    }


    public function person() {
        return $this->belongsTo('App\Models\People', 'person_id','person_id');
    }

    public function itens() {
        return $this->hasMany('App\Models\ShiporderItem', 'order_id','order_id');
    }

    public function shipto() {
        return $this->belongsTo('App\Models\Shipto', 'order_id','order_id');
    }

     //run jobs in table | --once = kill job
     public function runWork() {
        @shell_exec("cd /var/www && nohup php artisan queue:work --once > /dev/null 2>&1 &");
    }

    /* FIX BUGS IN FILE LINE 36 -> <itens> not close, correcty -> </itens> */
    public function resolveErrorLine36TagNoClosed($upload) {
        libxml_use_internal_errors(true);
        $xml = @simplexml_load_file($upload);
        $errors = libxml_get_errors();
        foreach ($errors as $error) {
            if (strpos($error->message, 'Opening and ending tag mismatch')!==false) {
                $tag   = trim(preg_replace('/Opening and ending tag mismatch: (.*) line.*/', '$1', $error->message));
                $lines = file($upload, FILE_IGNORE_NEW_LINES);
                $line  = $error->line-1;
                $lines[$line - 1] = str_replace("<$tag>","</$tag>",$lines[$line - 1]);
                file_put_contents($upload, implode("\n", $lines));
            }
        }
    }

    public function scopeFilter($query, $input){
        if(isset($input['order_id']) && $input['order_id']) {
            $query->where('order_id',$input['order_id']);
        }
        if(isset($input['person_id']) && $input['person_id']) {
            $query->where('person_id',$input['person_id']);
        }

        if(isset($input['node']) && $input['node']) {
            $query->where('itens.node', 'like','%'.$input['node'].'%');
        }

        // if(isset($input['node']) && $input['node']) {
        //     $query->where('node', 'like','%'.$input['node'].'%');
        // }

        // if(isset($input['order_id']) && $input['order_id']) {
        //     $query->where('order_id',$input['order_id']);
        // }

        return $query;
    }

}