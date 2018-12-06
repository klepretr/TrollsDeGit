<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersTask extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'start_date', 'end_date', 'user_id'
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
    	return $this->belongsTo(App\Models\User::class);
    }
}
