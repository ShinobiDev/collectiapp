<?php

namespace App\Services;

use App\Models\Category;
use App\DTOs\Category\CategoryDTO;

class CategoryService
{
    public function getAll()
    {
        return Category::all();
    }

    public function getById($id)
    {
        return Category::find($id);
    }

    public function createFromDTO(CategoryDTO $dto)
    {
        try {
            $category = Category::create([
                'name' => $dto->name,
            ]);
            return $category;
        } catch (\Exception $e) {
            throw new \Exception('Error al crear el estado: ' . $e->getMessage());
        }
    }

    public function updateFromDTO(CategoryDTO $dto, Category $category)
    {
        try {
            $category->update([
                'name' => $dto->name,
            ]);
            return $category;
        } catch (\Exception $e) {
            throw new \Exception('Error al actualizar el estado: ' . $e->getMessage());
        }
    }

    public function delete(Category $category)
    {
        try {
            $category->delete();
            return true;
        } catch (\Exception $e) {
            throw new \Exception('Error al eliminar el estado: ' . $e->getMessage());
        }
    }
}
