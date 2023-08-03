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
        'created_user',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    
    /*
    * Get the pages for the story.
    */
    public function pages()
    {
        return $this->hasManyThrough(Sentence::class, Page::class, 'story_id', 'page_id', 'id', 'id');
        // return $this->hasMany(Page::class, 'story_id', 'id');
    }
}