<?php

namespace App\Services;

use App\Models\User;
use App\DTOs\User\UserDTO;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function getAll()
    {
        return User::all();
    }

    public function getById($id)
    {
        return User::find($id);
    }

    public function createFromDTO(UserDTO $dto)
    {
        try {
            $user = User::create([
                'name' => $dto->name,
                'type_document_id' => $dto->type_document_id,
                'document' => $dto->document,
                'email' => $dto->email,
                'password' => Hash::make($dto->password), // Encripta la contraseña
                'birthday' => $dto->birthday,
                'role_id' => $dto->role_id,
                'status_id' => $dto->status_id,
            ]);
            return $user;
        } catch (\Exception $e) {
            throw new \Exception('Error al crear el usuario: ' . $e->getMessage());
        }
    }

    public function updateFromDTO(UserDTO $dto, User $user)
    {
        try {
            $user->update([
                'name' => $dto->name,
                'type_document_id' => $dto->type_document_id,
                'document' => $dto->document,
                'email' => $dto->email,
                'password' => Hash::make($dto->password), // Encripta la contraseña
                'birthday' => $dto->birthday,
                'role_id' => $dto->role_id,
                'status_id' => $dto->status_id,
            ]);
            return $user;
        } catch (\Exception $e) {
            throw new \Exception('Error al actualizar el usuario: ' . $e->getMessage());
        }
    }

    public function delete(User $user)
    {
        try {
            $user->delete();
            return true;
        } catch (\Exception $e) {
            throw new \Exception('Error al eliminar el usuario: ' . $e->getMessage());
        }
    }
}
