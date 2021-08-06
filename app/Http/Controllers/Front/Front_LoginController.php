<?php

namespace App\Http\Controllers\Front;
use Illuminate\Support\Facades\Session;


use App\Http\Controllers\Controller;
use App\Models\Join;
use Illuminate\Http\Request;

class Front_LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('includes.sitepages.front_login');
    }


    public function front_sign(Request $request)
    {

        $join = Join::where(['id_number'=> $request->id_number, 'password'=> $request->password ])->first();

        if( $join ){
            Session::forget('login_key');
            Session::put('login_key', $join->id);
            // return view('home');
            return redirect()->route('home');

        }else{
            return view('includes.sitepages.front_login')->withErrors(['error' => 'erooooooooo']);
        }
    }

    public function front_logout(Request $request)
    {
        Session::forget('login_key');

        return redirect()->route('home');
    }

}
