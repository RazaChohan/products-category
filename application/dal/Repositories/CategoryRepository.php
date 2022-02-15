<?php

declare(strict_types=1);

namespace Dal\Repositories;

use Dal\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function __construct(private Category $category) {}

    /**
     * @inheritdoc
     */
    public function getCategoryProducts(int $id): Collection
    {
        $category = $this->category->with('products')->find($id);

        return $category->products ?? new Collection();
    }

    /**
     * @param int $id
     *
     * @return Category|null
     */
    public function getCategory(int $id): ?Category
    {
        return $this->category->find($id);
    }

    /**
     * @inheritdoc
     */
    public function getAllCategories(): Collection
    {
        return $this->category->all();
    }

    /**
     * @inheritdoc
     */
    public function createCategory(array $category): ?Category
    {
        $category = $this->category->create($category);

        return $category ?? null;
    }

    /**
     * @inheritdoc
     */
    public function updateCategory(int $categoryId, array $category): bool
    {
        return $this->category->where('id', $categoryId)->update($category) > 0;
    }

    /**
     * @inheritdoc
     */
    public function deleteCategory(int $categoryId): bool
    {
        return $this->category->where('id', $categoryId)->delete() > 0;

    }
}
