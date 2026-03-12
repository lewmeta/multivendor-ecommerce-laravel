<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    /**
     * Get the images related to this product
     * 
     * @return @illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('order');
    }

    /**
     * Get the attributes related to this product
     * 
     * @return BelongsToMany
     */
    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class, 'product_attribute_values')->withPivot('attribute_value_id');
    }

    /**
     * Get the attributeValues related to this product
     * 
     * @return BelongsToMany
     */
    public function attributeValues(): BelongsToMany
    {
        return $this->belongsToMany(AttributeValue::class, 'product_attribute_values')->withPivot('attribute_id');
    }

    /**
     * Get the attribute with their values related to this product
     * 
     * @return BelongsToMany
     */
    public function attributesWithValues(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class, 'product_attribute_values')
            ->distinct()
            ->orderBy('id', 'asc')
            ->with(['values' => function ($query) {
                $query->wherein('id', function ($subquery) {
                    $subquery->select('attribute_value_id')
                        ->from('product_attribute_values')
                        ->where('product_id', $this->id)
                        ->orderBy('id', 'asc');
                });
            }]);
    }

    /**
     * Get the variants associated with this product
     * 
     * @return HasMany
     */
    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }
}
