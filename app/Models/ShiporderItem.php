<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShiporderItem extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['order_id', 'title','note','quantity','price'];

    protected $table = 'shiporder_itens';

}