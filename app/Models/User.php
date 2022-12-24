<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
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
        'two_factor_type',
        'phone_number',
        'user_role',
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


    public function hasTwoFactor($key){
        return $this->two_factor_type == $key;
    }


    public function activeCode(){
        return $this->hasMany(ActiveCode::class);
    }

    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }

    public function isSuperAdmin(){
        return $this->user_role == 'administrator';
    }

    public function isTwoFactorAuthenticationEnable(){
        return $this->two_factor_type !== 'off';
    }

    public function isSmsTwoFactorAuthenticationEnable(){
        return $this->two_factor_type == 'sms';
    }

//    public function permissions()
//    {
//        return $this->belongsToMany(Permission::class);
//    }

//    public function roles()
//    {
//        return $this->belongsToMany(Role::class);
//    }
//
//    public function hasRole($roles)
//    {
//        return !! $roles->intersect( $this->roles )->all();
//    }
//    public function hasPermission($permission)
//    {
//        return $this->permissions->contains('name', $permission->name) || $this->hasRole($permission->roles);
//    }
}
