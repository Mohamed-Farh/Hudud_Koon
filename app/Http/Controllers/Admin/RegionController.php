<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = Region::all();

        return view('pages.admin.regions.index', compact('regions'));
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
                'name' => 'required|min:3|max:50',
                'type' => 'required',
            ];
            $this->validate($request, $rules);

            $region = new Region();
            $region->agent_id= $request->agent_id;
            $region->name    = $request->name;
            $region->type    = $request->type;
            $region->save();
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
                'type' => 'required',
            ];
            $this->validate($request, $rules);

            $region = Region::findOrFail($request->id);
            $region->update([
                $region->agent_id= $request->agent_id,
                $region->name = $request->name,
                $region->type = $request->type,
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
        $related_category = Category::findOrFail(1)->where('region_id', $request->id)->pluck('region_id');

        if($related_category->count() == 0){
            $region = Region::findOrFail($request->id)->delete();
            toastr()->error(trans('messages.Delete'));
            return redirect()->route('regions.index');
        }else{
            toastr()->error(trans('لا يمكن حذف هذه المنطقة لوجود تصنيفات متعلقة بها'));
            return redirect()->route('regions.index');
        }
    }


    public function region_visible(Request $request)
    {
        try {
            $region = Region::findOrFail($request->id);

            if($region->status == '0'){
                $region->update([
                    $region->status = '1',
                ]);
            }elseif($region->status == '1'){
                $region->update([
                    $region->status = '0',
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
