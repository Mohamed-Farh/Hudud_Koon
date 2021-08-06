@extends('layouts.master')
@section('css')
    @toastr_css


@section('title')
    {{ __('المراكز و المجمعات ') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ __('المراكز و المجمعات ') }}
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

            @if (auth()->user()->hasRole(['super_admin', 'admin']))
                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                    {{ __('اضـافـة') }}
                </button>
            @endif
            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('مسمي مقدم الخدمة') }}</th>
                            <th>{{ __('نوع مقدم الخدمة') }}</th>
                            <th>{{ __('المنطقة') }}</th>
                            <th>{{ __('المدينة') }}</th>
                            <th>{{ __('العنوان') }}</th>
                            <th>{{ __('الهاتف') }}</th>
                            <th>{{ __('المسؤول') }}</th>
                            <th>{{ __('جوال المسؤول') }}</th>
                            <th>{{ __('البريد الالكتروني') }}</th>
                            <th>{{ __('رابط الموقع على الخريطة') }}</th>

                            @if (auth()->user()->hasRole('super_admin'))
                                <th>{{ __('الـحـالـة') }}</th>
                                <th>{{ trans('users_trans.Processes') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0;
                            $chemicals = \App\Models\Chemical::orderBy('id', 'desc')->get();
                        ?>

                        @foreach ($chemicals as $chemical)
                            @if ($chemical)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td>{{ $chemical->name }}</td>
                                <td>{{ $chemical->type }}</td>
                                <td>{{ $chemical->place_zoom }}</td>
                                <td>{{ $chemical->region }}</td>
                                <td>{{ $chemical->address }}</td>
                                <td>{{ $chemical->phone }}</td>
                                <td>{{ $chemical->customer_name }}</td>
                                <td>{{ $chemical->customer_phone }}</td>
                                <td>{{ $chemical->email }}</td>
                                <td><a href="{{ $chemical->link }}" target="_blank" style="color: blue">{{__('الذهاب للموقع') }} </a></td>


                                @if (auth()->user()->hasRole('super_admin'))
                                    <td>
                                        @if ($chemical->status == '1')
                                            <button type="button" class="btn btn-primary"
                                                > <i class="fa fa-check"></i>
                                                {{ __('تم القبول') }} </button>
                                        @elseif ($chemical->status == '0')
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#vis_chemical{{ $chemical->id }}" >
                                                 <i class="fa fa-expeditedssl"></i> {{ __('انتظار') }} </button>
                                        @endif
                                    </td>
                                    <td>

                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $chemical->id }}" title="{{ __('حــذف') }}"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                @endif
                            </tr>


                            <!-- Make_chemical_accept -->
                            <div class="modal fade" id="vis_chemical{{ $chemical->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ __('قـبـول طـلـب هـذا الـمـركـز الـطـبـي بـالانـضـمـامـ؟') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('chemical/visible', 'test') }}" method="post">
                                                {{ method_field('post') }}
                                                @csrf
                                                @if ($chemical->status == '1')
                                                    {{ __('هـل أنـت مـتـأكـد مـن هـذه الـعـمـلـبـة') }}
                                                @elseif ($chemical->status == '0')
                                                    {{ __('هـل أنـت مـتـأكـد مـن هـذه الـعـمـلـبـة') }}
                                                @endif
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $chemical->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ __('اغــلاق') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-info">{{ __('حفظ البيانات') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- delete_modal_Join -->
                            <div class="modal fade" id="delete{{ $chemical->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ __('حـذف المراكز الطبية') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('chemical.destroy', 'test') }}"
                                                method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ __('هـل أنـت مـتـأكـد مـن هـذه الـعـمـلـبـة') }}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $chemical->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ __('اغــلاق') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-danger">{{ __('حــذف') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach

                </table>
            </div>
        </div>
    </div>
</div>


<!-- add_modal_social -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 130%">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ __('اضـافـة') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('chemical.store') }}" method="POST" enctype="multipart/form-data"
                    autocomplete="off">
                    @csrf
                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="name" class="mr-sm-2">{{ __('مسمي مقدم الخدمة') }} : <span style="color: red"> *
                                </span> </label>
                            <input type="text" class="form-control" name="name" required>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="type" class="mr-sm-2">{{ __('نوع مقدم الخدمة') }} : <span style="color: red"> *
                                </span> </label>
                            <input type="text" class="form-control" name="type" required>
                            @if ($errors->has('type'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group modual_space">
                        <div class="col">
                            <label class="mr-sm-2" for="place_zoom">{{__('المنطقة') }} :  <span style="color: red"> * </span> </label>
                            <select name="place_zoom" required class="form-control custom-select">
                                <option value="0">       {{__('اخـتـر---') }}                   </option>
                                <option value="المنطقة الشمالية" class="" > {{__('المنطقة الشمالية') }}  </option>
                                <option value="المنطقة الجنوبية" class="" > {{__('المنطقة الجنوبية') }}  </option>
                                <option value="المنطقة الوسطي"   class="" > {{__('المنطقة الوسطي') }}    </option>
                                <option value="المنطقة الشرقية"  class="" > {{__('المنطقة الشرقية') }}   </option>
                                <option value="المنطقة الغربية"  class="" > {{__('المنطقة الغربية') }}   </option>
                            </select>
                        </div>
                        @if ($errors->has('place_zoom'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('place_zoom') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group modual_space">
                        <div class="col">
                            <label class="mr-sm-2" for="region">{{ __('المدينة') }} : <span
                                    style="color: red"> * </span> </label>
                            <input type="text" class="form-control" name="region">
                            @if ($errors->has('region'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('region') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="address" class="mr-sm-2">{{ __('العنوان') }} : <span style="color: red"> *
                                </span> </label>
                            <input type="text" class="form-control" name="address">
                            @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="phone" class="mr-sm-2">{{ __('رقم التليفون') }} : <span style="color: red"> *
                                </span> </label>
                            <input type="text" class="form-control" name="phone">
                            @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="customer_name" class="mr-sm-2">{{ __('المسؤول') }} : <span style="color: red"> *
                                </span> </label>
                            <input type="text" class="form-control" name="customer_name" required>
                            @if ($errors->has('customer_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('customer_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="customer_phone" class="mr-sm-2">{{ __('جوال المسؤول ') }} : <span style="color: red"> *
                                </span> </label>
                            <input type="text" class="form-control" name="customer_phone">
                            @if ($errors->has('customer_phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('customer_phone') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="email" class="mr-sm-2">{{ __('البريد الالكتروني') }} : <span style="color: red"> *
                                </span> </label>
                            <input type="email" class="form-control" name="email">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="link" class="mr-sm-2">{{ __('رابط الموقع على الخريطة') }} : <span style="color: red"> *
                                </span> </label>
                            <input type="text" class="form-control" name="link" placeholder="برجاء ادخال لينك URL">
                            @if ($errors->has('link'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('link') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('اغــلاق') }}</button>
                        <button type="submit" class="btn btn-success">{{ __('حفظ البيانات') }}</button>
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

@endsection
