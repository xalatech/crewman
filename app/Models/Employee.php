<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['osma_id', 'firstname', 'lastname'];

    public function employments() {
        return $this->hasMany(Employment::class);
    }
}
