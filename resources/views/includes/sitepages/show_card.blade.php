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


@if ($card_no != '')

    <div class="card-section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                </div>

                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="card-hodoud">
                        <div class="container background-card py-4" style="     margin: 37px auto; border-radius: 15px;">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 text-center">
                                    <img src="{{asset('app-assets/images/photo_2021-07-19_18-45-38.png')}}">
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 text-left">
                                    <p> رؤية vision </p>
                                    <p class="para"> 2030 </p>
                                    <p>
                                         المملكة العربية السعودية
                                    </p>
                                    <p> Kingdom Of Audia Arabia  </p>
                                </div>
                            </div>

                            <div class="row py-4">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mt-4 py-4">
                                    <form>
                                        {{-- <input type="text" placeholder="Membership No : {{ $currentuser->code_number }}">
                                        <input type="text" placeholder=" Exp Data"> --}}
                                        <p style="text-align: left;font-size: 20px;color: white"> Membership No : {{ $card_no->code_number }} </p>
                                        <br>
                                        <p style="text-align: left;font-size: 20px;color: white"> Exp Data : {{ $card_no->created_at->addYear()->format('d/m/Y') }}</p>
                                    </form>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mt-4 py-4">
                                    <form>
                                        {{-- <input type="text" placeholder="Name : {{ $currentuser->name }}">
                                        <input type="text" placeholder="ID NO : {{ $currentuser->id_number }}">
                                        <input type="text" placeholder="Data Issue : {{ $currentuser->created_at->format('d/m/Y') }}"> --}}

                                        <p style="text-align: left;font-size: 20px;color: white">{{__(' Name : ') }}{{ $card_no->name }} </p>
                                        <p style="text-align: left;font-size: 20px;color: white"> ID NO : {{ $card_no->id_number }} </p>
                                        <p style="text-align: left;font-size: 20px;color: white" > Data Issue : {{ $card_no->created_at->format('d/m/Y') }} </p>


                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                                    <p>
                                        اي تعديل للبيانات يعد تزوير يعرضك للمسائلة القانونية
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                </div>

            </div>
        </div>

    </div>



    {{-- @guest

    <div class="card-section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                </div>

                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="card-hodoud">
                        <div class="container background-card py-4" style="     margin: 37px auto; border-radius: 15px;">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 text-center">
                                    <img src="{{asset('app-assets/images/photo_2021-07-19_18-45-38.png')}}">
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 text-left">
                                    <p> رؤية vision </p>
                                    <p class="para"> 2030 </p>
                                    <p>
                                         المملكة العربية السعودية
                                    </p>
                                    <p> Kingdom Of Audia Arabia  </p>
                                </div>
                            </div>

                            <div class="row py-4">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mt-4 py-4">
                                    <form>
                                        <p style="text-align: left;font-size: 20px;color: white"> Membership No : {{ $currentuser->code_number }} </p>
                                        <br>
                                        <p style="text-align: left;font-size: 20px;color: white"> Exp Data : {{ $currentuser->created_at->addYear()->format('d/m/Y') }}</p>
                                    </form>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mt-4 py-4">
                                    <form>
                                        <p style="text-align: left;font-size: 20px;color: white"> Name : {{ $currentuser->name }} </p>
                                        <p style="text-align: left;font-size: 20px;color: white"> ID NO : {{ $currentuser->id_number }} </p>
                                        <p style="text-align: left;font-size: 20px;color: white" > Data Issue : {{ $currentuser->created_at->format('d/m/Y') }} </p>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                                    <p>
                                        اي تعديل للبيانات يعد تزوير يعرضك للمسائلة القانونية
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                </div>

            </div>
        </div>
    </div>
    @endguest --}}
@endif




    @include('layouts.partials.footer')
    @include('layouts.partials.footer-scripts')

</body>
@jquery
@toastr_js
@toastr_render

</html>
