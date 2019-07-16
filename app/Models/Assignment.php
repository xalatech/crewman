<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = ['title, description'];

    public function employment() {
        return $this->belongsTo(Employment::class);
    }

    public function assignmentRoles() {
        return $this->hasMany(AssignmentRole::class);
    }

    public function assignmentLeaves() {
        return $this->hasMany(AssignmentLeave::class);
    }
}
