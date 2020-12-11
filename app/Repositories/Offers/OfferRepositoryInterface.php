<?php


namespace App\Repositories\Offers;


use App\Models\Offer;
use App\Models\Product;

interface OfferRepositoryInterface
{
    public function getAll(bool $paginate = false);

    public function getById($id);

    public function store(array $data);

    public function addProductToOffer(Product $product, Offer $offer);

    public function removeRelationshipForProduct(Product $product, Offer $offer);

    public function update(Offer $offer, array $data);

    public function destroy(Offer $offer);
}
