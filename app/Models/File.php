<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url', 'title', 'uploaded_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    public function report()
    {
    	return $this->belongsTo(App\Models\Report::class);
    }

    public function user()
    {
    	return $this->belongsTo(App\Models\User::class);
    }

}
