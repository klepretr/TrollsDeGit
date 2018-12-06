<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MissionsTask extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'start_date', 'end_date', 'mission_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    public function mission()
    {
    	return $this->belongsTo(App\Models\Mission::class);
    }
}
