<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreListingRequest;
use App\Http\Requests\UpdateListingRequest;

class ListingController extends Controller
{

    public function __construct()
    {
        //alternativ way to define policies if you already using resource controller !!
        $this->middleware('auth')->except(['index', 'show']);
        $this->authorizeResource(Listing::class, 'listing');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = $request->only([
            'priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo',
        ]);

        return inertia(
            'Listing/Index',
            [
                'filters' => $filters,
                'listings' => Listing::mostRecent()->filter($filters)->paginate(10)->withQueryString()
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function show(Listing $listing)
    {
        //first way to consraint actions - policy - return boolean or a response
        // Auth::user()->cannot('view', $listing);

        //to do something with it 
        // if (Auth::user()->cannot('view', $listing);) {
        //     abort(403);
        // }

        //second way and more convinient !!
        // $this->authorize('view', $listing);

        $listing->load(['images']);
        return inertia(
            'Listing/Show',
            ['listing' => $listing]
        );
    }

}
