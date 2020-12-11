<?php


namespace App\Repositories\Products;


use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function store(array $data)
    {
        return Product::create($data);
    }

    public function destroy(Product $product)
    {
        return $product->delete();
    }
}
