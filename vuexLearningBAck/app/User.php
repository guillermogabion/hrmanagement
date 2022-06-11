<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'profile_picture'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile_picture(){
        return $this->hasOne(User::class);
    }
    public function designation(){
        return $this->hasMany(Designation::class);
    }

    public function attendance(){
        return $this->hasMany(Attendance::class, 'user_id');
    }
    

    public function getProfilePictureAttribute($value){
       
        if($value){
            return asset('images/user_profile/'. $value);
        }else {
            return 'https://tnsleepteam.com/wp-content/uploads/2016/10/placeholder_profile_male.jpg' ;
        }
    }
}
