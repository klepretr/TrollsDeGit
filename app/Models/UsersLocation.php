<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersLocation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'latitude', 'longitude', 'user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
