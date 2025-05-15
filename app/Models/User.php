<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{


    public function patients(){
        $this->hasMany(Patient::class);
    }
}
