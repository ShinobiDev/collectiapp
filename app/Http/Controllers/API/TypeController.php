<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Type\StoreTypeRequest;
use App\Http\Requests\Type\UpdateTypeRequest;
use App\Models\Type;
use App\Services\TypeService;
use App\DTOs\Type\TypeDTO;

class TypeController extends Controller
{
    protected $typeService;

    public function __construct(TypeService $typeService)
    {
        $this->typeService = $typeService;
    }

    public function index()
    {
        try {
            $typees = $this->typeService->getAll();
            return response()->json(['success' => true, 'data' => $typees]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $type = $this->typeService->getById($id);
            if (!$type) {
                return response()->json(['success' => false, 'message' => 'Tipo no encontrado.'], 404);
            }
            return response()->json(['success' => true, 'data' => $type]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function store(StoreTypeRequest $request)
    {
        try {
            // La validación ya se hizo en StoreTypeRequest
            $dto = new TypeDTO(
                null, // id, si aún no existe
                $request->validated()['name'],
                $request->validated()['type_parent_id'] ?? null // si no está definido, será null
            );
            $type = $this->typeService->createFromDTO($dto);
            return response()->json(['success' => true, 'message' => 'Tipo creado correctamente.', 'data' => $type], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function update(UpdateTypeRequest $request, $id)
    {
        try {
            $type = $this->typeService->getById($id);
            if (!$type) {
                return response()->json(['success' => false, 'message' => 'Tipo no encontrado.'], 404);
            }
            $dto = new TypeDTO(
                $type->id,
                $request->validated()['name'],
                $request->validated()['type_parent_id'] ?? null
            );
            $updatedType = $this->typeService->updateFromDTO($dto, $type);
            return response()->json(['success' => true, 'message' => 'Tipo actualizado correctamente.', 'data' => $updatedType]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $type = $this->typeService->getById($id);
            if (!$type) {
                return response()->json(['success' => false, 'message' => 'Tipo no encontrado.'], 404);
            }
            $this->typeService->delete($type);
            return response()->json(['success' => true, 'message' => 'Tipo eliminado correctamente.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}
