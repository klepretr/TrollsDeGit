<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'start_date', 'end_date', 'state', 'user_id'
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
    	return $this->belongsToMany(User::class);
    }

    public function stuffs()
    {
    	return $this->belongsToMany(App\Models\Stuff::class);
    }

    public function report()
    {
    	return $this->hasOne(Report::class);
    }

    public function tasks()
    {
    	return $this->hasMany(App\Models\MissionsTask::class);
    }
}
