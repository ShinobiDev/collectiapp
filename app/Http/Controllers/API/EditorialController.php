<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Editorial\StoreEditorialRequest;
use App\Http\Requests\Editorial\UpdateEditorialRequest;
use App\Models\Editorial;
use App\Services\EditorialService;
use App\DTOs\Editorial\EditorialDTO;

class EditorialController extends Controller
{
    protected $editorialService;

    public function __construct(EditorialService $editorialService)
    {
        $this->editorialService = $editorialService;
    }

    public function index()
    {
        try {
            $editoriales = $this->editorialService->getAll();
            return response()->json(['success' => true, 'data' => $editoriales]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $editorial = $this->editorialService->getById($id);
            if (!$editorial) {
                return response()->json(['success' => false, 'message' => 'Editorial no encontrada.'], 404);
            }
            return response()->json(['success' => true, 'data' => $editorial]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function store(StoreEditorialRequest $request)
    {
        try {
            // La validación ya se hizo en StoreEditorialRequest
            $dto = new EditorialDTO(null, $request->validated()['name']);
            $editorial = $this->editorialService->createFromDTO($dto);
            return response()->json(['success' => true, 'message' => 'Editorial creada correctamente.', 'data' => $editorial], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function update(UpdateEditorialRequest $request, $id)
    {
        try {
            $editorial = $this->editorialService->getById($id);
            if (!$editorial) {
                return response()->json(['success' => false, 'message' => 'Editorial no encontrada.'], 404);
            }
            $dto = new EditorialDTO($editorial->id, $request->validated()['name']);
            $updatedEditorial = $this->editorialService->updateFromDTO($dto, $editorial);
            return response()->json(['success' => true, 'message' => 'Editorial actualizada correctamente.', 'data' => $updatedEditorial]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $editorial = $this->editorialService->getById($id);
            if (!$editorial) {
                return response()->json(['success' => false, 'message' => 'Editorial no encontrada.'], 404);
            }
            $this->editorialService->delete($editorial);
            return response()->json(['success' => true, 'message' => 'Editorial eliminado correctamente.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}
