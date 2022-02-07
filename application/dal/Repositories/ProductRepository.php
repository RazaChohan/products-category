<?php

declare(strict_types=1);

namespace Dal\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Dal\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function __construct(private Product $product) {}

    /**
     * @inheritdoc
     */
    public function getAllProducts(): Collection
    {
        return $this->product->with('category:id,name')->get();
   }

    /**
     * @inheritdoc
     */
    public function getProduct(string $id): ?Product
    {
        return $this->product->find($id);
    }

    /**
     * @inheritdoc
     */
    public function createProduct(array $product): ?Product
    {
        $product = $this->product->create($product);

        return $product ?? null;
    }

    /**
     * @inheritdoc
     */
    public function updateProduct(int $productId, array $product): bool
    {
        return $this->product->where('id', $productId)->update($product) > 0;
    }

    /**
     * @inheritdoc
     */
    public function deleteProduct(int $productId): bool
    {
        return $this->product->where('id', $productId)->delete() > 0;
    }
}
