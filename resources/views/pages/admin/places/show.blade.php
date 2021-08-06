@extends('layouts.master')
@section('css')
    @toastr_css

    <style type="text/css">

        /*body {margin:2rem;}*/
        .modal-dialog {
              max-width: 800px;
              margin: 30px auto;
          }
        .modal-body {
          position:relative;
          padding:0px;
        }
        .close {
          position:absolute;
          right:-30px;
          top:0;
          z-index:999;
          font-size:2rem;
          font-weight: normal;
          color:#fff;
          opacity:1;
        }
    </style>
@section('title')
    {{__('الـمـكـان') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{__('الـمـكـان') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
@if ($errors->any())
    <div class="error">{{ $errors->first('Name') }}</div>
@endif

<style type="text/css">

    /*body {margin:2rem;}*/
    .modal-dialog {
          max-width: 800px;
          margin: 30px auto;
      }
    .modal-body {
      position:relative;
      padding:0px;
    }
    .close {
      position:absolute;
      right:-30px;
      top:0;
      z-index:999;
      font-size:2rem;
      font-weight: normal;
      color:#fff;
      opacity:1;
    }
</style>

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


            <div class="title_design">
                <h2 class="h2-space" style="color: white">{{ \Str::limit($place->name, 100) }}</h2>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                    <img class="single_photo" src="{{ url('/image/place/photo/' . $place->photo) }}" alt="Property Photo" style="width: 100%; height:540px;">
                </div>

                {{-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                    <table class="table table-striped" style="padding-top: 20px;">
                        <tbody>
                            <tr>
                                <th></th>
                                <th>{{ trans('property_trans.price') }}</th>
                                <th>{{ $property->price }}</th>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <th>{{ trans('property_trans.size') }}</th>
                                <th>{{ $property->size }}</th>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <th>{{ trans('property_trans.discount') }}</th>
                                <th>{{ $property->discount }}</th>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <th>{{ trans('property_trans.new_price') }}</th>
                                <th>{{ $property->new_price }}</th>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <table class="table table-striped" style="padding-top: 20px;">
                        <tbody>
                            <tr>
                                <th></th>
                                <th>{{ trans('property_trans.Used') }}</th>
                                <th>{{ $property->used == 'used' ? trans('property_trans.used') : trans('property_trans.new') }}
                                </th>
                            </tr>
                            <tr>
                                <th></th>
                                <th>{{ trans('property_trans.purpose') }}</th>
                                <th>{{ $property->used == 'rent' ? trans('property_trans.rent') : trans('property_trans.sale') }}
                                </th>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <th>{{ trans('property_trans.floornumber') }}</th>
                                <th>{{ $property->floornumber }}</th>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <th>{{ trans('property_trans.bedroom') }}</th>
                                <th>{{ $property->bedroom }}</th>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <th>{{ trans('property_trans.bathroom') }}</th>
                                <th>{{ $property->bathroom }}</th>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <th>{{ trans('property_trans.no_of_floor') }}</th>
                                <th>{{ $property->no_of_floor }}</th>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <table class="table table-striped" style="padding-top: 20px;">
                        <tbody>

                            <tr>
                                <th></th>
                                <th>{{ trans('property_trans.category_id') }}</th>
                                @if (App::getLocale() == 'en')
                                    @if ($property->category->name_en !='')
                                        <th>{{ \Str::limit($property->category->name_en,25)}}</th>
                                    @else
                                        <th>{{ \Str::limit($property->category->name_ar,25)}}</th>
                                    @endif
                                @else
                                    <th>{{ \Str::limit($property->category->name_ar,25)}}</th>
                                @endif

                            <tr>

                            <tr>
                                <th></th>
                                <th>{{ trans('property_trans.city') }}</th>
                                @if (App::getLocale() == 'en')
                                    @if ($property->city_en != '')
                                        <th>{{ $property->city_en }}</th>
                                    @else
                                        <th>{{ $property->city_ar }}</th>
                                    @endif
                                @else
                                    <th>{{ $property->city_ar }}</th>
                                @endif
                            </tr>
                            <tr>
                                <th></th>
                                <th>{{ trans('property_trans.address') }}</th>
                                @if (App::getLocale() == 'en')
                                    @if ($property->address_en != '')
                                        <th>{{ $property->address_en }}</th>
                                    @else
                                        <th>{{ $property->address_ar }}</th>
                                    @endif
                                @else
                                    <th>{{ $property->address_ar }}</th>
                                @endif
                            </tr>
                        </tbody>
                    </table>

                    @if ($property->video)
                        <div class="col" style="text-align: center">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary video-btn primary-btn text-uppercase" data-toggle="modal" data-src="{{ $property->video }}" data-target="#myModal">
                                <i class="fa fa-youtube"></i> Watch Video Of Property
                            </button>
                        </div>
                    @endif

                </div> --}}



            <table class="table align-items-center table-flush small_space">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">{{ trans('property_trans.description') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <th>{{ $place->description }}</th>
                </tbody>
            </table>


            <div class="container space">
                {{-- <h1>{{$vendor->title}}</h1> --}}

                <div id="map-canvas" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"></div>
            </div>

        </div>

        <!-- start map section -->
        <div class="map-section py-4">
            <div class="container">
            <iframe src="{{ $place->map }}" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

            </div>

        </div>
        <!-- end map section -->



    </div>
</div>
<!-- row closed -->
@endsection





