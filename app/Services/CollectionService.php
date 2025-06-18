<?php

namespace App\Services;

use App\Models\Collection;
use App\DTOs\Collection\CollectionDTO;

class CollectionService
{
    public function getAll()
    {
        return Collection::all();
    }

    public function getById($id)
    {
        return Collection::find($id);
    }

    public function createFromDTO(CollectionDTO $dto)
    {
        try {
            $collection = Collection::create([
                'name' => $dto->name,
                'category_id' => $dto->category_id,
                'gender_id' => $dto->gender_id,
                'author_id' => $dto->author_id,
                'editorial_id' => $dto->editorial_id,
                'date' => $dto->date,
            ]);
            return $collection;
        } catch (\Exception $e) {
            throw new \Exception('Error al crear la colección: ' . $e->getMessage());
        }
    }

    public function updateFromDTO(CollectionDTO $dto, Collection $collection)
    {
        try {
            $collection->update([
                'name' => $dto->name,
                'category_id' => $dto->category_id,
                'gender_id' => $dto->gender_id,
                'author_id' => $dto->author_id,
                'editorial_id' => $dto->editorial_id,
                'date' => $dto->date,
            ]);
            return $collection;
        } catch (\Exception $e) {
            throw new \Exception('Error al actualizar la colección: ' . $e->getMessage());
        }
    }

    public function delete(Collection $collection)
    {
        try {
            $collection->delete();
            return true;
        } catch (\Exception $e) {
            throw new \Exception('Error al eliminar la colección: ' . $e->getMessage());
        }
    }
}
