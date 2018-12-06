<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mission_id', 'content'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function files()
    {
        return $this->hasMany(App\Models\Report::class);
    }

    public function mission()
    {
    	return $this->belongsTo(App\Models\Mission::class);
    }
}
