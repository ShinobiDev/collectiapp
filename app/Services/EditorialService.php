<?php

namespace App\Services;

use App\Models\Editorial;
use App\DTOs\Editorial\EditorialDTO;

class EditorialService
{
    public function getAll()
    {
        return Editorial::all();
    }

    public function getById($id)
    {
        return Editorial::find($id);
    }

    public function createFromDTO(EditorialDTO $dto)
    {
        try {
            $editorial = Editorial::create([
                'name' => $dto->name,
            ]);
            return $editorial;
        } catch (\Exception $e) {
            throw new \Exception('Error al crear el estado: ' . $e->getMessage());
        }
    }

    public function updateFromDTO(EditorialDTO $dto, Editorial $editorial)
    {
        try {
            $editorial->update([
                'name' => $dto->name,
            ]);
            return $editorial;
        } catch (\Exception $e) {
            throw new \Exception('Error al actualizar el estado: ' . $e->getMessage());
        }
    }

    public function delete(Editorial $editorial)
    {
        try {
            $editorial->delete();
            return true;
        } catch (\Exception $e) {
            throw new \Exception('Error al eliminar el estado: ' . $e->getMessage());
        }
    }
}
