<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StuffsLocation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'latitude', 'longitude', 'stuff_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    public function stuff()
    {
    	return $this->belongsTo(App\Models\Stuff::class);
    }
}
