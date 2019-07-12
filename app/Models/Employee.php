<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = [];
    protected $fillable = ['osma_id', 'firstname', 'lastname'];

}
