<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    const ADMIN = 0;
    const SUPERVISEUR = 1;
    const AGENT = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'firstname', 'lastname', 'gender', 'age', 'role', 'phone'
    ];

 
    protected $username = 'name';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function missions()
    {
        return $this->hasMany(App\Models\Mission::class);
    }

    public function files()
    {
        return $this->hasMany(App\Models\File::class);
    }

    public function tasks()
    {
        return $this->hasMany(App\Models\UsersTask::class);
    }

    public function locations()
    {
        return $this->hasMany(App\Models\Location::class);
    }

    public function sent_messages()
    {
        return $this->hasMany(App\Models\Messages::class, 'author_id');
    }

    public function received_messages()
    {
        return $this->hasMany(App\Models\Messages::class, 'receiver_id');
    }
}
