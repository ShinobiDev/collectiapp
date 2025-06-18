<?php

namespace App\Services;

use App\Models\Author;
use App\DTOs\Author\AuthorDTO;

class AuthorService
{
    public function getAll()
    {
        return Author::all();
    }

    public function getById($id)
    {
        return Author::find($id);
    }

    public function createFromDTO(AuthorDTO $dto)
    {
        try {
            $author = Author::create([
                'name' => $dto->name,
                'birthday' => $dto->birthday, // Incluye this
            ]);
            return $author;
        } catch (\Exception $e) {
            throw new \Exception('Error al crear el estado: ' . $e->getMessage());
        }
    }

    public function updateFromDTO(AuthorDTO $dto, Author $author)
    {
        try {
            $author->update([
                'name' => $dto->name,
            ]);
            return $author;
        } catch (\Exception $e) {
            throw new \Exception('Error al actualizar el estado: ' . $e->getMessage());
        }
    }

    public function delete(Author $author)
    {
        try {
            $author->delete();
            return true;
        } catch (\Exception $e) {
            throw new \Exception('Error al eliminar el estado: ' . $e->getMessage());
        }
    }
}
