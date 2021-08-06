<!DOCTYPE html>
<html>

<head>
    <title>كـن شـريـك مـعـنـا مـجـانـا</title>
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
                <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12 ">
                    <h2>كـن شريك معنا مجانا</h2>
                </div>
                <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12 ">
                <?php  $words = \App\Models\Company_Word::where('type', 'كن شريك معنا مجانا')->where('vision', '0')->get(); ?>
                    @foreach ($words as $word )
                        <p style="color: white; padding-top:15px; padding-bottom:50px;">{{ $word->description }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!--end background section-->


    <!-- start card information -->
    <div class="card-info py-4">
        <div class="container">
            <form action="{{ route('home/medical_request/send_request') }}" method="POST">
                @csrf
                <div class="row container">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <label for="name" class="mr-sm-2">{{ __('مسمي مقدم الخدمة') }} : <span style="color: red"> * </span> </label>
                        <input type="text" name="name" class="form-control" required>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif

                        <label for="type" class="mr-sm-2">{{ __('نوع مقدم الخدمة') }} : <span style="color: red"> * </span> </label>
                        <input type="text" name="type" class="form-control" required>
                            @if ($errors->has('type'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                            @endif

                        <label for="phone" class="mr-sm-2">{{ __('رقم التليفون') }} : <span style="color: red"> * </span> </label>
                        <input type="text" class="form-control" name="phone">
                            @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif

                        <label for="email" class="mr-sm-2">{{ __('البريد الالكتروني') }} : <span style="color: red"> * </span> </label>
                        <input type="email" class="form-control" name="email" required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif

                        <label for="link" class="mr-sm-2">{{ __('رابط الموقع على الخريطة') }} : <span style="color: red"> * </span> </label>
                        <input type="text" class="form-control" name="link" required>
                            @if ($errors->has('link'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('link') }}</strong>
                                </span>
                            @endif
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <label class="mr-sm-2" for="place_zoom">{{__('المنطقة') }} :  <span style="color: red"> * </span> </label>
                        <select name="place_zoom" required class="form-control custom-select">
                            <option value="0">       {{__('اخـتـر---') }}                   </option>
                            <option value="المنطقة الشمالية" class="" > {{__('المنطقة الشمالية') }}  </option>
                            <option value="المنطقة الجنوبية" class="" > {{__('المنطقة الجنوبية') }}  </option>
                            <option value="المنطقة الوسطي"   class="" > {{__('المنطقة الوسطي') }}    </option>
                            <option value="المنطقة الشرقية"  class="" > {{__('المنطقة الشرقية') }}   </option>
                            <option value="المنطقة الغربية"  class="" > {{__('المنطقة الغربية') }}   </option>
                        </select>
                            @if ($errors->has('place_zoom'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('place_zoom') }}</strong>
                                </span>
                            @endif

                        <label class="mr-sm-2" for="region">{{ __('المدينة') }} : <span
                                style="color: red"> * </span> </label>
                        <input type="text" class="form-control" name="region">
                            @if ($errors->has('region'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('region') }}</strong>
                                </span>
                            @endif

                        <label for="address" class="mr-sm-2">{{ __('العنوان') }} : <span style="color: red"> *
                            </span> </label>
                        <input type="text" class="form-control" name="address">
                            @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif

                        <label for="customer_name" class="mr-sm-2">{{ __('المسؤول') }} : <span style="color: red"> * </span> </label>
                        <input type="text" name="customer_name" class="form-control" required>
                            @if ($errors->has('customer_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('customer_name') }}</strong>
                                </span>
                            @endif

                        <label for="customer_phone" class="mr-sm-2">{{ __('جوال المسؤول') }} : <span style="color: red"> * </span> </label>
                        <input type="text" class="form-control" name="customer_phone">
                            @if ($errors->has('customer_phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('customer_phone') }}</strong>
                                </span>
                            @endif


                    </div>
                </div>

                <div class="row container py-3">
                    <div class="col">
                        <button class="button-1-save form-control" type="submit" style="color: white">طـلـب الانـضـمـام </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- end card information -->




    @include('layouts.partials.footer')
    @include('layouts.partials.footer-scripts')
</body>
@jquery
@toastr_js
@toastr_render

</html>
