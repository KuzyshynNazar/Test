<?php


namespace App\Repositories\Offers;


use App\Models\Offer;
use App\Models\OfferProduct;
use App\Models\Product;

class OfferRepository implements OfferRepositoryInterface
{

    public function getAll(bool $paginate = false)
    {
        if ($paginate){
            return Offer::with('products', 'offerUser')->orderBy('created_at', 'DESC')->paginate(config('app.paginate'));
        } else {
            return Offer::with('products', 'offerUser')->orderBy('created_at', 'DESC')->get();
        }
    }

    public function getById($id)
    {
        return Offer::with('products', 'offerUser')->find($id);
    }

    public function store(array $data)
    {
        return Offer::create($data);
    }

    public function update(Offer $offer, array $data)
    {
        return $offer->update($data);
    }

    public function destroy(Offer $offer)
    {
        return $offer->delete();
    }

    /**
     * @param Product $product
     * @param Offer $offer
     */
    public function addProductToOffer(Product $product, Offer $offer)
    {
        return OfferProduct::create([
            'offer_id' => $offer->id,
            'product_id' => $product->id,
        ]);
    }

    public function removeRelationshipForProduct(Product $product, Offer $offer)
    {
        return OfferProduct::where('offer_id', '=', $offer->id)->where('product_id', '=', $product->id)->delete();
    }
}
