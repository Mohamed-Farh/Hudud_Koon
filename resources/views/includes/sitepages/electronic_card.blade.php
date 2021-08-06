<!DOCTYPE html>
<html>

<head>
    <title>الاشتراك بالبطاقة الالكترونية</title>
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
                    <h4>الاشتراك بالبطاقة الالكترونية</h4>
                </div>
                <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
                <?php  $words = \App\Models\Company_Word::where('type', 'اشترك الآن')->where('vision', '0')->get(); ?>
                    @foreach ($words as $word )
                        <p style="color: white; padding-top:15px; padding-bottom:50px;">{{ $word->description }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!--end background section-->


    <!-- start paragraph section -->
    <div class="para-section-card py-4 text-center">
        <div class="container">
            {{-- <p>اﻟﺨﺪﻣﺔ ﺧﺎﺻﺔ ﺑﻤﺴﺘﻔﻴﺪي اﻟﻀﻤﺎن اﻻﺟﺘﻤﺎﻋﻲ واﻟﺠﻤﻌﻴﺎت اﻟﺨﻴﺮﻳﺔ اﻟﺘﺴﺠﻴﻞ ﻣﺘﺎح وﻟﺘﻔﻌﻴﻞ اﺷﺘﺮاﻛﻚ ﻳﺠﺐ ﻣﺸﺎرﻛﺔ راﺑﻂ
                ﺗﺴﺠﻴﻠﻚ ﻣﻊ ﻣﺴﺘﻔﻴﺪ اﺧﺮ وﻳﻘﻮم اﻟﻤﺴﺘﻔﻴﺪ اﻻﺧﺮ ﺑﻤﺸﺎرﻛﺔ راﺑﻂ ﺗﺴﺠﻴﻠﻪ ﻣﻊ ﻣﺴﺘﻔﻴﺪ ﺛﺎﻟﺚ وﻫﻜﺬا</p> --}}
        </div>
    </div>
    <!-- end paragraph section -->



    <!-- start buttons section -->
    <div class="buttons-sec text-cenetr">
        <div class="container">
            <div class="row text-cenetr py-1">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <button><a href="{{ route('home/join') }}"> الاشتراك بالبطاقة الالكترونية</a></button>
                </div>
                <div class="col-md-4">
                </div>
            </div>

            {{-- <div class="row text-cenetr py-1">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <button><a href="{{ route('home/show_card') }}"> اعرض بطاقتي الالكترونية</a></button>
                </div>
                <div class="col-md-4">
                </div>
            </div> --}}

            <div class="row text-cenetr py-1">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <button><a href="{{ route('home/search_card') }}"> استعلام/عرض البطاقة</a></button>
                </div>
                <div class="col-md-4">
                </div>
            </div>
        </div>
    </div>
    <!-- end buttons section -->





    @include('layouts.partials.footer')
    @include('layouts.partials.footer-scripts')


    </body>
    @jquery
    @toastr_js
    @toastr_render
</html>
