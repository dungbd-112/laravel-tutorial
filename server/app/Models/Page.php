<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'story_id',
        'page_number',
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

    /**
     * Get the sentences for the page.
    */
    public function sentences()
    {
        return $this->hasMany(Sentence::class, 'page_id', 'id');
    }

    /**
     * Get the objects for the page.
    */
    public function objects()
    {
        return $this->hasMany(PageObject::class, 'page_id', 'id');
    }

    /**
     * Get page's story.
    */
    public function story()
    {
        return $this->belongsTo(Story::class, 'story_id', 'id');
    }
}