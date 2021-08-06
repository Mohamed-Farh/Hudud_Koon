<!DOCTYPE html>
<html>

<head>
    <title>  الكوبونات</title>
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
                    <h2>  الـكـوبـونـات</h2>
                    <br>
                    <h3 style="color: white">{{ $type }}</h3>
                </div>
            </div>
        </div>
    </div>
    <!--end background section-->



    <!-- start region header section -->
    <div class="region-header py4 text-center">
        <div class="container">
            <h1>
                {{-- {{ $type }} --}}
            </h1>
        </div>
    </div>
    <!-- end region header section -->

    <!-- start region cards section -->
    <div class="region-card-sec py-4 text-center">
        <div class="container">
            <div class="row py-2">

                @foreach ($regions as $region)
                    <div class="col-xs-12 col-sm-12 xol-md-4 col-lg-4 mb-4">
                        <div class="card" style="width: 100%;">
                            <div class="card-body">
                                <h5 class="card-title"><a href="/home/zoom_copon/region/place/{{ $region->id }}">{{ $region->name }}</a></h5>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- end region cards section -->





    @include('layouts.partials.footer')
    @include('layouts.partials.footer-scripts')

</body>
@jquery
@toastr_js
@toastr_render

</html>
