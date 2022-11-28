<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * Get how long a post takes to read.
     *
     * @return int minutes
     */
    public function getReadDuration() {
        $estimatedTotalWords = str_word_count($this->body);
        $minutesToRead = round($estimatedTotalWords / 200);

        return (int)max(1, $minutesToRead);
    }
}
