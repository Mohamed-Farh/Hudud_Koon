<!DOCTYPE html>
<html>

<head>
    <title>{{ $category->name }}</title>
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
                    <h2>{{ $category->name }}</h2>

                </div>

            </div>

        </div>



    </div>
    <!--end background section-->
    <!-- start images section -->
    <div class="img-section py-4">
        <div class="container">
            <div class="wrapper text-cenetr">
                <div class="row">


                    @foreach( $category->categories_media as $image )
                        <div class="col-xs-12 col-sm12 col-md-3 col-lg-3">
                            <div class="single-img">
                                <img src="{{ asset($image->path) }}" />
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- end images section -->



    <!-- start places buttons -->
    <div class="places-section py-4">
        <div class="container">


            <div class="row ">

                @foreach ($regoins as $region )
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 py-1">
                        <button><a href="/home/section/section_details/{{ $category->id }}/{{ $region->id }}">{{ $region->name }} - {{ $region->type }}</a></button>
                    </div>
                @endforeach


                {{-- <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 py-1">
                    <button><a href="mensection.html">الخرج والدلم</a></button>

                </div>

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 py-1">
                    <button><a href="mensection.html">القصيم</a></button>

                </div> --}}

            </div>



            {{-- <div class="row ">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 py-1">
                    <button><a href="mensection.html">الداودمي</a></button>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 py-1">
                    <button><a href="mensection.html">المزاحمية</a></button>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 py-1">
                    <button><a href="mensection.html">الافلاج</a></button>

                </div>

            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 py-1">
                    <button><a href="mensection.html">القويعية</a></button>

                </div>



            </div> --}}

        </div>

    </div>
    <!-- end places buttons  -->





    @include('layouts.partials.footer')
    @include('layouts.partials.footer-scripts')

</body>
@jquery
@toastr_js
@toastr_render

</html>
