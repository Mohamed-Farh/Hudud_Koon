<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\Adv;
use Illuminate\Http\Request;

class AdvController extends Controller
{
    public function index()
    {
        $advs = Adv::orderBy('id', 'desc')->get();

        return view('pages.admin.advs.index', compact('advs'));
    }

    public function store(Request $request)
    {
        try{

            //To Store One Photo For Home Page
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath =('image/adv_images/photo');
                $image->move($destinationPath, $name);
                $photo=$name;
            }

            $adv = new adv();
            $adv->photo             = $photo;
            $adv->title             = $request->title;
            $adv->phone             = $request->phone;
            $adv->description       = $request->description;
            $adv->video_link        = $request->video_link;
            $adv->url               = $request->url;

            $adv->save();

            toastr()->success('message', 'Advs created successfully.');
            return redirect()->route('advs.index', ['id' => $request->user()->id]);
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
    // public function show(adv $adv)
    // {

    //     $adv_discounts = adv_Discount::all();

    //     return view('pages.admin.adv_discounts.index', compact('adv_discounts', 'adv'));
    // }

    public function update(Request $request)
    {

        try {
            $adv = Adv::findOrFail($request->id);


            // To Store One Photo For Home Page
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath =('image/adv_images/photo');

                if ( $image->move($destinationPath, $name) ){
                    if($adv->photo){
                    $old_photo = $adv->photo; //get old photo
                    unlink('image/adv_images/photo/'.$old_photo);  //delete old photo from folder
                    }
                    $adv->photo = $name;
                    $adv->save();
                }
            }

            $adv->title              = $request->title;
            $adv->phone             = $request->phone;
            $adv->description       = $request->description;
            $adv->video_link       = $request->video_link;
            $adv->url               = $request->url;

            $adv->save();


            toastr()->success('message', 'Advs Updated successfully.');
            return redirect()->route('advs.index');
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy(Request $request)
    {
        try {
            $adv = Adv::findOrFail($request->id);

            if ($adv) {

                if($adv->photo)
                {
                    if (File::exists('image/adv_images/photo/' .$adv->photo) ) {
                        unlink('image/adv_images/photo/'.$adv->photo);
                    }
                }
                $adv->delete();

                toastr()->error(trans('messages.Delete'));
                return redirect()->route('advs.index');
            }
        }
        catch
        (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function advs_visible(Request $request)
    {
        try {
            $adv = Adv::findOrFail($request->id);

            if($adv->status == '0'){
                $adv->update([
                    $adv->status = '1',
                ]);
            }elseif($adv->status == '1'){
                $adv->update([
                    $adv->status = '0',
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
