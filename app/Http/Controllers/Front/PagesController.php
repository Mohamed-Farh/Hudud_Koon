<?php

namespace App\Http\Controllers\Front;
use Illuminate\Support\Facades\Session;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Chemical;
use App\Models\Front\Aboutus;
use App\Models\Join;
use App\Models\place;
use App\Models\Region;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PagesController extends Controller
{
    public function hududcard()
    {
        $id = Session::get('login_key');
        $currentuser = Join::where('id', $id)->first();

        return view('includes.sitepages.hududcard', compact('currentuser'));
    }


    public function aboutus()
    {
        $about_us= Aboutus::all();

        return view('includes.sitepages.aboutus', compact('about_us'));
    }

    public function discount()
    {
        return view('includes.sitepages.discount');
    }





    public function show_sections($id)
    {
       $places = place::where('category_id', $id)->pluck('region_id');
       $regoins = Region::whereIn('id', $places)->get();

        $category = Category::where('id', $id)->first();
        return view('includes.sitepages.sections', compact('category', 'regoins'));
    }

    public function show_section_details($category_id, $region_id)
    {
        $places = place::where(['category_id'=> $category_id, 'region_id'=> $region_id ])->get();

        $category = Category::where('id', $category_id)->first();
        $region = Region::where('id', $region_id)->first();

        return view('includes.sitepages.section_details', compact('category', 'region', 'places'));
    }

    public function show_section_place($id)
    {
       $place = place::where('id', $id)->get();
    //    dd($place);
        return view('includes.sitepages.place_details', compact('place', 'id'));
    }



    //عرض صصفحة اشترك و عرض البطاقه او الاستعلام
    public function electronic_card()
    {
        return view('includes.sitepages.electronic_card');
    }

    //عرض البطاقة الالكترونيه للشخص اللي هيكون عامل تسجيل دخول فقط
    public function show_card()
    {
        // try {
        //     $id = Session::get('login_key');
        //     if($id != ''){
        //         if (Auth::check()) {
        //             $currentuser = Join::where('id', $id)->first();
        //             return view('includes.sitepages.show_card', compact('currentuser'));
        //         }else{
        //             $currentuser = Join::where('id', $id)->first();
        //             return view('includes.sitepages.show_card', compact('currentuser'));
        //         }
        //     }
        //     else{
        //         toastr()->error('يجب عليك تسجيل الدخول اولا');
        //     return redirect()->back();
        //     }
        // }
        // catch (\Exception $e){
        //     return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        // }

    }

    //الدخول الي صفحة الاشتراك بالبطاقة الالكترونيه
    public function joins()
    {
        return view('includes.sitepages.joins');
    }


    // الاشتراك في موقع حدود الكون
    public function subscripe(Request $request)
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

            $join = new Join();
            $join->file         = $save;
            $join->name         = $request->name;
            $join->id_number    = $request->id_number;
            $join->agent_id     = '1';
            $join->phone        = $request->phone;
            $join->address      = $request->address;
            $join->place_zoom   = $request->place_zoom;
            $join->region       = $request->region;
            $join->code_number  = $code;

            $join->save();

           toastr()->success('تم تسجيل الاشتراك بنجاح . وسيتم ارسال البطاقة الاليكترونية لحضرتكم في رسالة ');
           return redirect()->route('home/electronic_card');
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
   }


    //عرض صصفحة الاستعلام
    public function search_card()
    {
        return view('includes.sitepages.search_card');
    }



    public function home_search(Request $request)
    {

        $regions = Region::where('type', $request->type)->pluck('id');

        $places = place::whereIn('region_id', $regions)->where('name', 'like', "%{$request->keyword}%")->get();

        return view('includes.sitepages.search', compact('places'));
    }




    //انضمام المراكز و المجمعات (كن معنا مجانا)
    public function medical_request()
    {
        return view('includes.sitepages.medical_request');

        // try {
        //     $id = Session::get('login_key');
        //     if($id != ''){
        //         if (Auth::check()) {
        //             $currentuser = Join::where('id', $id)->first();
        //             return view('includes.sitepages.medical_request', compact('currentuser'));
        //         }else{
        //             $currentuser = Join::where('id', $id)->first();
        //             return view('includes.sitepages.medical_request', compact('currentuser'));
        //         }
        //     }
        //     else{
        //         toastr()->error('يجب عليك تسجيل الدخول اولا قبل عملية طلب الانضمام');
        //         return view('includes.sitepages.medical_request');
        //     }
        // }
        // catch (\Exception $e){
        //     return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        // }

    }



    public function send_medical_request(Request $request)
    {

        try {
            $rules = [
                'name'          => 'required|min:3|max:50',
                'customer_name' => 'required|min:3|max:50',
                'phone'         => 'required',
                'customer_phone'=> 'required',
                'link'          => 'url',
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

            toastr()->success('لقد تم ارسال طلب الانضمام بنجاح . وسيتم التواصل مع حضرتكم لتأكيد عملية الانضمام');
            return redirect()->back();
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }



        // try {
        //     $id = Session::get('login_key');
        //     // لو الشخص موجود في جدول المشتركين في الموقع
        //     if($id != ''){
        //          // لو الشخص موجود في جدول المستخدمين
        //         if (Auth::check()) {
        //             $rules = [
        //                 'name'          => 'required|min:3|max:50',
        //                 'customer_name' => 'required|min:3|max:50',
        //                 'phone'         => 'required',
        //                 'customer_phone'=> 'required',
        //                 'link'          => 'url',
        //                 'email'         => 'email',

        //             ];
        //             $this->validate($request, $rules);

        //             $chemical = new Chemical();
        //             $chemical->name             = $request->name;
        //             $chemical->type             = $request->type;
        //             $chemical->place_zoom       = $request->place_zoom;
        //             $chemical->region           = $request->region;
        //             $chemical->address          = $request->address;
        //             $chemical->phone            = $request->phone;
        //             $chemical->customer_name    = $request->customer_name;
        //             $chemical->customer_phone   = $request->customer_phone;
        //             $chemical->email            = $request->email;
        //             $chemical->link             = $request->link;
        //             $chemical->save();

        //            toastr()->success('لقد تم ارسال طلب الانضمام بنجاح');
        //            return redirect()->route('home');

        //         }else{
        //             $rules = [
        //                 'name'          => 'required|min:3|max:50',
        //                 'customer_name' => 'required|min:3|max:50',
        //                 'phone'         => 'required',
        //                 'customer_phone'=> 'required',
        //                 'link'          => 'url',
        //                 'email'         => 'email',

        //             ];
        //             $this->validate($request, $rules);

        //             $chemical = new Chemical();
        //             $chemical->name             = $request->name;
        //             $chemical->type             = $request->type;
        //             $chemical->place_zoom       = $request->place_zoom;
        //             $chemical->region           = $request->region;
        //             $chemical->address          = $request->address;
        //             $chemical->phone            = $request->phone;
        //             $chemical->customer_name    = $request->customer_name;
        //             $chemical->customer_phone   = $request->customer_phone;
        //             $chemical->email            = $request->email;
        //             $chemical->link             = $request->link;
        //             $chemical->save();

        //            toastr()->success('لقد تم ارسال طلب الانضمام بنجاح');
        //            return redirect()->route('home');
        //         }

        //     }else{
        //         toastr()->error('يجب عليك تسجيل الدخول اولا قبل عملية طلب الانضمام');
        //         return view('includes.sitepages.medical_request');
        //     }

        // }
        // catch (\Exception $e){
        //     return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        // }
    }


}
