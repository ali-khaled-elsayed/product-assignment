<?php

namespace  App\Modules\Product\Services;

use App\Models\Product;
use App\Modules\Product\Repositories\ProductRepository;
use App\Modules\Product\Requests\ListAllProductsRequest;
use App\Modules\Product\Resources\ProductCollection;

class ProductService
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function createProduct($request)
    {
        $product = $this->constructProductModel($request);
        return $this->productRepository->create($product);
    }

    public function updateProduct($id, $request)
    {
        $product = $this->constructProductModel($request);
        return $this->productRepository->update($id, $product);
    }

    public function updateAdjustedPrice(Product $product): void
    {
        $product->price = $this->adjustProductPrice($product);
        $product->save();
    }

    public function listAllProducts(array $queryParameters)
    {
        // Construct Query Criteria
        $listAllProducts = (new ListAllProductsRequest)->constructQueryCriteria($queryParameters);

        // Get Countries from Database
        $products = $this->productRepository->findAllBy($listAllProducts);

        return [
            'data' => new ProductCollection($products['data']),
            'count' => $products['count']
        ];
    }

    public function getProductById($id)
    {
        return $this->productRepository->find($id);
    }

    public function adjustProductPrice(Product $product): float
    {
        $originalPrice = $product->price;
        $stock = $product->stock_quantity;

        if ($stock < 10) {
            // Increase price by 10%
            $adjustedPrice = $originalPrice * 1.10;
        } elseif ($stock > 100) {
            // Decrease price by 5%
            $adjustedPrice = $originalPrice * 0.95;
        } else {
            $adjustedPrice = $originalPrice;
        }

        return round($adjustedPrice, 2);
    }

    public function constructProductModel($request)
    {
        $productModel = [
            'name' => $request['name'],
            'description' => $request['description'] ?? null,
            'price' => $request['price'],
            'stock_quantity' => $request['stock_quantity'],
        ];
        
        return $productModel;
    }

}
