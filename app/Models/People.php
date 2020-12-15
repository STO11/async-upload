<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class People extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['person_id','person_name'];

    protected $table = 'peoples';

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

    public function phones() {
        return $this->hasMany('App\Models\PeoplePhone','person_id','person_id');
    } 

    //run jobs in table | --once = kill job
    public function runWork() {
        @shell_exec("cd /var/www && nohup php artisan queue:work --once > /dev/null 2>&1 &");
    }

    public function scopeFilter($query, $input){
        if(isset($input['person_name']) && $input['person_name']) {
            $query->where('person_name', 'like','%'.$input['person_name'].'%');
        }

        if(isset($input['person_id']) && $input['person_id']) {
            $query->where('person_id',$input['person_id']);
        }
        return $query;
    }
}