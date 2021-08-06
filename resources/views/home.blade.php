@extends('layouts.mainlayout')

@section('content')



    <!-- start background section -->
    <div class="background-home-sec py-4">
        <div class="container">
            <div class="row text-center py-4">
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">

                </div>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 ">
                    <h1>حدود الكون</h1>

                    <form action="{{ route('/home/search') }}" method="get">
                        {{ method_field('patch') }}
                        @csrf

                        <select name="type">
                            <option value="0"> {{ __('اخـتـر---') }} </option>
                            <option value="المنطقة الشمالية"> {{ __('المنطقة الشمالية') }} </option>
                            <option value="المنطقة الجنوبية"> {{ __('المنطقة الجنوبية') }} </option>
                            <option value="المنطقة الوسطي"> {{ __('المنطقة الوسطي') }} </option>
                            <option value="المنطقة الشرقية"> {{ __('المنطقة الشرقية') }} </option>
                            <option value="المنطقة الغربية"> {{ __('المنطقة الغربية') }} </option>
                        </select>

                        <input type="text" name="keyword">

                        <button type="submit" class="text-center" style="margin-top: 20px;">{{ __('بــحــث') }}</button>
                    </form>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                </div>
            </div>
        </div>
    </div>
    <!-- end background section -->

    <!-- start sale section -->
    {{-- <div class="adv-sale py-4">
    <div class="container  text-right">
        <i class="fas fa-times"></i>
        <div class="row text-right ">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <img src="{{asset('app-assets/images/Capture10.PNG')}}" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <p>- ﻧﺤﻦ ﻫﻨﺎ ﻣﻦ أﺟﻠﻚ 24 !دﻋﻢ ﻣﺒﺎﺷﺮ ﺳﺎﻋﺔ ﻃﻮال أﻳﺎم 24 إن اﻟﺪﻋﻢ اﻟﻤﺠﺎﻧﻲ اﻟﺬي ﻧﻘﺪﻣﻪ ﻋﻠﻰ ﻣﺪار .اﻷﺳﺒﻮع ﻣﺘﺎح
                    ﻟﻚ ﻫﻨﺎ</p>
            </div>
        </div>
    </div>
</div> --}}
    <!-- end sale section -->


    <?php
        $count_advs = \App\Models\Adv::where('status', '0')->count();
        $advs = \App\Models\Adv::where('status', '0')->get();
        $i = 0;
    ?>
    @if ($count_advs > '0')
        @foreach ($advs as $adv )
        <?php $i++;  ?>
            <div class="adv-sale py-4">
                <div class="container">
                    <div id="myDiv{{ $i }}">
                        <button class="close" onclick="document.getElementById('myDiv{{ $i }}').style.display='none'"> X </button>
                        <div class="row py-2">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-2 text-right">
                                <h2 style="color: #bbd88e; margin-top: 10px; font-weight:bolder">{{ $adv->title}}</h2>
                                <p style="    padding-top: 10px !important;">{{ $adv->description }}</p>
                                {{-- <i class="fas fa-phone-volume"></i><p> Call US : {{ $adv->phone }}</p> --}}


                                {{-- <div class="row py-2  mt-3" style="background-color: #bbd88e">
                                    <div class="col" style="background-color:white; text-align:center; margin: 8px;">
                                        <h6><strike>{{ $adv->price }} $</strike></h6>
                                    </div>
                                    <div class="col"style="background-color:white; text-align:center; margin: 8px;">
                                        <h6>{{ $adv->discount }} %</h6>
                                    </div>
                                    <div class="col"style="background-color:white; text-align:center; margin: 8px;">
                                        <h6>{{ $adv->new_price }} $</h6>
                                    </div>
                                </div>--}}
                                <div class="row"  style="background-color: #bbd88e; padding-bottom: 0px !important;">
                                    <div class="col" style="background-color:white; text-align:center; margin: 8px;">
                                        <h4><i class="fas fa-phone-volume"> Call US : {{ $adv->phone }}</i></h4>
                                    </div>
                                </div>

                                <div class="row mt-3"  style="background-color: #bbd88e; padding-bottom: 0px !important;">
                                    @if ($adv->video_link)
                                        <div class="col" style="background-color:white; text-align:center; margin: 8px;">
                                            <a href="{{ $adv->video_link }}" target="_blank" style="color: blue"> عرض فيديو</a>
                                        </div>
                                    @endif

                                    <div class="col" style="background-color:white; text-align:center; margin: 8px;">
                                        <a href="{{ $adv->url }}" target="_blank" style="color: blue"> زيارة الموقع</a>
                                    </div>
                                </div>

                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-2">
                                <img src="/image/adv_images/photo/{{ $adv->photo }}" style="width: 100%; height:100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    <!-- start popular section -->
    <div class="popular-section py-4">
        <div class="container">
            <h1 class="text-right">الفئات الاكثر شهرة</h1>
            <div class="row py-1">

                <?php $categories = \App\Models\Category::get(); ?>
                @foreach ($categories as $category)
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="ui-card">
                            <img src="/image/category/photo/{{ $category->photo }}">
                            <div class="description text-center">
                                <h3><a
                                        href="/home/sections/{{ $category->id }}">{{ \Str::limit($category->name, 50) }}</a>
                                </h3>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
    <!-- end popular section -->

    <!-- start footer -->
    <div class="footer-home py-4">
        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 info">
                    <i class="fas fa-map-marker-alt text-9 text-color-light mb-3 mt-2"></i>
                    <?php
                    $company_locations = \App\Models\Company_Location::all();
                    ?>
                    @foreach ($company_locations as $location)
                        <a href="{{ $location->link }}" target="_blank">
                            <p class="mb-0"> <strong> {{ $location->country }} - {{ $location->city }} -
                                    {{ $location->address }}</strong> </p>
                        </a>

                        <p><strong>حدود الكون : </strong> {{ $location->country }}</p>
                    @endforeach


                    <?php
                    $contacts = \App\Models\Contact::all();
                    ?>
                    @foreach ($contacts as $contact)
                        <p><strong>البريد الالكتروني</strong> : </p>
                        <p>{{ $contact->email }}</p>

                        <p><strong>الـهـاتـف</strong></p>
                        <p>{{ $contact->phone }}</p>

                        <p><strong>الـفـاكـس</strong></p>
                        <p>{{ $contact->fax }}</p>
                    @endforeach
                </div>
                <div class=" col-xs-12 col-sm-12 col-md-4 col-lg-4  pages-links text-center">
                    {{-- <p><strong><a href="#">english</a></strong></p> --}}
                    <p><strong><a href="{{ route('home/aboutus') }}">عن حدود</a></strong></p>
                    {{-- <p><strong><a href="{{ route('home/electronic_card') }}">اشترك الان</a></strong></p> --}}
                    <p><strong><a href="{{ route('home/electronic_card') }}">طلب البطاقة</a></strong></p>



                </div>


                <?php
                $whats = \App\Models\Company_Location::pluck('whats')->first();
                // dd($whats);
                $Twitters = \App\Models\Social_Mail::where('type', 'Twitter')->get();
                $Facebooks = \App\Models\Social_Mail::where('type', 'Facebook')->get();
                $YouTubes = \App\Models\Social_Mail::where('type', 'YouTube')->get();
                $Instagrams = \App\Models\Social_Mail::where('type', 'Instagram')->get();
                $G_Mails = \App\Models\Social_Mail::where('type', 'G_Mail')->get();
                $Yahoos = \App\Models\Social_Mail::where('type', 'Yahoo')->get();
                $Telegrams = \App\Models\Social_Mail::where('type', 'Telegram')->get();
                $Linkeds = \App\Models\Social_Mail::where('type', 'Linked')->get();
                ?>

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4  text-center">
                    {{-- <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i  class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a> --}}
                    <a href="https://api.whatsapp.com/send?phone={{ $whats }}" target="_blank"><i
                            class="fab fa-whatsapp whats"></i></a>
                            @foreach ($Facebooks as $Facebook )
                            @if($Facebook->status == '0')
                                <a href="{{ $Facebook->name }}" target="_blank"><i class="fab fa-facebook"></i></a>
                            @endif
                        @endforeach

                        @foreach ($Instagrams as $Instagram )
                            @if($Instagram->status == '0')
                                <a href="{{ $Instagram->name }}" target="_blank"><i class="fab fa-instagram"></i></a>
                            @endif
                        @endforeach

                        @foreach ($YouTubes as $YouTube )
                            @if($YouTube->status == '0')
                                <a href="{{ $YouTube->name }}" target="_blank"><i class="fab fa-youtube"></i></a>
                            @endif
                        @endforeach

                        @foreach ($Twitters as $Twitter )
                            @if($Twitter->status == '0')
                                <a href="{{ $Twitter->name }}" target="_blank"><i class="fab fa-twitter"></i></a>
                            @endif
                        @endforeach


                        @foreach ($G_Mails as $G_Mail )
                            @if($G_Mail->status == '0')
                                <a href="{{ $G_Mail->name }}" target="_blank"><i class="fa fa-envelope"></i></a>
                            @endif
                        @endforeach

                        @foreach ($Linkeds as $Linked )
                            @if($Linked->status == '0')
                                <a href="{{ $Linked->name }}" target="_blank"><i class="fab fa-linkedin"></i></a>
                            @endif
                        @endforeach

                        @foreach ($Yahoos as $Yahoo )
                            @if($Yahoo->status == '0')
                                <a href="{{ $Yahoo->name }}" target="_blank"><i class="fab fa-yahoo"></i></a>
                            @endif
                        @endforeach

                        @foreach ($Telegrams as $Telegram )
                            @if($Telegram->status == '0')
                                <a href="{{ $Telegram->name }}" target="_blank"><i class="fab fa-telegram"></i></a>
                            @endif
                        @endforeach



                    <p class="copy-right">جميع الحقوق محفوظة © 2021 ﺣﺪود اﻟﻜﻮن </p>














                </div>

            </div>

        </div>

    </div>
    <!-- end footer -->





@endsection
