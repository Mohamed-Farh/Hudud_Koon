<!DOCTYPE html>
<html>

<head>
    <title>العروض و الكوبونات</title>
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
                    <h2>الـعـروض و الـكـوبـونـات</h2>
                    <br>
                    <?php $place = \App\Models\Region::where('id', $id)->pluck('name')->first(); ?>
                    <h3 style="color: white">{{ $place }}</h3>
                </div>
            </div>
        </div>
    </div>
    <!--end background section-->

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


    <!-- start images sections -->
    <div class="images-sections py-4">
        <div class="container">
            <div class="row py-2">
                    @foreach ($place_discount as $discount )
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-2 text-right">
                            <h2 style="color: #bbd88e; padding-bottom:10px">{{ $discount->name }}</h2>
                            <p>{{ $discount->description }}</p>

                            <div class="row py-2  mt-3" style="background-color: #bbd88e">
                                <div class="col" style="background-color:white; text-align:center; margin: 8px;">
                                    <h6><strike>{{ $discount->price }} $</strike></h6>
                                </div>
                                <div class="col"style="background-color:white; text-align:center; margin: 8px;">
                                    <h6>{{ $discount->discount }} %</h6>
                                </div>
                                <div class="col"style="background-color:white; text-align:center; margin: 8px;">
                                    <h6>{{ $discount->new_price }} $</h6>
                                </div>
                            </div>

                            <div class="row py-2 mt-3"  style="background-color: #bbd88e" >
                                <div class="col" style="background-color:white; text-align:center; margin: 8px;">
                                    <p>{{ $discount->start_day }}</p>
                                </div>
                                {{-- <div class="col">
                                </div> --}}
                                <div class="col" style="background-color:white; text-align:center; margin: 8px;">
                                    <p> {{ $discount->end_day }}</p>
                                </div>
                            </div>

                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-2">
                            <img src="/image/place/product/{{ $discount->photo }}" style="width: 100%; height:100%">
                        </div>

                    @endforeach
            </div>

        </div>

    </div>
    <!-- end images sections -->














    <!-- start region cards section -->
    {{-- <div class="region-card-sec py-4 text-center">
        <div class="container">
            <div class="row py-2">

                @foreach ($places as $place )
                    <div class="col-xs-12 xol-sm-12 col-md-6 col-lg-4" style="    margin-bottom: 20px;">
                        <div class="card card-men" style="width: 100%;">
                            <img src="/image/place/photo/{{ $place->photo }}" class="card-img-top " alt="...">
                            <div class="card-body ">
                                <a href="/home/section/place/{{ $place->id }}">
                                    <h5 class="card-title">{{$place->name}}</h5>
                                </a>
                                        <a href="https://api.whatsapp.com/send?phone={{ $place->phone }}" target="_blank" class="card-text"><i class="fab fa-whatsapp"></i> {{ $place->phone }} </a>

                                        <?php $region = \App\Models\Region::where('id', $place->region_id)->first(); ?>
                                        <p class="card-text">{{ $region->name }} - {{ $region->type }}</p>
                                <a href="{{ $place->url }}" target="_blank" class="btn btn-primary" style="    width: 88%;
                                    background: #90b557;
                                    border: 1px solid #90b557;">احجز الان</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div> --}}
    <!-- end region cards section -->





    @include('layouts.partials.footer')
    @include('layouts.partials.footer-scripts')

</body>
@jquery
@toastr_js
@toastr_render

</html>
