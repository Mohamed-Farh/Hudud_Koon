<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Join;
use App\Models\place;
use App\Models\Place_Discount;
use App\Models\Region;
use Illuminate\Http\Request;

class CoponController extends Controller
{
    public function Show_regioncopon($type)
    {
        $regions = Region::where('type', $type)->get();

         return view('includes.sitepages.regioncopon', compact('regions', 'type'));
    }



    public function Show_regioncopon_place($id)
    {
        $place = place::where('region_id', $id)->first();

        $place_discount = Place_Discount::where('place_id', $place->id)->where('status', '0')->get();

        return view('includes.sitepages.regioncopon_place', compact('place', 'id', 'place_discount'));
    }


    //تستخدم في البحث عن البطاقة في صفحة الاشتراك
    public function find_card(Request $request)
    {
        $card_no = Join::where('id_number', $request->card_no)->first();

        if( $card_no != ''){
            return view('includes.sitepages.show_card', compact('card_no'));
        }else{
            toastr()->error('عفوا الرقم الذي قمت بإدخاله غير صحيح . يرجي التأكد من الرقم و إعادة المحاولة مرة أخري');
            return view('includes.sitepages.search_card');
        }



    }






    //----------  Discount --------------
    public function zoom_discount()
    {
         return view('includes.sitepages.copon.discount_discount');
    }
    public function Show_region_discount($type)
    {
        $regions = Region::where('type', $type)->get();

         return view('includes.sitepages.copon.region_discount', compact('regions', 'type'));
    }

    public function Show_region_discount_place($id)
    {
        $place = place::where('region_id', $id)->first();
        $place_discount = Place_Discount::where('type', 'عرض')->where('place_id', $place->id)->where('status', '0')->get();

         return view('includes.sitepages.copon.region_place_discount', compact('place', 'id', 'place_discount'));
    }



     //----------  Coooooopoooooooon --------------
    public function zoom_copon()
    {
         return view('includes.sitepages.copon.discount_copon');
    }
    public function Show_region_copon($type)
    {
        $regions = Region::where('type', $type)->get();

         return view('includes.sitepages.copon.region_copon', compact('regions', 'type'));
    }
    public function Show_region_copon_place($id)
    {
        $place = place::where('region_id', $id)->first();
        $place_discount = Place_Discount::where('type', 'كوبون')->where('place_id', $place->id)->where('status', '0')->get();

         return view('includes.sitepages.copon.region_place_copon', compact('place', 'id', 'place_discount'));
    }





}
