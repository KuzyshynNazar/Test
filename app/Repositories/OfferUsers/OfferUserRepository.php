<?php


namespace App\Repositories\OfferUsers;


use App\Models\OfferUser;

class OfferUserRepository implements OfferUserRepositoryInterface
{
    public function store(array $data)
    {
        return OfferUser::create($data);
    }

    public function getOfferUserByEmail(string $email)
    {
        return OfferUser::where('email', '=', $email)->first();
    }
}
