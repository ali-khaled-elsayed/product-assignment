<?php

namespace App\Modules\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Modules\Product\Requests\CreateProductRequest;
use App\Modules\Product\Requests\GetProductsRequest;
use App\Modules\Product\Requests\ListAllProductsRequest;
use App\Modules\Product\Requests\ListProductsRequest;
use App\Modules\Product\Requests\UpdateProductRequest;
use App\Modules\Product\Resources\ProductResource;
use App\Modules\Product\Services\ProductService;
use App\Modules\Shared\Enums\HttpStatusCodeEnum;
use App\Modules\Users\Requests\UpdateUserRequest;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Support\Facades\Request as FacadesRequest;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService)
    {
    }

    public function createProduct(CreateProductRequest $request)
    {
        $product = $this->productService->createProduct($request->validated());
        return successJsonResponse(new ProductResource($product), __('user.success.create_user'));
    }

    public function updateProduct($id, UpdateProductRequest $request)
    {
        $user = $this->productService->updateProduct($id, $request->validated());
        return successJsonResponse(new ProductResource($user), __('user.success.update_user'));
    }

    public function listAllProducts(GetProductsRequest $request)
    {
        $products = $this->productService->listAllProducts($request->validated());
        return successJsonResponse(data_get($products, 'data'), __('users.success.get_all_Users'), data_get($products, 'count'));
    }

    public function getProductById($productId)
    {
        $product = $this->productService->getProductById($productId);
        if (!$product) {
            return errorJsonResponse("product $productId is not found!", HttpStatusCodeEnum::Not_Found->value);
        }
        return successJsonResponse(new ProductResource($product), __('product.success.user_details'));
    }
}
