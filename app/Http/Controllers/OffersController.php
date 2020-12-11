<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferStore;
use App\Http\Requests\OfferUpdate;
use App\Models\Offer;
use App\Services\Offers\OfferServiceInterface;

class OffersController extends Controller
{
    private $offerService;

    public function __construct(OfferServiceInterface $offerService)
    {
        $this->offerService = $offerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->offerService->getAll();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfferStore $request)
    {
        return $this->offerService->store($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->offerService->getById($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Offer $offer
     * @return Offer
     */
    public function update(OfferUpdate $request, Offer $offer)
    {
        return $this->offerService->update($offer, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Offer $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        return $this->offerService->destroy($offer);
    }
}
