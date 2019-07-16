<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignmentLeave extends Model
{
    protected $fillable = ['description', 'start_date', 'end_date'];

    public function assignment() {
        return $this->belongsTo(Assignment::class);
    }
}
