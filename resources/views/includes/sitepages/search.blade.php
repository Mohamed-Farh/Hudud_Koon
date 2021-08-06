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
            <div class="row text-right">
                <div class="col-md-4 m-4">
                </div>

            </div>

        </div>



    </div>
    <!--end background section-->

    <!-- start card section -->
    <div class="cards-sec py-4 text-center">
        <div class="container">
            <div class="row text-cenetr">

                @foreach ($places as $place )
                    <div class="col-xs-12 xol-sm-6 col-md-6 col-lg-4 col-xl-4">
                        <div class="card card-men">
                            <img src="/image/place/photo/{{ $place->photo }}" class="card-img-top " alt="..." style="height: 250px; object-fit:cover; width:100% " >
                            <div class="card-body ">
                                <a href="/home/section/place/{{ $place->id }}">
                                    <h5 class="card-title">{{$place->name}}</h5>
                                </a>
                                        <a href="https://api.whatsapp.com/send?phone={{ $place->phone }}" target="_blank" class="card-text"><i class="fab fa-whatsapp"></i> {{ $place->phone }} </a>

                                <?php
                                    $region = \App\Models\Region::where('id', $place->region_id)->first();
                                ?>
                                        <p class="card-text">{{ $region->name }} - {{ $region->type }}</p>
                                <a href="{{ $place->url }}" target="_blank" class="btn btn-primary">احجز الان</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>


        </div>

    </div>
    <!-- end card section -->






        @include('layouts.partials.footer')
        @include('layouts.partials.footer-scripts')

    </body>
    @jquery
    @toastr_js
    @toastr_render
</html>
