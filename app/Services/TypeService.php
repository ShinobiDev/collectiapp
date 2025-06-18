<?php

namespace App\Services;

use App\Models\Type;
use App\DTOs\Type\TypeDTO;

class TypeService
{
    public function getAll()
    {
        return Type::all();
    }

    public function getById($id)
    {
        return Type::find($id);
    }

    public function createFromDTO(TypeDTO $dto)
    {
        try {
            $type = Type::create([
                'name' => $dto->name,
            ]);
            return $type;
        } catch (\Exception $e) {
            throw new \Exception('Error al crear el tipo: ' . $e->getMessage());
        }
    }

    public function updateFromDTO(TypeDTO $dto, Type $type)
    {
        try {
            $type->update([
                'name' => $dto->name,
            ]);
            return $type;
        } catch (\Exception $e) {
            throw new \Exception('Error al actualizar el tipo: ' . $e->getMessage());
        }
    }

    public function delete(Type $type)
    {
        try {
            $type->delete();
            return true;
        } catch (\Exception $e) {
            throw new \Exception('Error al eliminar el tipo: ' . $e->getMessage());
        }
    }
}
