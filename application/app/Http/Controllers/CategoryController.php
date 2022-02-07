<?php

namespace App\Http\Controllers;

use Dal\Repositories\CategoryRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Exception;

class CategoryController extends Controller
{
    public function __construct(private CategoryRepositoryInterface $categoryRepository) {}

    /**
     * @param string $id
     *
     * @return JsonResponse
     */
    public function getCategoryProducts(string $id): JsonResponse
    {
        $response = [];
        $responseCode = ResponseAlias::HTTP_OK;
        try {
            $response = $this->categoryRepository->getCategoryProducts($id);
            if (empty($response)) {
                $responseCode = ResponseAlias::HTTP_NOT_FOUND;
            }
        } catch(Exception $exception) {
            $responseCode = ResponseAlias::HTTP_INTERNAL_SERVER_ERROR;
            parent::log($exception, CategoryController::class);
        }

        return response()->json($response, $responseCode);
    }

    /**
     * @return JsonResponse
     */
    public function getAllCategories(): JsonResponse
    {
        $response = [];
        $responseCode = ResponseAlias::HTTP_OK;
        try {
            $response = $this->categoryRepository->getAllCategories();
        } catch(Exception $exception) {
            $responseCode = ResponseAlias::HTTP_INTERNAL_SERVER_ERROR;
            parent::log($exception, CategoryController::class);
        }

        return response()->json($response, $responseCode);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function postCategory(Request $request): JsonResponse
    {
        $this->validate($request, [
            'name' => 'required|unique:categories,name',
        ]);

        $response = [];
        $responseCode = ResponseAlias::HTTP_OK;
        try {
            $response = $this->categoryRepository->createCategory($request->all());
            if (empty($response)) {
                $responseCode = ResponseAlias::HTTP_BAD_REQUEST;
            }
        } catch(Exception $exception) {
            $responseCode = ResponseAlias::HTTP_INTERNAL_SERVER_ERROR;
            parent::log($exception, CategoryController::class);
        }

        return response()->json($response, $responseCode);
    }

    /**
     * @param string $id
     * @param Request $request
     *
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function putCategory(string $id, Request $request): JsonResponse
    {
        $this->validate($request, [
            'name' => 'required|unique:categories,name,' . $id,
        ]);

        $response = [];
        $responseCode = ResponseAlias::HTTP_OK;
        try {
            $product = $this->categoryRepository->getCategory($id);
            if (!empty($product)) {
                $isUpdated = $this->categoryRepository->updateCategory($id, $request->all());
                if (!$isUpdated) {
                    $responseCode = ResponseAlias::HTTP_BAD_REQUEST;
                }
            } else {
                $responseCode = ResponseAlias::HTTP_NOT_FOUND;
            }
        } catch(Exception $exception) {
            $responseCode = ResponseAlias::HTTP_INTERNAL_SERVER_ERROR;
            parent::log($exception, CategoryController::class);
        }

        return response()->json($response, $responseCode);
    }

    /**
     * @param string $id
     *
     * @return JsonResponse
     */
    public function deleteCategory(string $id): JsonResponse
    {
        $response = [];
        $responseCode = ResponseAlias::HTTP_OK;
        try {
            $product = $this->categoryRepository->getCategory($id);
            if (!empty($product)) {
                $isDeleted = $this->categoryRepository->deleteCategory($id);
                if (!$isDeleted) {
                    $responseCode = ResponseAlias::HTTP_BAD_REQUEST;
                }
            } else {
                $responseCode = ResponseAlias::HTTP_NOT_FOUND;
            }

        } catch(Exception $exception) {
            $responseCode = ResponseAlias::HTTP_INTERNAL_SERVER_ERROR;
            parent::log($exception, CategoryController::class);
        }

        return response()->json($response, $responseCode);
    }
}
