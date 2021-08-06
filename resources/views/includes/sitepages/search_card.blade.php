<!DOCTYPE html>
<html>

<head>
    <title>اعرض بطاقتي الالكترونية</title>
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
                    <h2>اعرض بطاقتي الالكترونية</h2>
                </div>
            </div>
        </div>
    </div>
    <!--end background section-->


    <!-- start paragraph section -->
    <div class="para-section-card py-4 text-center">
        <div class="container">
        </div>

    </div>
    <!-- end paragraph section -->
    <!-- start button section -->
    <div class="button-section4 py-4">
        <div class="container ">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">

                </div>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 py-4 col-cards-7dod">
                    <form action="{{ route('/home/cards/find_card') }}" method="get">
                        {{ method_field('patch') }}
                        @csrf
                        <input type="text" placeholder="ادخل رقم الهوية" name="card_no">
                        <button type="submit" >استعلام </button>
                    </form>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">

                </div>

            </div>

        </div>

    </div>
    <!-- end button section -->






    @include('layouts.partials.footer')
    @include('layouts.partials.footer-scripts')

</body>
@jquery
@toastr_js
@toastr_render

</html>
