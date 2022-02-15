<?php

declare(strict_types=1);

namespace Dal\Repositories;

use Dal\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface
{
    /**
     * @param int $id
     *
     * @return Collection
     */
    public function getCategoryProducts(int $id): Collection;

    /**
     * @param int $id
     *
     * @return Category|null
     */
    public function getCategory(int $id): ?Category;

    /**
     *
     * @return Collection
     */
    public function getAllCategories(): Collection;

    /**
     * @param array $category
     *
     * @return Category|null
     */
    public function createCategory(array $category): ?Category;

    /**
     * @param int $categoryId
     * @param array $category
     *
     * @return bool
     */
    public function updateCategory(int $categoryId, array $category): bool;

    /**
     * @param int $categoryId
     *
     * @return bool
     */
    public function deleteCategory(int $categoryId): bool;
}
