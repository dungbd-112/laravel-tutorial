<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'thumbnail_url',
        'bonus',
        'created_user',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * Get the user that created the story.
    */
    public function created_user()
    {
        return $this->belongsTo(User::class, 'created_user', 'id');
    }

    /*
    * Get the pages for the story.
    */
    public function pages()
    {
        return $this->hasMany(Page::class, 'story_id', 'id');
    }
}