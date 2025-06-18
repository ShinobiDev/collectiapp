<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Gender\StoreGenderRequest;
use App\Http\Requests\Gender\UpdateGenderRequest;
use App\Models\Gender;
use App\Services\GenderService;
use App\DTOs\Gender\GenderDTO;

class GenderController extends Controller
{
    protected $genderService;

    public function __construct(GenderService $genderService)
    {
        $this->genderService = $genderService;
    }

    public function index()
    {
        try {
            $genderes = $this->genderService->getAll();
            return response()->json(['success' => true, 'data' => $genderes]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $gender = $this->genderService->getById($id);
            if (!$gender) {
                return response()->json(['success' => false, 'message' => 'Género no encontrado.'], 404);
            }
            return response()->json(['success' => true, 'data' => $gender]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function store(StoreGenderRequest $request)
    {
        try {
            // La validación ya se hizo en StoreGenderRequest
            $dto = new GenderDTO(null, $request->validated()['name']);
            $gender = $this->genderService->createFromDTO($dto);
            return response()->json(['success' => true, 'message' => 'Género creado correctamente.', 'data' => $gender], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function update(UpdateGenderRequest $request, $id)
    {
        try {
            $gender = $this->genderService->getById($id);
            if (!$gender) {
                return response()->json(['success' => false, 'message' => 'Género no encontrado.'], 404);
            }
            $dto = new GenderDTO($gender->id, $request->validated()['name']);
            $updatedGender = $this->genderService->updateFromDTO($dto, $gender);
            return response()->json(['success' => true, 'message' => 'Género actualizado correctamente.', 'data' => $updatedGender]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $gender = $this->genderService->getById($id);
            if (!$gender) {
                return response()->json(['success' => false, 'message' => 'Género no encontrado.'], 404);
            }
            $this->genderService->delete($gender);
            return response()->json(['success' => true, 'message' => 'Género eliminado correctamente.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}
