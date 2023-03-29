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
        // Accept selected Offer
        $offer->update(['accepted_at' => now()]);

        // Reject All Other Offers
        $offer->listing->offers()->except($offer)->update(['rejected_at' => now()]);

        return redirect()->back()->with('success', "Offer #{$offer->id} accepted, other offers rejected !");
    }
}
