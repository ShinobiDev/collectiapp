<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Author\StoreAuthorRequest;
use App\Http\Requests\Author\UpdateAuthorRequest;
use App\Models\Author;
use App\Services\AuthorService;
use App\DTOs\Author\AuthorDTO;

class AuthorController extends Controller
{
    protected $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    public function index()
    {
        try {
            $authores = $this->authorService->getAll();
            return response()->json(['success' => true, 'data' => $authores]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $author = $this->authorService->getById($id);
            if (!$author) {
                return response()->json(['success' => false, 'message' => 'Estado no encontrado.'], 404);
            }
            return response()->json(['success' => true, 'data' => $author]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function store(StoreAuthorRequest $request)
    {
        try {
            // La validación ya se hizo en StoreAuthorRequest
            $dto = new AuthorDTO(
                null,
                $request->validated()['name'],
                $request->validated()['birthday']
            );
            $author = $this->authorService->createFromDTO($dto);
            return response()->json(['success' => true, 'message' => 'Estado creado correctamente.', 'data' => $author], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function update(UpdateAuthorRequest $request, $id)
    {
        try {
            $author = $this->authorService->getById($id);
            if (!$author) {
                return response()->json(['success' => false, 'message' => 'Estado no encontrado.'], 404);
            }
            $dto = new AuthorDTO($author->id, $request->validated()['name']);
            $updatedAuthor = $this->authorService->updateFromDTO($dto, $author);
            return response()->json(['success' => true, 'message' => 'Estado actualizado correctamente.', 'data' => $updatedAuthor]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $author = $this->authorService->getById($id);
            if (!$author) {
                return response()->json(['success' => false, 'message' => 'Estado no encontrado.'], 404);
            }
            $this->authorService->delete($author);
            return response()->json(['success' => true, 'message' => 'Estado eliminado correctamente.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}
