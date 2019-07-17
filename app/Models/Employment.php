<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employment extends Model
{
    protected $fillable = ['title', 'description', 'start_date', 'end_date', 'current'];

    public function employee() {
        return $this->belongsToMany(Employee::class);
    }

    public function employer() {
        return $this->belongsToMany(Employer::class);
    }
}
