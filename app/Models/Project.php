<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $with = ['category'];

    /**
     * Get the category of the project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo category
     */
    public function category() {
        return $this->belongsTo(Category::class);
    }
}
