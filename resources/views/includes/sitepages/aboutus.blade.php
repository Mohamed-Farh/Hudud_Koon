<!DOCTYPE html>
<html>

<head>
    <title>عن حدود الكون</title>
    @include('layouts.partials.head')
    @toastr_css

</head>

<body>
    @include('layouts.partials.nav')
    <div class="row">
        <div class="col-12">
            @include('layouts.partials.flash')
        </div>
    </div>


    <!--start background section-->
    <div class="background-sec">
        <div class="container">
            <div class="row text-right">
                <div class="col-md-4 m-4">
                    <h2>عن حدود الكون</h2>
                </div>
            </div>
        </div>
    </div>
    <!--end background section-->

    <!-- start about us section -->
    <div class="about-us-sec py-4 ">
        <div class="container">

            @foreach ($about_us as $about)
                <div class="row py-2">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
                        <p style="text-align: center; margin-bottom: 20px;">{{ $about->aboutus }}</p>
                    </div>

                </div>

                <div class="row ">
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 text-center  " style="background: #90b557; margin-bottom: 10px;">
                        <a>
                            <img src="{{ asset('app-assets/images/photo_2021-07-19_20-18-36.png') }}">
                            <p class="mb-0 description-about" >
                                <strong style=" color: white !important;font-size: 21px !important;">رسالتنا </strong>

                                <span class="d-block text-2 p-relative bottom-3 Font_01 text-3 mt-2  Font_Clean" style=" color: white !important;
                                    font-size: 21px !important;"> {{ $about->message }}</span>
                            </p>
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 text-center"  style="margin-bottom: 10px;"></div>
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 text-center" style="background: #90b557; margin-bottom: 10px;">
                        <a>
                            <img src="{{ asset('app-assets/images/photo_2021-07-19_20-18-36.png') }}">
                            <p class="mb-0 description-about">
                                <strong style=" color: white !important;font-size: 21px !important;">اهدافنا</strong>

                                <span class="d-block text-2 p-relative bottom-3 Font_01 text-3 mt-2  Font_Clean" style=" color: white !important;
                                font-size: 21px !important;">{{ $about->vision }}</span>
                            </p>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
    <!-- end about us section -->






    @include('layouts.partials.footer')
    @include('layouts.partials.footer-scripts')

</body>
@jquery
@toastr_js
@toastr_render

</html>
