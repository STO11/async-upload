<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PeoplePhone extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['person_id', 'phone'];

    protected $table = 'people_phones';

}