<?php

namespace App\Services\Offers;

use App\Models\Offer;
use App\Repositories\Offers\OfferRepositoryInterface;
use App\Repositories\OfferUsers\OfferUserRepositoryInterface;
use App\Repositories\Products\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

class OfferService implements OfferServiceInterface
{
    private $offerUserRepository;
    private $productRepository;
    private $offerRepository;

    public function __construct(
        OfferRepositoryInterface $offerRepository,
        OfferUserRepositoryInterface $offerUserRepository,
        ProductRepositoryInterface $productRepository
    )
    {
        $this->offerUserRepository = $offerUserRepository;
        $this->productRepository = $productRepository;
        $this->offerRepository = $offerRepository;
    }

    /**
     * @param bool $paginate
     * @return mixed
     */
    public function getAll(bool $paginate = false)
    {
        return $this->offerRepository->getAll();
    }

    /**
     * @param $id
     * @return string
     */
    public function getById($id)
    {
        $offer = $this->offerRepository->getById($id);
        return isset($offer) ? $offer : "Not fount Offer";
    }

    /**
     * @param array $data
     * @return string
     */
    public function store(array $data)
    {
        DB::beginTransaction();
        try {
            $offerUser = $this->getOfferUser($data['email']);

            $offer = $this->offerRepository->store([
                'offer_user_id' => $offerUser->id,
                'title' => $data['title'],
            ]);

            foreach ($data['products'] as $productData) {
                $product = $this->productRepository->store($productData);
                $this->offerRepository->addProductToOffer($product, $offer);
            }

            DB::commit();
            return "Success! Created Offer!";
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    /**
     * @param Offer $offer
     * @param array $data
     * @return string
     */
    public function update(Offer $offer, array $data)
    {
        DB::beginTransaction();
        try {
            $offerUser = $this->getOfferUser($data['email']);

            $updateData = [
                'offer_user_id' => $offerUser->id,
                'title' => $data['title'],
            ];

            $this->offerRepository->update($offer, $updateData);

            //Remove old products
            foreach ($offer->products as $product) {
                $this->offerRepository->removeRelationshipForProduct($product, $offer);
                $this->productRepository->destroy($product);
            }

            //Added new products
            foreach ($data['products'] as $productData) {
                $product = $this->productRepository->store($productData);
                $this->offerRepository->addProductToOffer($product, $offer);
            }

            DB::commit();
            return "Success! Updated Offer!";
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    /**
     * @param Offer $offer
     * @return string
     */
    public function destroy(Offer $offer)
    {
        DB::beginTransaction();
        try {
            foreach ($offer->products as $product) {
                $this->offerRepository->removeRelationshipForProduct($product, $offer);
                $this->productRepository->destroy($product);
            }

            $this->offerRepository->destroy($offer);

            DB::commit();
            return "Success! Deleted Offer!";
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    /**
     * @param $email
     * @return mixed
     */
    private function getOfferUser($email)
    {
        $offerUser = $this->offerUserRepository->getOfferUserByEmail($email);

        if (!isset($offerUser)){
            $offerUser = $this->offerUserRepository->store([
                'email' => $email
            ]);
        }

        return $offerUser;
    }
}
