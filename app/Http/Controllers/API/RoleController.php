<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Models\Role;
use App\Services\RoleService;
use App\DTOs\Role\RoleDTO;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index()
    {
        try {
            $Rolees = $this->roleService->getAll();
            return response()->json(['success' => true, 'data' => $Rolees]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $Role = $this->roleService->getById($id);
            if (!$Role) {
                return response()->json(['success' => false, 'message' => 'Estado no encontrado.'], 404);
            }
            return response()->json(['success' => true, 'data' => $Role]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function store(StoreRoleRequest $request)
    {
        try {
            // La validación ya se hizo en StoreRoleRequest
            $dto = new RoleDTO($request->validated()['name']);
            $Role = $this->roleService->createFromDTO($dto);
            return response()->json(['success' => true, 'message' => 'Estado creado correctamente.', 'data' => $Role], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function update(UpdateRoleRequest $request, $id)
    {
        try {
            $Role = $this->roleService->getById($id);
            if (!$Role) {
                return response()->json(['success' => false, 'message' => 'Estado no encontrado.'], 404);
            }
            $dto = new RoleDTO($Role->id, $request->validated()['name']);
            $updatedRole = $this->roleService->updateFromDTO($dto, $Role);
            return response()->json(['success' => true, 'message' => 'Estado actualizado correctamente.', 'data' => $updatedRole]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $Role = $this->roleService->getById($id);
            if (!$Role) {
                return response()->json(['success' => false, 'message' => 'Estado no encontrado.'], 404);
            }
            $this->roleService->delete($Role);
            return response()->json(['success' => true, 'message' => 'Estado eliminado correctamente.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}
