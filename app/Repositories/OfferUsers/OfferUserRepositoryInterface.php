<?php


namespace App\Repositories\OfferUsers;


use App\Models\OfferUser;

interface OfferUserRepositoryInterface
{
    public function getOfferUserByEmail(string $email);

    public function store(array $data);
}
