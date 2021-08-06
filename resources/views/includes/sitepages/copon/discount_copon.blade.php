<!DOCTYPE html>
<html>

<head>
    <title>الكوبونات</title>
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
            <div class="row text-right m-4" style="">
                <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
                    <h2>  الـكـوبـونـات</h2>
                </div>
                <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
                <?php  $words = \App\Models\Company_Word::where('type', 'العروض و الكوبونات')->where('vision', '0')->get(); ?>
                    @foreach ($words as $word )
                        <p style="color: white; padding-top:15px; padding-bottom:50px;">{{ $word->description }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!--end background section-->



    <!-- start paragraph section -->
    <div class="paragraph-1 py-4 text-right">
        <div class="container">
            <p> </p>
        </div>
    </div>
    <!-- end paragraph section -->



    <!-- start region section -->
    <div class="region-sec py-4 text-center">
        <div class="container">
            <div class="row py-4">
                <div class="col-xs-12 col-sm-12 xol-md-4 col-lg-4 mb-4">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title"><a href="/home/zoom_copon/region/{{'المنطقة الغربية'}}">المنطقة الغربية</a></h5>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 xol-md-4 col-lg-4 mb-4">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title"><a href="/home/zoom_copon/region/{{'المنطقة الشرقية'}}">المنطقة الشرقية</a></h5>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 xol-md-4 col-lg-4 mb-4">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title"><a href="/home/zoom_copon/region/{{'المنطقة الوسطي'}}">المنطقة الوسطي</a></h5>
                        </div>
                    </div>
                </div>
            </div>
                <div class="row py-2">
                    <div class="col-xs-12 col-sm-12 xol-md-4 col-lg-4 mb-4">
                        <div class="card" style="width: 100%;">
                            <div class="card-body">
                                <h5 class="card-title"><a href="/home/zoom_copon/region/{{'المنطقة الجنوبية'}}">المنطقة الجنوبية</a></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 xol-md-4 col-lg-4 mb-4">
                        <div class="card" style="width: 100%;">
                            <div class="card-body">
                                <h5 class="card-title"><a href="/home/zoom_copon/region/{{'المنطقة الشمالية'}}">المنطقة الشمالية</a></h5>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-xs-12 col-sm-12 xol-md-4 col-lg-4 mb-4">
                        <div class="card" style="width: 100%;">
                            <div class="card-body">
                                <h5 class="card-title"><a href="regioncoupons.html">مملكة البحرين</a></h5>
                            </div>
                        </div>
                    </div> --}}
                </div>
        </div>
    </div>
    <!-- end region section -->




    @include('layouts.partials.footer')
    @include('layouts.partials.footer-scripts')

</body>
@jquery
@toastr_js
@toastr_render

</html>
