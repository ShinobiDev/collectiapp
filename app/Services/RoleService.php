<?php

namespace App\Services;

use App\Models\Role;
use App\DTOs\Role\RoleDTO;

class RoleService
{
    public function getAll()
    {
        return Role::all();
    }

    public function getById($id)
    {
        return Role::find($id);
    }

    public function createFromDTO(RoleDTO $dto)
    {
        try {
            $role = Role::create([
                'name' => $dto->name,
            ]);
            return $role;
        } catch (\Exception $e) {
            throw new \Exception('Error al crear el tipo: ' . $e->getMessage());
        }
    }

    public function updateFromDTO(RoleDTO $dto, Role $role)
    {
        try {
            $role->update([
                'name' => $dto->name,
            ]);
            return $role;
        } catch (\Exception $e) {
            throw new \Exception('Error al actualizar el tipo: ' . $e->getMessage());
        }
    }

    public function delete(Role $role)
    {
        try {
            $role->delete();
            return true;
        } catch (\Exception $e) {
            throw new \Exception('Error al eliminar el tipo: ' . $e->getMessage());
        }
    }
}
