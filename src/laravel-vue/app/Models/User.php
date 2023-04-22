<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function permissions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Company::class,'company_permissions')->withPivot('permission');
    }

    public function settings() {
        return $this->hasone(UserSettings::class,'user_id','id');
    }

    public function TimeDate() {
        return $this->hasMany(UserTimeDate::class,'user_id','id');
    }

    public function TimeRoutine() {
        return $this->hasMany(UserTimeRoutine::class,'user_id','id');
    }

    public function TimeGroups() {
        return $this->hasMany(UserTimeGroups::class,'user_id','id');
    }

    public function CompanyFavourite() {
        return $this->hasMany(UserCompanyFavourite::class,"user_id","id");
    }
}
