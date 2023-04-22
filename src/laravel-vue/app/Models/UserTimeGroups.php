<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTimeGroups extends Model
{
    public $timestamps = false;
    protected $fillable = ["user_id","name","color"];
    protected $table = "user_time_groups";
}