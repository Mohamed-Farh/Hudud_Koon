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
                    <h2>{{ $category->name }}</h2>
                    <br>
                    <p style="color: white">{{ $region->name }} - {{ $region->type }}</p>

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
                    <div class="col-xs-12 xol-sm-12 col-md-6 col-lg-4" style="    margin-bottom: 20px;">
                        <div class="card card-men" style="width:100%">
                            <img src="/image/place/photo/{{ $place->photo }}" class="card-img-top " alt="...">
                            <div class="card-body ">
                                <a href="/home/section/place/{{ $place->id }}">
                                    <h5 class="card-title">{{$place->name}}</h5>
                                </a>
                                        <a href="https://api.whatsapp.com/send?phone={{ $place->phone }}" target="_blank" class="card-text"><i class="fab fa-whatsapp"></i> {{ $place->phone }} </a>
                                <p class="card-text">{{ $region->name }} - {{ $region->type }}</p>
                                <a href="{{ $place->url }}" target="_blank" class="btn btn-primary" style="    width: 88%;
                                    background: #90b557;
                                    border: 1px solid #90b557;">احجز الان</a>
                            </div>
                        </div>
                    </div>
                @endforeach



                {{-- <div class="col-xs-12 xol-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card card-men" style="width: 16rem;">
                        <img src="images/Capture1.PNG" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">صالون تجميل <i class="fab fa-whatsapp"><i
                                        class="fas fa-heart"></i></i></h5>
                            <p class="card-text">المنطقة الوسطى-الرياض</p>
                            <a href="#" class="btn btn-primary">احجز الان</a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 xol-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card card-men" style="width: 16rem;">
                        <img src="images/Capture1.PNG" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">صالون تجميل <i class="fab fa-whatsapp"><i
                                        class="fas fa-heart"></i></i></h5>
                            <p class="card-text">المنطقة الوسطى-الرياض</p>
                            <a href="#" class="btn btn-primary">احجز الان</a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 xol-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card card-men" style="width: 16rem;">
                        <img src="images/Capture1.PNG" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">صالون تجميل <i class="fab fa-whatsapp"></i><i
                                    class="fas fa-heart"></i></h5>
                            <p class="card-text">المنطقة الوسطى-الرياض</p>
                            <a href="#" class="btn btn-primary">احجز الان</a>
                        </div>
                    </div>
                </div> --}}

            </div>



            {{-- <div class="row text-cenetr">
                <div class="col-xs-12 xol-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card card-men" style="width: 16rem;">
                        <img src="images/Capture1.PNG" class="card-img-top " alt="...">
                        <div class="card-body ">
                            <h5 class="card-title"> صالون تجميل <i class="fab fa-whatsapp"></i><i
                                    class="fas fa-heart"></i></h5>
                            <p class="card-text">المنطقة الوسطى-الرياض</p>
                            <a href="#" class="btn btn-primary">احجز الان</a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 xol-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card card-men" style="width: 16rem;">
                        <img src="images/Capture1.PNG" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">صالون تجميل <i class="fab fa-whatsapp"><i
                                        class="fas fa-heart"></i></i></h5>
                            <p class="card-text">المنطقة الوسطى-الرياض</p>
                            <a href="#" class="btn btn-primary">احجز الان</a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 xol-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card card-men" style="width: 16rem;">
                        <img src="images/Capture1.PNG" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">صالون تجميل <i class="fab fa-whatsapp"><i
                                        class="fas fa-heart"></i></i></h5>
                            <p class="card-text">المنطقة الوسطى-الرياض</p>
                            <a href="#" class="btn btn-primary">احجز الان</a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 xol-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card card-men" style="width: 16rem;">
                        <img src="images/Capture1.PNG" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">صالون تجميل <i class="fab fa-whatsapp"></i><i
                                    class="fas fa-heart"></i></h5>
                            <p class="card-text">المنطقة الوسطى-الرياض</p>
                            <a href="#" class="btn btn-primary">احجز الان</a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row text-cenetr">
                <div class="col-xs-12 xol-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card card-men" style="width: 16rem;">
                        <img src="images/Capture1.PNG" class="card-img-top " alt="...">
                        <div class="card-body ">
                            <h5 class="card-title"> صالون تجميل <i class="fab fa-whatsapp"></i><i
                                    class="fas fa-heart"></i></h5>
                            <p class="card-text">المنطقة الوسطى-الرياض</p>
                            <a href="#" class="btn btn-primary">احجز الان</a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 xol-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card card-men" style="width: 16rem;">
                        <img src="images/Capture1.PNG" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">صالون تجميل <i class="fab fa-whatsapp"><i
                                        class="fas fa-heart"></i></i></h5>
                            <p class="card-text">المنطقة الوسطى-الرياض</p>
                            <a href="#" class="btn btn-primary">احجز الان</a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 xol-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card card-men" style="width: 16rem;">
                        <img src="images/Capture1.PNG" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">صالون تجميل <i class="fab fa-whatsapp"><i
                                        class="fas fa-heart"></i></i></h5>
                            <p class="card-text">المنطقة الوسطى-الرياض</p>
                            <a href="#" class="btn btn-primary">احجز الان</a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 xol-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card card-men" style="width: 16rem;">
                        <img src="images/Capture1.PNG" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">صالون تجميل <i class="fab fa-whatsapp"></i><i
                                    class="fas fa-heart"></i></h5>
                            <p class="card-text">المنطقة الوسطى-الرياض</p>
                            <a href="#" class="btn btn-primary">احجز الان</a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row text-cenetr">
                <div class="col-xs-12 xol-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card card-men" style="width: 16rem;">
                        <img src="images/Capture1.PNG" class="card-img-top " alt="...">
                        <div class="card-body ">
                            <h5 class="card-title"> صالون تجميل <i class="fab fa-whatsapp"></i><i
                                    class="fas fa-heart"></i></h5>
                            <p class="card-text">المنطقة الوسطى-الرياض</p>
                            <a href="#" class="btn btn-primary">احجز الان</a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 xol-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card card-men" style="width: 16rem;">
                        <img src="images/Capture1.PNG" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">صالون تجميل <i class="fab fa-whatsapp"><i
                                        class="fas fa-heart"></i></i></h5>
                            <p class="card-text">المنطقة الوسطى-الرياض</p>
                            <a href="#" class="btn btn-primary">احجز الان</a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 xol-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card card-men" style="width: 16rem;">
                        <img src="images/Capture1.PNG" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">صالون تجميل <i class="fab fa-whatsapp"><i
                                        class="fas fa-heart"></i></i></h5>
                            <p class="card-text">المنطقة الوسطى-الرياض</p>
                            <a href="#" class="btn btn-primary">احجز الان</a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 xol-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card card-men" style="width: 16rem;">
                        <img src="images/Capture1.PNG" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">صالون تجميل <i class="fab fa-whatsapp"></i><i
                                    class="fas fa-heart"></i></h5>
                            <p class="card-text">المنطقة الوسطى-الرياض</p>
                            <a href="#" class="btn btn-primary">احجز الان</a>
                        </div>
                    </div>
                </div>

            </div> --}}

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
