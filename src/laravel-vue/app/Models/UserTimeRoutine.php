<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTimeRoutine extends Model
{
    public $timestamps = false;
    protected $table = "user_routines";
    protected $fillable = ["user_id","group_id","name","start","end","repeat_time","description"];
}
