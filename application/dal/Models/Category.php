<?php

declare(strict_types=1);

namespace Dal\Models;

use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    /**
     * @inheritdoc
     */
    protected $table = 'categories';

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
        return new CategoryFactory();
    }

    /**
     * Get products associated with particular category
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
