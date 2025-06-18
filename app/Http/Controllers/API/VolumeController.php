<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Volume\StoreVolumeRequest;
use App\Services\VolumeService;
use App\DTOs\Volume\VolumeDTO;

class VolumeController extends Controller
{
    protected $volumeService;

    public function __construct(VolumeService $volumeService)
    {
        $this->volumeService = $volumeService;
    }

    public function index()
    {
        try {
            $volumes = $this->volumeService->getAll();
            return response()->json(['success' => true, 'data' => $volumes]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $volume = $this->volumeService->getById($id);
            if (!$volume) {
                return response()->json(['success' => false, 'message' => 'Volumen no encontrado.'], 404);
            }
            return response()->json(['success' => true, 'data' => $volume]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function store(StoreVolumeRequest $request)
    {
        try {
            $dto = new VolumeDTO(
                null,
                $request->validated()['name'],
                $request->validated()['collection_id']
            );
            $volume = $this->volumeService->createFromDTO($dto);
            return response()->json(['success' => true, 'message' => 'Volumen creado correctamente.', 'data' => $volume], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function update(StoreVolumeRequest $request, $id)
    {
        try {
            $volume = $this->volumeService->getById($id);
            if (!$volume) {
                return response()->json(['success' => false, 'message' => 'Volumen no encontrado.'], 404);
            }
            $dto = new VolumeDTO(
                $volume->id,
                $request->validated()['name'],
                $request->validated()['collection_id']
            );
            $updatedVolume = $this->volumeService->updateFromDTO($dto, $volume);
            return response()->json(['success' => true, 'message' => 'Volumen actualizado correctamente.', 'data' => $updatedVolume]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $volume = $this->volumeService->getById($id);
            if (!$volume) {
                return response()->json(['success' => false, 'message' => 'Volumen no encontrado.'], 404);
            }
            $this->volumeService->delete($volume);
            return response()->json(['success' => true, 'message' => 'Volumen eliminado correctamente.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}
