<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author_id', 'receiver_id', 'content'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    public function author()
    {
    	return $this->belongsTo('App\Models\User', 'author_id');
    }

    public function receiver()
    {
    	return $this->belongsTo('App\Models\User', 'receiver_id');
    }
}
