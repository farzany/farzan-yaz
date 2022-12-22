<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $with = ['category'];

    /**
     * Get how long a post takes to read.
     *
     * @return int minutes
     */
    public function getReadDuration() {
        $estimatedTotalWords = str_word_count(strip_tags($this->body));
        $minutesToRead = round($estimatedTotalWords / 200);

        return (int)max(1, $minutesToRead);
    }

    /**
     * Get the category of the post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo category
     */
    public function category() {
        return $this->belongsTo(Category::class);
    }
}
