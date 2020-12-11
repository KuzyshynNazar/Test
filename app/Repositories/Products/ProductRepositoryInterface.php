<?php


namespace App\Repositories\Products;


use App\Models\Product;

interface ProductRepositoryInterface
{
    public function store(array $data);

    public function destroy(Product $product);
}
