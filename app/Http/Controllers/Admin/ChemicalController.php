<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chemical;
use Illuminate\Http\Request;

class ChemicalController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
       $chemicals = Chemical::all();

       return view('pages.admin.chemical.index', compact('chemicals'));
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
            $rules = [
                'name'          => 'required|min:3|max:50',
                'customer_name' => 'required|min:3|max:50',
                'phone'         => 'required|numeric',
                'customer_phone'=> 'required|numeric',
                'link'          =>'url',
                'email'         => 'email',

            ];
            $this->validate($request, $rules);

            $chemical = new Chemical();
            $chemical->name             = $request->name;
            $chemical->type             = $request->type;
            $chemical->place_zoom       = $request->place_zoom;
            $chemical->region           = $request->region;
            $chemical->address          = $request->address;
            $chemical->phone            = $request->phone;
            $chemical->customer_name    = $request->customer_name;
            $chemical->customer_phone   = $request->customer_phone;
            $chemical->email            = $request->email;
            $chemical->link             = $request->link;
            $chemical->save();

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
//    public function update(Request $request)
//    {
//        try {
//             $rules = [
//                 'name' => 'required|min:3|max:50',
//                 'phone' => 'required|numeric',
//             ];
//             $this->validate($request, $rules);

//            $join = Chemical::findOrFail($request->id);
//            $join->update([
//             $join->name         = $request->name,
//             $join->id_number    = $request->id_number,
//             $join->phone        = $request->phone,
//             $join->address      = $request->address,
//             $join->bank_code    = $request->bank_code,
//             $join->place_zoom   = $request->place_zoom,
//             $join->region       = $request->region,
//            ]);
//            toastr()->success(trans('messages.Update'));
//            return redirect()->back();
//        }
//        catch
//        (\Exception $e) {
//            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
//        }
//    }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy(Request $request)
   {
       $Chemical = Chemical::findOrFail($request->id)->delete();
       toastr()->error(trans('messages.Delete'));
       return redirect()->back();
   }




   public function chemical_visible(Request $request)
    {
        try {
            $chemical = Chemical::findOrFail($request->id);

            if($chemical->status == '0'){
                $chemical->update([
                    $chemical->status = '1',
                ]);
            }elseif($chemical->status == '1'){
                $chemical->update([
                    $chemical->status = '0',
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
