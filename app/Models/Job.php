<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'user_id', 'title', 'description', 'link_id',
    ];

    public function skills()
    {
        return $this->hasMany('App\Models\Skill');
    }

    public function user(){
    	return $this->belongsTo('App\Models\User');
    }
}
