<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    @include('layouts.partials.head')
</head>

<body class="background-login">

    <div class="row">
        <div class="col-12">
            @include('layouts.partials.flash')
        </div>
    </div>

<!-- start background section -->
<div class="background-login">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 info-login">
                <h5>تسجيل الدخول</h5>
                <form action="/front_sign" method="POST">
                    @csrf
                    {{-- <label class="num-1">رقم الهوية/اسم المستخدم</label>
                    <input class="name" type="text"/>
                    <label class="num-1">كلمة المرور</label>
                    <input class="password" type="text"/>
                    <br>
                    <input class="checkbox" type="checkbox"><label class="remeberme">تذكرني</label> --}}


                    {{-- <button><a href="#">تسجيل الدخول</a></button> --}}
                    <div class="section-field mb-20 ">
                        <label class="num-1" for="id_number">البريدالالكتروني*</label>
                        <input id="id_number" type="number" autofocus name="id_number"class="name">
                        @error('id_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>

                    <div class="section-field mb-20">
                        <label class=" num-1" for="Password">كلمة المرور * </label>
                        <input id="password" type="password" name="password" class="password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>


                    <button  type="submit">{{ __('تسجيل الدخول') }}</button>

                </form>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

            </div>

        </div>

    </div>

</div>
 <!-- end background section -->













    @include('layouts.partials.footer-scripts')

</body>

</html>
