<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sentence extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'content',
        'audio_url',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['pivot'];

    /**
     * Get the page for the sentence.
    */
    public function objects()
    {
        return $this->hasMany(PageObject::class, 'sentence_id', 'id');
    }

    /**
     * Get the page for the sentence.
    */
    public function sentenceConfigs()
    {
        return $this->hasMany(SentenceConfig::class, 'sentence_id', 'id');
    }
}
