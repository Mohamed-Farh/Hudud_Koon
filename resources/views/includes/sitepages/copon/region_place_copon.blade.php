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
                    <?php $region = \App\Models\Region::where('id', $id)->first(); ?>
                    <h3 class="card-text" style="color: white">{{ $region->name }} - {{ $region->type }}</h3>
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
                <?php  $count_discount = \App\Models\Place_Discount::where('type', 'كوبون')->where('place_id', $place->id)->count();  ?>
                @if ($count_discount > '0')
                    @foreach ($place_discount as $discount )
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-2 text-right">
                            <h2 style="color: #bbd88e; padding-bottom:10px; font-weight:bold">{{ $discount->name }}</h2>
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
                                    <p>{{ $discount->start_day }} >></p>
                                </div>
                                {{-- <div class="col">
                                </div> --}}
                                <div class="col" style="background-color:white; text-align:center; margin: 8px;">
                                    <p>>> {{ $discount->end_day }}</p>
                                </div>
                            </div>

                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-2">
                            <img src="/image/place/product/{{ $discount->photo }}" style="width: 100%; height:100%">
                        </div>
                    @endforeach
                @else
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h1 style="text-align: center">عفوا لايوجد اي كوبونات في الوقت الحالي </h1>
                    </div>
                @endif
            </div>

        </div>

    </div>
    <!-- end images sections -->





    @include('layouts.partials.footer')
    @include('layouts.partials.footer-scripts')

</body>
@jquery
@toastr_js
@toastr_render

</html>
