<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Category;
use App\Models\place;
use App\Models\Place_Discount;
use Auth;

class PlaceController extends Controller
{
    public function index()
    {
        // $categories = Category::where('agent_id', Auth::id() )->get();
        // $places = place::whereIn('category_id', $categories)->get();
        // return view('pages.admin.places.index')->with('places', $places)->with('categories', $categories);

        $places = place::all();
        $categories = Category::orderBy('id', 'desc')->get();
        return view('pages.admin.places.index', compact('places', 'categories'));
    }

    public function store(Request $request)
    {
        try{

            //To Store One Photo For Home Page
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath =('image/place/photo');
                $image->move($destinationPath, $name);
                $photo=$name;
            }

            $place = new place();
            $place->photo             = $photo;
            $place->name              = $request->name;
            $place->phone             = $request->phone;
            $place->description       = $request->description;
            $place->url               = $request->url;
            $place->map               = $request->map;
            $place->category_id       = $request->category_id;
            $place->region_id         = $request->region_id;
            $place->save();

            toastr()->success('message', 'place created successfully.');
            return redirect()->route('places.index', ['id' => $request->user()->id]);
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(place $place)
    {

        $place_discounts = Place_Discount::all();

        return view('pages.admin.place_discounts.index', compact('place_discounts', 'place'));
    }

    public function update(Request $request)
    {

        try {
            $place = place::findOrFail($request->id);


            // To Store One Photo For Home Page
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath =('image/place/photo');

                if ( $image->move($destinationPath, $name) ){
                    if($place->photo){
                    $old_photo = $place->photo; //get old photo
                    unlink('image/place/photo/'.$old_photo);  //delete old photo from folder
                    }
                    $place->photo = $name;
                    $place->save();
                }
            }

            $place->name              = $request->name;
            $place->phone             = $request->phone;
            $place->description       = $request->description;
            $place->url               = $request->url;
            $place->map               = $request->map;
            $place->category_id       = $request->category_id;
            $place->region_id         = $request->region_id;
            $place->save();


            toastr()->success('message', 'place Updated successfully.');
            return redirect()->route('places.index');
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy(Request $request)
    {
        try {
            $place = place::findOrFail($request->id);

            if ($place) {

                if($place->photo)
                {
                    if (File::exists('image/place/photo/' .$place->photo) ) {
                        unlink('image/place/photo/'.$place->photo);
                    }
                }
                $place->delete();

                toastr()->error(trans('messages.Delete'));
                return redirect()->route('places.index');
            }
        }
        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
