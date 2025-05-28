<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['user_id', 'patient_id', 'date', 'time','status', 'visit_type','note'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    protected $casts = [
        'date' => 'date',
    ];

}
