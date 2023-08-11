<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageObject extends Model
{
    use HasFactory;

    protected $table = 'objects';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'page_id',
        'sentence_id',
        'zone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['pivot'];

    /**
     * Get the objectes for the page.
    */
    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id', 'id');
    }

    /**
     * Get the objectes for the sentence.
    */
    public function sentence()
    {
        return $this->belongsTo(Sentence::class, 'sentence_id', 'id');
    }
}
