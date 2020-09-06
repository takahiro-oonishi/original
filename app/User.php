<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    public function followings(){
        return $this->belongsToMany(User::class,'user_follow','user_id','follow_id')->withTimestamps();
    }

    public function followers(){
        return $this->belongsToMany(User::class,'user_follow','follow_id','user_id')->withTimestamps();
    }

    public function is_following($userId){
        return $this->followings()->where('follow_id',$userId)->exists();
    }

    public function follow($userId){
        
        $exist=$this->is_following($userId);
        $its_me= $this->id==$userId; 

        if($exist || $its_me){
            return false;
        }else{
            $this->followings()->attach($userId);
            return true;
        }
    }

    public function unfollow($userId){
        
        $exist=$this->is_following($userId);
        $its_me= $this->id==$userId; 

        if($exist && !$its_me){  
            $this->followings()->detach($userId);
            return true;
        }else{
            return false;
        }
    }

    public function feed_tweets(){
        $follow_user_ids = $this->followings()->pluck('users.id')->toArray();
        
        $follow_user_ids[] = $this->id;

        return Tweet::whereIn('user_id',$follow_user_ids); 
    }


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


}
