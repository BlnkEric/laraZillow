<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class RealrotListingAcceptOfferController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Offer $offer, Request $request)
    {
        $listing = $offer->listing;
        $this->authorize('update', $listing);

        // Accept selected Offer
        $offer->update(['accepted_at' => now()]);
        $listing->sold_at = now();
        $listing->save();

        // Reject All Other Offers
        $listing->offers()->except($offer)->update(['rejected_at' => now()]);

        return redirect()->back()->with('success', "Offer #{$offer->id} accepted, other offers rejected !");
    }
}
