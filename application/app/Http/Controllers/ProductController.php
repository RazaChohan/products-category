<?php

namespace App\Http\Controllers;

use Dal\Repositories\ProductRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ProductController extends Controller
{
    public function __construct(private ProductRepositoryInterface $productRepository) {}

    /**
     * @return JsonResponse
     */
    public function getAllProducts(): JsonResponse
    {
        $response = [];
        $responseCode = ResponseAlias::HTTP_OK;
        try {
            $response = $this->productRepository->getAllProducts();
        } catch(Exception $exception) {
            $responseCode = ResponseAlias::HTTP_INTERNAL_SERVER_ERROR;
            parent::log($exception, ProductController::class);
        }

        return response()->json($response, $responseCode);
    }

    /**
     * @param string $id
     *
     * @return JsonResponse
     */
    public function getProduct(string $id): JsonResponse
    {
        $response = [];
        $responseCode = ResponseAlias::HTTP_OK;
        try {
            $response = $this->productRepository->getProduct($id);
            if (empty($response)) {
                $responseCode = ResponseAlias::HTTP_NOT_FOUND;
            }
        } catch(Exception $exception) {
            $responseCode = ResponseAlias::HTTP_INTERNAL_SERVER_ERROR;
            parent::log($exception, ProductController::class);
        }

        return response()->json($response, $responseCode);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function postProduct(Request $request): JsonResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        $response = [];
        $responseCode = ResponseAlias::HTTP_OK;
        try {
            $response = $this->productRepository->createProduct($request->all());
            if (empty($response)) {
                $responseCode = ResponseAlias::HTTP_BAD_REQUEST;
            }
        } catch(Exception $exception) {
            $responseCode = ResponseAlias::HTTP_INTERNAL_SERVER_ERROR;
            parent::log($exception, ProductController::class);
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
    public function putProduct(string $id, Request $request): JsonResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        $response = [];
        $responseCode = ResponseAlias::HTTP_OK;
        try {
            $product = $this->productRepository->getProduct($id);
            if (!empty($product)) {
                $isUpdated = $this->productRepository->updateProduct($id, $request->all());
                if (!$isUpdated) {
                    $responseCode = ResponseAlias::HTTP_BAD_REQUEST;
                }
            } else {
                $responseCode = ResponseAlias::HTTP_NOT_FOUND;
            }

        } catch(Exception $exception) {
            $responseCode = ResponseAlias::HTTP_INTERNAL_SERVER_ERROR;
            parent::log($exception, ProductController::class);
        }

        return response()->json($response, $responseCode);
    }

    /**
     * @param string $id
     *
     * @return JsonResponse
     */
    public function deleteProduct(string $id): JsonResponse
    {
        $response = [];
        $responseCode = ResponseAlias::HTTP_OK;
        try {
            $product = $this->productRepository->getProduct($id);
            if (!empty($product)) {
                $isDeleted = $this->productRepository->deleteProduct($id);
                if (!$isDeleted) {
                    $responseCode = ResponseAlias::HTTP_BAD_REQUEST;
                }
            } else {
                $responseCode = ResponseAlias::HTTP_NOT_FOUND;
            }

        } catch(Exception $exception) {
            $responseCode = ResponseAlias::HTTP_INTERNAL_SERVER_ERROR;
            parent::log($exception, ProductController::class);
        }

        return response()->json($response, $responseCode);
    }

}
