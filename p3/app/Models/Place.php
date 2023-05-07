<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    # Place belongs to City many-to-one
    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    # Places belong to many Users
    public function users()
    {
        return $this->belongsToMany('App\Models\User')
            ->withTimestamps();
    }

    public static function findBySlug($slug)
    {
        return self::where('slug', '=', $slug)->first();
    }
}