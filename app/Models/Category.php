<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'position',
        'image',
        'icon',
        'is_featured',
        'is_active',
    ];

    /**
     * Get the parent category.
     * - A category may belong to a parent category.
     * - If parent_id is null, it is a top-level category.
     * - This defines an inverse one-to-many relationship.
     * 
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Get the child categories.
     * - A category may have multiple child categories.
     * - This defines a one-to-many relationship.
     * 
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Get nested categories recursively.
     * 
     * @param int|null $parentId
     * @param int $depth
     * @param int $maxDepth
     * @return array
     */
    static function getNested($parentId = null, $depth = 0, $maxDepth = 3)
    {
        if ($depth >= $maxDepth) return [];
        $categories = self::where('parent_id', $parentId)->orderBy('position')->get();

        foreach ($categories as $cat) {
            $cat->children_nested = self::getNested($cat->id, $depth + 1, $maxDepth);
        }

        return $categories;
    }
}
