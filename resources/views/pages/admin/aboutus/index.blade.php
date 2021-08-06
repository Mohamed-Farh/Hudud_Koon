@extends('layouts.master')
@section('css')
    @toastr_css

@section('title')
    {{__('مـن نـحـن') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{__('مـن نـحـن') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">

<div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <?php
            $about_us = \App\Models\Front\Aboutus::all();
            $aboutus_count = \App\Models\Front\Aboutus::all()->count();
            ?>

            @if (auth()->user()->hasRole('super_admin'))
                @if ($aboutus_count == '0')
                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        {{ trans('اضـافـه') }}
                    </button>
                    <br><br>
                @endif
            @endif

            <!--start about us section-->
            @foreach ($about_us as $aboutus)
                @if (auth()->user()->hasRole(['super_admin', 'admin']))
                    @if ($aboutus_count != '0')
                        <button type="button" class="button x-small" data-toggle="modal" data-target="#edit{{ $aboutus->id }}">
                            {{__('تـعـديـل') }}
                        </button>
                    @endif
                @endif

                <br><br>
                <div class="row ">
                    <div class="col-12">
                        <h2 data-aos="fade-left" class="about-head">{{__('مـن نـحـن') }}</h2>
                        <p data-aos="fade-left" class="about-parag">
                            <td>{{ $aboutus->aboutus }}</td>
                        </p>
                    </div>
                </div>

                <!--end about us section-->

                <!--start last section-->
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="card prevs-cards text-center last-card-1">
                            <div class="card-body  ">
                                <h5 class="card-title about-head">{{__('أهـدافـنـا') }}</h5>
                                <p class="card-text about-parag1">
                                    <td>{{ $aboutus->vision }}</td>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="card prevs-cards text-center last-card-1">
                            <div class="card-body  ">
                                <h6 class="card-title about-head2">{{__(' رسـالـتـنـا') }}</h6>
                                <p class="card-text about-parag1">
                                    <td>{{ $aboutus->message }}</td>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- edit_modal_aboutus -->
                <div class="modal fade" id="edit{{ $aboutus->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                    id="exampleModalLabel">
                                    {{__(' تـعـديـل') }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- add_form -->
                                <form action="{{ route('aboutus.update', $aboutus->id) }}" method="post">
                                    {{ method_field('patch') }}
                                    @csrf
                                    <div class="form-group modual_space">
                                        <label for="exampleFormControlTextarea1">{{__('مـن نـحـن') }} :  <span style="color: red"> * </span> </label>
                                        <textarea class="form-control" name="aboutus" id="exampleFormControlTextarea1" rows="3" required>{{ $aboutus->aboutus }}</textarea>
                                    </div>

                                    <div class="form-group modual_space">
                                        <label for="exampleFormControlTextarea1">{{__(' رسـالـتـنـا') }} :  <span style="color: red"> * </span> </label>
                                        <textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="3" required>{{ $aboutus->message }}</textarea>
                                    </div>

                                    <div class="form-group modual_space">
                                        <label for="exampleFormControlTextarea1">{{__('أهـدافـنـا') }} :  <span style="color: red"> * </span> </label>
                                        <textarea class="form-control" name="vision" id="exampleFormControlTextarea1" rows="3" required>{{ $aboutus->vision }}</textarea>
                                    </div>
                                    <br><br>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">{{__('اغـلاق') }}</button>
                                        <button type="submit"
                                            class="btn btn-success">{{__('حفظ البيانات') }}</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>






            @endforeach
            <!--end last section-->
        </div>
    </div>
</div>


<!-- add_modal_aboutus -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{__('مـن نـحـن') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('aboutus.store') }}" method="POST">
                    @csrf
                    <div class="form-group modual_space">
                        <label for="exampleFormControlTextarea1">{{__('مـن نـحـن') }} :  <span style="color: red"> * </span> </label>
                        <textarea class="form-control" name="aboutus" id="exampleFormControlTextarea1" rows="3" required></textarea>
                    </div>

                    <div class="form-group modual_space">
                        <label for="exampleFormControlTextarea1">{{__(' رسـالـتـنـا') }} :  <span style="color: red"> * </span> </label>
                        <textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="3" required></textarea>
                    </div>

                    <div class="form-group modual_space">
                        <label for="exampleFormControlTextarea1">{{__('أهـدافـنـا') }} :  <span style="color: red"> * </span> </label>
                        <textarea class="form-control" name="vision" id="exampleFormControlTextarea1" rows="3" required></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{__('اغـلاق') }}</button>
                        <button type="submit"
                            class="btn btn-success">{{__('حفظ البيانات') }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>






<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render

<script type="text/javascript">
    $(document).ready(function() {
        $('.summernote').summernote({
            tabSize: 2,
            height: 100,
        });
        $("#summernote").code()
            .replace(/<\/p>/gi, "\n")
            .replace(/<br\/?>/gi, "\n")
            .replace(/<\/?[^>]+(>|$)/g, "");
    });
</script>
@endsection
