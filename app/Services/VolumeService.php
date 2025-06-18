<?php

namespace App\Services;

use App\Models\Volume;
use App\DTOs\Volume\VolumeDTO;

class VolumeService
{
    public function getAll()
    {
        return Volume::all();
    }

    public function getById($id)
    {
        return Volume::find($id);
    }

    public function createFromDTO(VolumeDTO $dto)
    {
        try {
            $volume = Volume::create([
                'name' => $dto->name,
                'collection_id' => $dto->collection_id,
            ]);
            return $volume;
        } catch (\Exception $e) {
            throw new \Exception('Error al crear el volumen: ' . $e->getMessage());
        }
    }

    public function updateFromDTO(VolumeDTO $dto, Volume $volume)
    {
        try {
            $volume->update([
                'name' => $dto->name,
                'collection_id' => $dto->collection_id,
            ]);
            return $volume;
        } catch (\Exception $e) {
            throw new \Exception('Error al actualizar el volumen: ' . $e->getMessage());
        }
    }

    public function delete(Volume $volume)
    {
        try {
            $volume->delete();
            return true;
        } catch (\Exception $e) {
            throw new \Exception('Error al eliminar el volumen: ' . $e->getMessage());
        }
    }
}
