<?php


namespace App\Services\Offers;


use App\Models\Offer;

interface OfferServiceInterface
{
    public function getAll(bool $paginate = false);

    public function getById($id);

    public function store(array $data);

    public function update(Offer $offer, array $data);

    public function destroy(Offer $offer);
}
