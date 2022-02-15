<?php

declare(strict_types=1);

namespace Dal\Repositories;

use Dal\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAllProducts(): Collection;

    /**
     * @param string $id
     *
     * @return Product|null
     */
    public function getProduct(string $id): ?Product;

    /**
     * @param array $product
     *
     * @return Product|null
     */
    public function createProduct(array $product): ?Product;

    /**
     * @param int $productId
     * @param array $product
     *
     * @return bool
     */
    public function updateProduct(int $productId, array $product): bool;

    /**
     * @param int $productId
     *
     * @return bool
     */
    public function deleteProduct(int $productId): bool;
}
