<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function author()
    {
        # Book belongs to Author
        # Define an inverse one-to-many relationship.
        Return $this->belongsTo('App\Models\Author');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User')
        ->withTimestamps() # Must be added to have Eloquent update the created_at/updated_at columns in a join/pivot table
        ->withPivot('notes'); # Must also specify any other fields that should be included when fetching this relationship
    }

    /**
     * 
     */
    public static function findBySlug($slug)
    {
        return self::where('slug', '=', $slug)->first();
    }

}