<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignmentRole extends Model
{
    protected $fillable = ['title, description', 'start_date', 'end_date', 'role_type'];

    public function assignment() {
        return $this->belongsTo(Assignment::class);
    }
}
