<?php

namespace App\Services;

use App\Models\Gender;
use App\DTOs\Gender\GenderDTO;

class GenderService
{
    public function getAll()
    {
        return Gender::all();
    }

    public function getById($id)
    {
        return Gender::find($id);
    }

    public function createFromDTO(GenderDTO $dto)
    {
        try {
            $gender = Gender::create([
                'name' => $dto->name,
            ]);
            return $gender;
        } catch (\Exception $e) {
            throw new \Exception('Error al crear el estado: ' . $e->getMessage());
        }
    }

    public function updateFromDTO(GenderDTO $dto, Gender $gender)
    {
        try {
            $gender->update([
                'name' => $dto->name,
            ]);
            return $gender;
        } catch (\Exception $e) {
            throw new \Exception('Error al actualizar el estado: ' . $e->getMessage());
        }
    }

    public function delete(Gender $gender)
    {
        try {
            $gender->delete();
            return true;
        } catch (\Exception $e) {
            throw new \Exception('Error al eliminar el estado: ' . $e->getMessage());
        }
    }
}
