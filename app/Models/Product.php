<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'price', 'stock', 'image', 'category_id'];

    /**
     * Một sản phẩm (Product) thuộc về (belongsTo) một danh mục (Category)
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

     protected function isNew(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->created_at->gt(now()->subDays(7)),
        );
    }
}