<?php

namespace App\Services;

use App\Models\Status;
use App\DTOs\Status\StatusDTO;

class StatusService
{
    public function getAll()
    {
        return Status::all();
    }

    public function getById($id)
    {
        return Status::find($id);
    }

    public function createFromDTO(StatusDTO $dto)
    {
        try {
            $status = Status::create([
                'name' => $dto->name,
            ]);
            return $status;
        } catch (\Exception $e) {
            throw new \Exception('Error al crear el estado: ' . $e->getMessage());
        }
    }

    public function updateFromDTO(StatusDTO $dto, Status $status)
    {
        try {
            $status->update([
                'name' => $dto->name,
            ]);
            return $status;
        } catch (\Exception $e) {
            throw new \Exception('Error al actualizar el estado: ' . $e->getMessage());
        }
    }

    public function delete(Status $status)
    {
        try {
            $status->delete();
            return true;
        } catch (\Exception $e) {
            throw new \Exception('Error al eliminar el estado: ' . $e->getMessage());
        }
    }
}
