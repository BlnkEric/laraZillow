<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreListingRequest;
use App\Http\Requests\UpdateListingRequest;
use Inertia\Inertia;

class RealtorListingController extends Controller
{
    public function __construct()
    {
        //alternativ way to define policies if you already using resource controller !!
        // $this->authorizeResource(Listing::class, 'listing');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // ... three dots : just unpack all elements of following array and add them to the parent array !? yes that
        // it's like merge !
        $filters = [
            'deleted' => $request->boolean('deleted'),
            ... $request->only(['by', 'order'])
        ];

        // as we add sort by and order we can comment most recent query scope !!
        return inertia(
            'Realtor/Index', [
            // 'deleted' => $request->boolean('deleted'),
            'filters' => $filters,
            'listings' => Auth::user()
            ->listings()
            // ->mostRecent()
            ->filter($filters)
            ->withCount('images')
            ->withCount('offers')
            ->paginate(5)
            ->withQueryString()
            ]
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

        return inertia('Realtor/Create');
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
        
        return redirect()->route('realtor.listings.index')->with('success', 'listing created Successfully !!');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Listing $listing)
    {
        return Inertia(
            'Realtor/Show',
            ['listing' => $listing->load('offers', 'offers.bidder')]
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
            'Realtor/Edit',
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
        return redirect()->route('realtor.listings.index')->with('success', 'listing updated Successfully !!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Listing $listing)
    {
        $listing->deleteOrFail();
        return redirect()->back()
            ->with('success', 'Listing was deleted!');
    }
    public function restore(Listing $listing)
    {
        $listing->restore();
        return redirect()->back()
            ->with('success', 'Listing was restored!');
    }
}
