<!DOCTYPE html>
<html>

<head>
    <title>Page Title</title>
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
                        <h2>الـعـروض و الـكـوبـونـات</h2>
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


    <!-- start offer& discount section -->
    <div class="offers-discount-sec py-4 text-center">
        <div class="container py-4">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-2">
                    <button><a href="/home/zoom_discount"> العروض</a></button>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-2">
                    <button><a href="/home/zoom_copon"> الكوبونات</a></button>
                </div>
            </div>
        </div>
    </div>
    <!-- end offer& discount section -->


    <!-- start region section -->
    <div class="region-sec py-4 text-center">
        <div class="container">
            <div class="row py-4">
                 {{-- <?php $regions  = \App\Models\Region::get(); ?>

                 @foreach ($regions as  $region)
                    <div class="col-xs-12 col-sm-12 xol-md-4 col-lg-4 mb-4">
                        <div class="card" style="width: 100%;">
                            <div class="card-body">
                                <h5 class="card-title"><a href="/home/discount/regioncopon/{{ $region->type }}">{{ $region->type }}</a></h5>
                            </div>
                        </div>
                    </div>
                 @endforeach --}}


                <div class="col-xs-12 col-sm-12 xol-md-4 col-lg-4 mb-4">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title"><a href="/home/discount/regioncopon/{{'المنطقة الغربية'}}">المنطقة الغربية</a></h5>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 xol-md-4 col-lg-4 mb-4">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title"><a href="/home/discount/regioncopon/{{'المنطقة الشرقية'}}">المنطقة الشرقية</a></h5>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 xol-md-4 col-lg-4 mb-4">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title"><a href="/home/discount/regioncopon/{{'المنطقة الوسطي'}}">المنطقة الوسطي</a></h5>
                        </div>
                    </div>
                </div>
            </div>
                <div class="row py-2">
                    <div class="col-xs-12 col-sm-12 xol-md-4 col-lg-4 mb-4">
                        <div class="card" style="width: 100%;">
                            <div class="card-body">
                                <h5 class="card-title"><a href="/home/discount/regioncopon/{{'المنطقة الجنوبية'}}">المنطقة الجنوبية</a></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 xol-md-4 col-lg-4 mb-4">
                        <div class="card" style="width: 100%;">
                            <div class="card-body">
                                <h5 class="card-title"><a href="/home/discount/regioncopon/{{'المنطقة الشمالية'}}">المنطقة الشمالية</a></h5>
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
