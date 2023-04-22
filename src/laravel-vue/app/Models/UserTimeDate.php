<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTimeDate extends Model
{
    public $timestamps = false;
    protected $table = "user_dates";
    protected $fillable = ["user_id","group_id","name","start","end","description"];

    public function group() {
        return $this->hasOne(UserTimeGroups::class,'id','group_id');
    }
}
