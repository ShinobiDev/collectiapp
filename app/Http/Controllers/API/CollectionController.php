<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Collection\StoreCollectionRequest;
use App\Services\CollectionService;
use App\DTOs\Collection\CollectionDTO;

class CollectionController extends Controller
{
    protected $collectionService;

    public function __construct(CollectionService $collectionService)
    {
        $this->collectionService = $collectionService;
    }

    public function index()
    {
        try {
            $collections = $this->collectionService->getAll();
            return response()->json(['success' => true, 'data' => $collections]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $collection = $this->collectionService->getById($id);
            if (!$collection) {
                return response()->json(['success' => false, 'message' => 'Colección no encontrada.'], 404);
            }
            return response()->json(['success' => true, 'data' => $collection]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function store(StoreCollectionRequest $request)
    {
        try {
            $dto = new CollectionDTO(
                null,
                $request->validated()['name'],
                $request->validated()['category_id'],
                $request->validated()['gender_id'],
                $request->validated()['author_id'],
                $request->validated()['editorial_id'],
                $request->validated()['date']
            );
            $collection = $this->collectionService->createFromDTO($dto);
            return response()->json(['success' => true, 'message' => 'Colección creada correctamente.', 'data' => $collection], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function update(StoreCollectionRequest $request, $id)
    {
        try {
            $collection = $this->collectionService->getById($id);
            if (!$collection) {
                return response()->json(['success' => false, 'message' => 'Colección no encontrada.'], 404);
            }
            $dto = new CollectionDTO(
                $collection->id,
                $request->validated()['name'],
                $request->validated()['category_id'],
                $request->validated()['gender_id'],
                $request->validated()['author_id'],
                $request->validated()['editorial_id'],
                $request->validated()['date']
            );
            $updatedCollection = $this->collectionService->updateFromDTO($dto, $collection);
            return response()->json(['success' => true, 'message' => 'Colección actualizada correctamente.', 'data' => $updatedCollection]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $collection = $this->collectionService->getById($id);
            if (!$collection) {
                return response()->json(['success' => false, 'message' => 'Colección no encontrada.'], 404);
            }
            $this->collectionService->delete($collection);
            return response()->json(['success' => true, 'message' => 'Colección eliminada correctamente.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}
