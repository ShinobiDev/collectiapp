<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreStatusRequest;  // Controlador de validaciones
use App\Models\Status;
use App\Services\StatusService;
use App\DTOs\Status\StatusDTO;

class StatusController extends Controller
{
    protected $statusService;

    public function __construct(StatusService $statusService)
    {
        $this->statusService = $statusService;
    }

    public function index()
    {
        try {
            $statuses = $this->statusService->getAll();
            return response()->json(['success' => true, 'data' => $statuses]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $status = $this->statusService->getById($id);
            if (!$status) {
                return response()->json(['success' => false, 'message' => 'Estado no encontrado.'], 404);
            }
            return response()->json(['success' => true, 'data' => $status]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function store(StoreStatusRequest $request)
    {
        try {
            // La validación ya se hizo en StoreStatusRequest
            $dto = new StatusDTO($request->validated()['name']);
            $status = $this->statusService->createFromDTO($dto);
            return response()->json(['success' => true, 'message' => 'Estado creado correctamente.', 'data' => $status], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function update(StoreStatusRequest $request, $id)
    {
        try {
            $status = $this->statusService->getById($id);
            if (!$status) {
                return response()->json(['success' => false, 'message' => 'Estado no encontrado.'], 404);
            }
            $dto = new StatusDTO($status->id, $request->validated()['name']);
            $updatedStatus = $this->statusService->updateFromDTO($dto, $status);
            return response()->json(['success' => true, 'message' => 'Estado actualizado correctamente.', 'data' => $updatedStatus]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $status = $this->statusService->getById($id);
            if (!$status) {
                return response()->json(['success' => false, 'message' => 'Estado no encontrado.'], 404);
            }
            $this->statusService->delete($status);
            return response()->json(['success' => true, 'message' => 'Estado eliminado correctamente.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}
