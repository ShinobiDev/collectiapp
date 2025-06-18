<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use App\DTOs\Category\CategoryDTO;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        try {
            $categoryes = $this->categoryService->getAll();
            return response()->json(['success' => true, 'data' => $categoryes]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $category = $this->categoryService->getById($id);
            if (!$category) {
                return response()->json(['success' => false, 'message' => 'Estado no encontrado.'], 404);
            }
            return response()->json(['success' => true, 'data' => $category]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function store(StoreCategoryRequest $request)
    {
        try {
            // La validación ya se hizo en StoreCategoryRequest
            $dto = new CategoryDTO(null, $request->validated()['name']);
            $category = $this->categoryService->createFromDTO($dto);
            return response()->json(['success' => true, 'message' => 'Estado creado correctamente.', 'data' => $category], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        try {
            $category = $this->categoryService->getById($id);
            if (!$category) {
                return response()->json(['success' => false, 'message' => 'Estado no encontrado.'], 404);
            }
            $dto = new CategoryDTO($category->id, $request->validated()['name']);
            $updatedCategory = $this->categoryService->updateFromDTO($dto, $category);
            return response()->json(['success' => true, 'message' => 'Estado actualizado correctamente.', 'data' => $updatedCategory]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $category = $this->categoryService->getById($id);
            if (!$category) {
                return response()->json(['success' => false, 'message' => 'Estado no encontrado.'], 404);
            }
            $this->categoryService->delete($category);
            return response()->json(['success' => true, 'message' => 'Estado eliminado correctamente.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}
