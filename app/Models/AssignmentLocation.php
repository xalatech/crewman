<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignmentLocation extends Model
{
    protected $fillable = ['country'];

    public function assignment() {
        return $this->belongsTo(Assignment::class);
    }
}
