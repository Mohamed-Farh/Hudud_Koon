<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group(['middleware' => ['guest']], function () {

    Route::get('/', function () {
        return view('home');

    });

});

Route::get('/home', 'Front\HomeController@home')->name('home');



 //==============================Translate all pages============================
Route::group(
    [
        'middleware' => ['auth']
    ], function () {

     //==============================dashboard============================
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');


    //============================== Admins ============================
    Route::group(['namespace' => 'Admin'], function () {

        Route::resource('admins', 'AdminController');
    });
    //============================== Users ============================
    Route::group(['namespace' => 'Admin'], function () {

        Route::resource('users', 'UserController');
    });
    //============================== About US ============================
    Route::group(['namespace' => 'Front'], function () {

        Route::resource('aboutus', 'AboutusController');
    });
    //============================== Regions ============================
    Route::group(['namespace' => 'Admin'], function () {

        Route::resource('regions', 'RegionController');
        Route::post('region/visible', 'RegionController@region_visible')->name('region/visible');

    });
    //============================== Places ============================
    Route::group(['namespace' => 'Admin'], function () {

        Route::resource('categories', 'CategoryController');
        Route::post('category/visible', 'CategoryController@category_visible')->name('category/visible');
        Route::post('removeImage/{image}', 'CategoryController@removeImage')->name('removeImage');
        Route::GET('/deleteimg/{id}', 'CategoryController@deleteimg')->name('deleteimg');


        Route::resource('places', 'PlaceController');

    });

    //============================== Place Discounts Location ============================
    Route::group(['namespace' => 'Admin'], function () {

        Route::resource('place_discounts', 'Place_DiscountController');
        Route::post('place_discounts/visible', 'Place_DiscountController@place_discount_visible')->name('place_discounts/visible');
    });

    //============================== Company Location ============================
    Route::group(['namespace' => 'Admin'], function () {

        Route::resource('company_location', 'CompanyLocationController');
    });


    Route::group(['namespace' => 'Admin'], function () {

        Route::resource('company_words', 'Company_WordController');
        Route::post('company_words/visible', 'Company_WordController@company_word_visible')->name('company_words/visible');
    });

    //============================== Company Location ============================
    Route::group(['namespace' => 'Admin'], function () {

        Route::resource('socials', 'Social_MailController');
        Route::post('socials/visible', 'Social_MailController@socials_visible')->name('socials/visible');
    });

    //============================== Company Location ============================
    Route::group(['namespace' => 'Admin'], function () {

        Route::resource('join', 'JoinController');
    });
    //============================== Company Location ============================
    Route::group(['namespace' => 'Admin'], function () {

        Route::resource('chemical', 'ChemicalController');
        Route::post('chemical/visible', 'ChemicalController@chemical_visible')->name('chemical/visible');

    });
    //============================== Company Location ============================
    Route::group(['namespace' => 'Admin'], function () {

        Route::resource('contacts', 'ContactController');
        Route::post('contact/visible', 'ContactController@contact_visible')->name('contact/visible');

    });

    //============================== Company Advs ============================
    Route::group(['namespace' => 'Admin'], function () {

        Route::resource('advs', 'AdvController');
        Route::post('advs/visible', 'AdvController@advs_visible')->name('advs/visible');

    });



    // //==============================dashboard============================
    // Route::group(['namespace' => 'Grades'], function () {
    //     Route::resource('Grades', 'GradeController');
    // });

    // //==============================Classrooms============================
    // Route::group(['namespace' => 'Classrooms'], function () {
    //     Route::resource('Classrooms', 'ClassroomController');
    //     Route::post('delete_all', 'ClassroomController@delete_all')->name('delete_all');

    //     Route::post('Filter_Classes', 'ClassroomController@Filter_Classes')->name('Filter_Classes');

    // });


});






    //============================== Company Location ============================
    Route::group(['namespace' => 'Front'], function () {

        Route::get('front_login', 'Front_LoginController@index')->name('front_login');
        Route::post('front_sign', 'Front_LoginController@front_sign')->name('front_sign');
        Route::get('front_logout', 'Front_LoginController@front_logout')->name('front_logout');


        Route::get('home/aboutus', 'PagesController@aboutus')->name('home/aboutus');

        Route::get('home/electronic_card', 'PagesController@electronic_card')->name('home/electronic_card');
        Route::get('home/show_card', 'PagesController@show_card')->name('home/show_card');
        Route::get('home/join', 'PagesController@joins')->name('home/join');
        Route::post('home/join/subscripe', 'PagesController@subscripe')->name('home/join/subscripe');
        Route::get('home/search_card', 'PagesController@search_card')->name('home/search_card');


        Route::get('home/medical_request', 'PagesController@medical_request')->name('home/medical_request');
        Route::post('home/medical_request/send_request', 'PagesController@send_medical_request')->name('home/medical_request/send_request');

        Route::get('home/discount', 'PagesController@discount')->name('home/discount');

        Route::get('home/sections/{id}', 'PagesController@show_sections')->name('home/sections');
        Route::get('home/section/section_details/{category_id}/{region_id}', 'PagesController@show_section_details')->name('home/section/section_details');

        Route::get('home/section/place/{id}', 'PagesController@show_section_place')->name('home/section/place');

        Route::GET('/home/search', 'PagesController@home_search')->name('/home/search');

        Route::GET('/home/hududcard', 'PagesController@hududcard')->name('/home/hududcard');

        // =========================================================================
        Route::GET('/home/discount/regioncopon/{type}', 'CoponController@Show_regioncopon')->name('/home/discount/regioncopon');

        Route::GET('/home/discount/regioncopon/place/{id}', 'CoponController@Show_regioncopon_place')->name('/home/discount/regioncopon/place');

        Route::GET('/home/cards/find_card', 'CoponController@find_card')->name('/home/cards/find_card');








        Route::GET('/home/zoom_copon', 'CoponController@zoom_copon')->name('/home/zoom_copon');
        Route::GET('/home/zoom_copon/region/{type}', 'CoponController@Show_region_copon')->name('/home/zoom_copon/region');
        Route::GET('/home/zoom_copon/region/place/{id}', 'CoponController@Show_region_copon_place')->name('/home/zoom_copon/region/place');
        Route::GET('/home/zoom_discount_copon', 'CoponController@zoom_discount_copon')->name('/home/zoom_discount_copon');



        Route::GET('/home/zoom_discount', 'CoponController@zoom_discount')->name('/home/zoom_discount');
        Route::GET('/home/zoom_discount/region/{type}', 'CoponController@Show_region_discount')->name('/home/zoom_discount/region');
        Route::GET('/home/zoom_discount/region/place/{id}', 'CoponController@Show_region_discount_place')->name('/home/zoom_discount/region/place');
        Route::GET('/home/zoom_discount_copon', 'CoponController@zoom_discount_copon')->name('/home/zoom_discount_copon');



    });
