<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Front\Aboutus;
use Illuminate\Http\Request;

class AboutusController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.aboutus.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.aboutus.create');
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
                'aboutus' => 'required|string|min:10',
                'message' => 'required|string|min:10',
                'message' => 'required|string|min:10',
            ];
            $this->validate($request, $rules);

            $aboutus = new Aboutus();
            $aboutus->aboutus            =  strip_tags($request->aboutus);
            $aboutus->message            =  strip_tags($request->message);
            $aboutus->vision             =  strip_tags($request->vision);
            $aboutus->save();

            toastr()->success(trans('messages.success'));
            return redirect()->route('aboutus.index');
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
    public function update(Request $request, $id)
    {
        try {
            $rules = [
                'aboutus' => 'required|string|min:10',
                'message' => 'required|string|min:10',
                'message' => 'required|string|min:10',
            ];
            $this->validate($request, $rules);
            $aboutus = Aboutus::where('id',$id)->first();
            $aboutus->update([
                $aboutus->aboutus   = strip_tags($request->aboutus),
                $aboutus->message   = strip_tags($request->message),
                $aboutus->vision   = strip_tags($request->vision),
            ]);
            toastr()->success(trans('messages.Update'));
            return redirect()->route('aboutus.index');
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
        $features = Aboutus::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('features.index');
    }
}
