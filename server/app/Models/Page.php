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
        'background_url',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['pivot'];

    /**
     * Get page's story.
    */
    public function story()
    {
        return $this->belongsTo(Story::class, 'story_id', 'id');
    }

    /**
     * Get all page's sentences.
    */
    public function sentences()
    {
        return $this->belongsToMany(
            Sentence::class,
            SentenceConfig::class,
            'page_id',
            'sentence_id',
            'id',
            'id'
        );
    }

    /**
     * Get all page's objects.
    */
    public function objects()
    {
        return $this->belongsToMany(
            Sentence::class,
            PageObject::class,
            'page_id',
            'sentence_id',
            'id',
            'id'
        );
    }
}
