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
        // dd(Auth::user());
        return inertia(
            'Listing/Index',
            [
                'filters' => $request->only([
                    'priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo',
                ]),
                'listings' => Listing::orderByDesc('created_at')->paginate(10)->withQueryString()]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //policy example for create
        // $this->authorize('create', Listing::class);

        return inertia('Listing/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreListingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreListingRequest $request)
    {
        // dd($request);
        // try {
        //     Listing::create($request->all());
        // } catch (Throwable $exception) {
        //     dd($exception->getMessage());
        //     return $exception->getMessage();
        //     return redirect()->back()->with('errors', $exception->getMessage());
        // }
        
        $request->user()->listings()->create($request->all());
        
        return redirect()->route('listings.index')->with('success', 'listing created Successfully !!');
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

        return inertia(
            'Listing/Show',
            ['listing' => $listing]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function edit(Listing $listing)
    {
        return inertia(
            'Listing/Edit',
            ['listing' => $listing]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateListingRequest  $request
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateListingRequest $request, Listing $listing)
    {
        $listing->update($request->all());
        return redirect()->route('listings.index')->with('success', 'listing updated Successfully !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Listing $listing)
    {
        $listing->delete();
        return redirect()->back()
            ->with('success', 'Listing was deleted!');
    }
}
