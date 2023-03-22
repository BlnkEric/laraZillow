<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Rules\ImageError;
use Illuminate\Support\Str;
use App\Models\ListingImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RealtorListingImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Listing $listing)
    {
        $listing->load(['images']);
        return inertia(
            'Realtor/ListingImage/Create',
            ['listing' => $listing]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Listing $listing, Request $request)
    {
        if($request->has('images')) {
            // $arr = explode("\\", $request->images[0]->path());
            // dd(end($arr));
            $request->validate([
                'images.*' => 'mimes:png,jpg,jpeg|max:5000',
                // 'images' => new ImageError($request->all()),
            ], [
                'images.*.mimes' => 'images should be in one of the following types: jpg, jpeg, png'
            ]);

            foreach ($request->file('images') as $key => $file) {
                // dd(substr($file->path(), -(Str::length($file->path())), strpos($file->path(), "//")));
                $path = $file->store('images', 'public');

                $listing->images()->save(new ListingImage([
                    'filename' => $path
                ]));
            }
            
            // $validator = Validator::make($request->all(), [
            //     'images.*' => [
            //         function ($attribute, $value, $fail) {
            //             if ($value === 'foo') {
            //                 $fail('The '.$attribute.' is invalid.');
            //             }
            //         },
            //     ],
            // ]);


            // $Rules = [   
            //     'images.*' => 'required|mimes:jpg,jpeg,png',
            // ];

            // $Validator = Validator::make($request->all(), $Rules);
            // if ($Validator->fails()) {
            //     return back()->withErrors($Validator->errors()->all());
            // } else {
            //     do something
            // }
        }
        return redirect()->back()->with('success', 'Images Uploaded Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($listing, ListingImage $image)
    {
        Storage::disk('public')->delete($image->filename);
        $image->delete();

        // this one also works correctly !! but we are not using it - just in case
        // return back()->with('success', 'Image Deleted Successfully!');
        return redirect()->back()->with('success', 'Image Deleted Successfully!');
    }
}
