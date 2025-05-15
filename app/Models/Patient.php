<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    public function patient()
    {
        return $this->hasOne(MedicalRecord::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
