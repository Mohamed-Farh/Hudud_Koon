<!DOCTYPE html>
<html>

<head>
    <title>الاشتراك</title>
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
                    <h4>الاشـتـراك  </h4>
                </div>
                <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
                <?php  $words = \App\Models\Company_Word::where('type', 'الاشتراك')->where('vision', '0')->get(); ?>
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
            <form action="{{ route('home/join/subscripe') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="row container">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <label for="name" class="mr-sm-2">{{ __('اسم المستخدم') }} : <span style="color: red"> * </span> </label>
                        <input type="text" name="name" class="form-control" required>
                            @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif

                        <label for="id_number" class="mr-sm-2">{{ __('رقم الهوية') }} : <span style="color: red"> * </span> </label>
                        <input type="number" class="form-control" name="id_number" required>
                            @if ($errors->has('id_number'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('id_number') }}</strong>
                                </span>
                            @endif

                        <label for="phone" class="mr-sm-2">{{ __('رقم التليفون') }} : <span style="color: red"> * </span> </label>
                        <input type="text" class="form-control" name="phone">
                            @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif

                        {{-- <label for="password" class="mr-sm-2">{{ trans('كلمة المرور') }} : <span style="color: red"> * </span> </label>
                        <input type="password" class="form-control" name="password" required autocomplete="new-password"> --}}
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
                            @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <label class="mr-sm-2" for="file" style="padding-right: 15px;">{{ __('إيصال البنك') }} : </label>
                            <input type="file" class="form-control" name="file">
                            @if ($errors->has('file'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('file') }}</strong>
                                </span>
                            @endif
                    </div>
                </div>

                <div class="row container py-3">
                    <div class="col">
                        <button class="button-1-save form-control" type="submit" style="color: white"> حـفـظ الـبـيـانـات </button>
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
