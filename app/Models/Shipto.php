<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipto extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['order_id','name','address','city','country'];

    protected $table = 'shiptos';

}