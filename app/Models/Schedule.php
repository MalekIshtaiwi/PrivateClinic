<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    // I had to use protected $table here because the table in the db does not follow the naming convention for laravel ORM
    protected $table = "schedule";

    protected $guarded = [];
    public $timestamps = false;
}
