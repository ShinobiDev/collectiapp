<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\User\StoreUserRequest;  // Request para validaciones
use App\Models\User;
use App\Services\UserService;
use App\DTOs\User\UserDTO;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        try {
            $users = $this->userService->getAll();
            return response()->json(['success' => true, 'data' => $users]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $user = $this->userService->getById($id);
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'Usuario no encontrado.'], 404);
            }
            return response()->json(['success' => true, 'data' => $user]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $dto = new UserDTO(
                null,
                $request->validated()['name'],
                $request->validated()['type_document_id'],
                $request->validated()['document'],
                $request->validated()['email'],
                $request->validated()['password'],
                $request->validated()['birthday'],
                $request->validated()['role_id'],
                $request->validated()['status_id']
            );
            $user = $this->userService->createFromDTO($dto);
            return response()->json(['success' => true, 'message' => 'Usuario creado correctamente.', 'data' => $user], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function update(StoreUserRequest $request, $id)
    {
        try {
            $user = $this->userService->getById($id);
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'Usuario no encontrado.'], 404);
            }
            $dto = new UserDTO(
                $user->id,
                $request->validated()['name'],
                $request->validated()['type_document_id'],
                $request->validated()['document'],
                $request->validated()['email'],
                $request->validated()['password'],
                $request->validated()['birthday'],
                $request->validated()['role_id'],
                $request->validated()['status_id']
            );
            $updatedUser = $this->userService->updateFromDTO($dto, $user);
            return response()->json(['success' => true, 'message' => 'Usuario actualizado correctamente.', 'data' => $updatedUser]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $user = $this->userService->getById($id);
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'Usuario no encontrado.'], 404);
            }
            $this->userService->delete($user);
            return response()->json(['success' => true, 'message' => 'Usuario eliminado correctamente.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}
