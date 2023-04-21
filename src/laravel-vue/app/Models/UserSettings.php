<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSettings extends Model
{
    protected $table = "user_settings";
    protected $fillable = ["user_id","lang","theme"];
    public $timestamps = false;
    protected $primaryKey = "user_id";
}
