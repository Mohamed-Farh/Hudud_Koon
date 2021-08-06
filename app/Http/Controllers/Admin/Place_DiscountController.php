<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\models\place;
use App\Models\Place_Discount;
use Illuminate\Http\Request;

class Place_DiscountController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         try {

            //To Store One Photo For Home Page
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath =('image/place/product');
                $image->move($destinationPath, $name);
                $photo=$name;
            }

            $place_discount = new Place_Discount();
            $place_discount->photo      = $photo;
            $place_discount->place_id   = $request->place_id;
            $place_discount->description= strip_tags($request->description);
            $place_discount->name       = $request->name;
            $place_discount->price      = $request->price;
            $place_discount->discount   = $request->discount;
            $place_discount->new_price  = $request->new_price;
            $place_discount->start_day  = $request->start_day;
            $place_discount->end_day    = $request->end_day;
            $place_discount->notes      = $request->notes;
            $place_discount->type      = $request->type;
            $place_discount->save();

            toastr()->success(trans('messages.success'));
            return redirect()->back();
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
    public function update(Request $request)
    {
        try {
            $place_discount = Place_Discount::findOrFail($request->id);

            // To Store One Photo For Home Page
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath =('/image/place/product');

                if ( $image->move($destinationPath, $name) ){
                    if($place_discount->photo){
                    $old_photo = $place_discount->photo; //get old photo
                    unlink('/image/place/product/'.$old_photo);  //delete old photo from folder
                    }
                    $place_discount->photo = $name;
                    $place_discount->save();
                }
            }

            $place_discount->update([
                $place_discount->place_id   = $request->place_id,
                $place_discount->description= strip_tags($request->description),
                $place_discount->name       = $request->name,
                $place_discount->price      = $request->price,
                $place_discount->discount   = $request->discount,
                $place_discount->new_price  = $request->new_price,
                $place_discount->start_day  = $request->start_day,
                $place_discount->end_day    = $request->end_day,
                $place_discount->notes      = $request->notes,
                $place_discount->type      = $request->type,
            ]);
            toastr()->success(trans('messages.Update'));
            return redirect()->back();
        }
        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
            // $place_discount = Place_Discount::findOrFail($request->id)->delete();
            // toastr()->error(trans('messages.Delete'));
            // return redirect()->back();

            try {
                $place_discount = Place_Discount::findOrFail($request->id);

                if ($place_discount) {

                    if($place_discount->photo)
                    {
                        if (File::exists('image/place/product/' .$place_discount->photo) ) {
                            unlink('image/place/product/'.$place_discount->photo);
                        }
                    }
                    $place_discount->delete();

                    toastr()->error(trans('messages.Delete'));
                    return redirect()->back();
                }
            }
            catch
            (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }



    public function place_discount_visible(Request $request)
    {
        try {
            $place_discount = Place_Discount::findOrFail($request->id);

            if($place_discount->status == '0'){
                $place_discount->update([
                    $place_discount->status = '1',
                ]);
            }elseif($place_discount->status == '1'){
                $place_discount->update([
                    $place_discount->status = '0',
                ]);
            }
            toastr()->success(trans('messages.success'));
            return redirect()->back();
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}

