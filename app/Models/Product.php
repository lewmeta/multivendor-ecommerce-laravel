<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    /**
     * Many to many relationship with Category model.
     * - A product can belong to multiple categories.
     * - A category can have multiple products.
     * 
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class,);
    }

    /**
     * Many to many relationship with Tag model.
     * - A product can have multiple tags.
     * - A tag can be associated with multiple products.
     * 
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
