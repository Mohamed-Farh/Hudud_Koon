<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Join;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class JoinController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
       $Joins = Join::all();

       return view('pages.admin.join.index', compact('Joins'));
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
            do
            {
                // $code = Str::random(16);
                $code = mt_rand(000000000000000,999999999999999);
                $user_code = Join::where('code_number', $code)->get();
            }
            while(!$user_code->isEmpty());
            $rules = [
                'name' => 'required|min:3|max:50',
                'phone' => 'required|numeric',
                'id_number' => 'required|unique:join',
            ];
            $this->validate($request, $rules);

            if($request->file('file'))
            {
                $file = $request->file('file');
                $file_name = time().'.'.$file->getClientOriginalExtension();
                $filePath =('files/uploads/');
                $file->move($filePath, $file_name);
                $save = $file_name;
            }

            if($request->agent_id != '0'){
                $agent_id     = $request->agent_id;
            }else{
                $agent_id     = Auth::id();
            }

            $join = new Join();
            $join->file         = $save;
            $join->name         = $request->name;
            $join->id_number    = $request->id_number;
            $join->agent_id     = $agent_id;
            $join->phone        = $request->phone;
            $join->address      = $request->address;
            $join->place_zoom   = $request->place_zoom;
            $join->region       = $request->region;
            $join->code_number  = $code;

            $join->save();

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
            $rules = [
                'name' => 'required|min:3|max:50',
                'phone' => 'required|numeric',
            ];
            $this->validate($request, $rules);

            $join = Join::findOrFail($request->id);

            if($request->file('file'))
            {
                $file = $request->file('file');
                $file_name = time().'.'.$file->getClientOriginalExtension();
                $filePath =('files/uploads/');

                if ( $file->move($filePath, $file_name) ){
                    if($join->file){
                        $old_file = $join->file; //get old photo
                        unlink('files/uploads/'.$old_file);  //delete old photo from folder
                    }
                    $join->file = $file_name;
                    $join->save();
                }
            }

            $join->update([
                $join->name         = $request->name,
                $join->id_number    = $request->id_number,
                $join->phone        = $request->phone,
                $join->address      = $request->address,
                $join->agent_id     = $request->agent_id,
                $join->place_zoom   = $request->place_zoom,
                $join->region       = $request->region,
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
       $joins = Join::findOrFail($request->id)->delete();
       toastr()->error(trans('messages.Delete'));
       return redirect()->back();
   }



}
