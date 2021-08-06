<!DOCTYPE html>
<html>

<head>
    @include('layouts.partials.head')
</head>

<body>
    <!-- start first info -->
    <div class="card-hodoud">
        <div class="container background-card py-4" style="    margin: 37px auto; border-radius: 15px;">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 text-center">
                    <img src="{{asset('app-assets/images/photo_2021-07-19_18-45-38.png')}}">
                </div>

                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                </div>

                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
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
                        <input type="text" placeholder="Membership No : {{ $currentuser->code_number }}">
                        <input type="text" placeholder=" Exp Data">
                    </form>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mt-4 py-4">
                    <form>
                        <input type="text" placeholder="Name : {{ $currentuser->name }}">
                        <input type="text" placeholder="ID NO : {{ $currentuser->id_number }}">
                        <input type="text" placeholder="Data Issue : {{ $currentuser->created_at->format('d/m/Y') }}">
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
    <!-- end first info -->




    @include('layouts.partials.footer-scripts')
</body>

</html>
