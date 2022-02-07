<?php

declare(strict_types=1);

namespace Dal\Models;

use Database\Factories\ProductCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * @inheritdoc
     */
    protected $table = 'products';

    /**
     * @inheritdoc
     */
    protected $guarded = ['id'];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return new ProductCategory();
    }
    /**
     * Get the category of the product
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
