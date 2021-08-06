@extends('layouts.master')
@section('css')
    @toastr_css


@section('title')
    {{ __('المـشـتـركـيـن') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ __('المـشـتـركـيـن') }}
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

            @if (auth()->user()->hasRole(['super_admin', 'super_admin_join', 'admin_join']))
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
                            <th>{{ __('الاســم') }}</th>
                            <th>{{ __('الكـــــود') }}</th>
                            <th>{{ __('الوكيل/الادمن') }}</th>
                            <th>{{ __('رقم الهوية') }}</th>
                            <th>{{ __('رقم التليفون') }}</th>
                            <th>{{ __('المنطقة') }}</th>
                            <th>{{ __('المدينة') }}</th>
                            <th>{{ __('العنوان') }}</th>
                            <th>{{ __('إيصال البنك') }}</th>
                            <th>{{ trans('admins_trans.created_at') }}</th>

                            @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                <th>{{ __('الـعـمـلـيـات') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 0;
                            $joins = \App\Models\Join::orderBy('id', 'desc')->get();
                        ?>

                        @foreach ($joins as $join)
                            @if ($join)
                            @if (auth()->user()->hasRole(['super_admin', 'super_admin_join']))
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $join->name }}</td>
                                    <td>{{ $join->code_number }}</td>

                                    <?php $user_name = \App\User::findOrFail($join->agent_id); ?>
                                    <td>{{ $user_name->name }}</td>

                                    <td>{{ $join->id_number }}</td>
                                    <td>{{ $join->phone }}</td>
                                    <td>{{ $join->place_zoom }}</td>
                                    <td>{{ $join->region }}</td>
                                    <td>{{ $join->address }}</td>

                                    <?php $cv  = $join->file; ?>
                                    <td><a href='/files/uploads/{{  $cv }}' target="_blank" style="color: blue">Open File</a></td>

                                    <td>{{ $join->created_at->diffForHumans() }}</td>

                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#edit{{ $join->id }}" title="{{ __('تـعـديـل') }}"><i
                                                class="fa fa-edit"></i></button>

                                        {{-- @if (auth()->user()->hasRole('super_admin')) --}}
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $join->id }}" title="{{ __('حــذف') }}"><i
                                                class="fa fa-trash"></i></button>
                                        {{-- @endif --}}
                                    </td>
                                </tr>
                            @else
                                <?php $user_name = \App\User::findOrFail($join->agent_id); ?>
                                @if ( Auth::user()->id == $join->agent_id)
                                    <tr>
                                        <?php $i++; ?>
                                        <td>{{ $i }}</td>
                                        <td>{{ $join->name }}</td>
                                        <td>{{ $join->code_number }}</td>
                                        <td>{{ $user_name->name }}</td>
                                        <td>{{ $join->id_number }}</td>
                                        <td>{{ $join->phone }}</td>
                                        <td>{{ $join->place_zoom }}</td>
                                        <td>{{ $join->region }}</td>
                                        <td>{{ $join->address }}</td>

                                        <?php $cv  = $join->file; ?>
                                        <td><a href='/files/uploads/{{  $cv }}' target="_blank" style="color: blue">Open PDF</a></td>

                                        <td>{{ $join->created_at->diffForHumans() }}</td>
                                    </tr>
                                @endif
                            @endif

                            <!-- edit_modal_joins-->
                            <div class="modal fade" id="edit{{ $join->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ __('تـعـديـل') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('join.update', 'test') }}" method="post"
                                            enctype="multipart/form-data" autocomplete="off">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $join->id }}">


                                                    <div class="form-group modual_space">
                                                        <div class="col">
                                                            <label for="name" class="mr-sm-2">{{ __('الاســم') }} : <span style="color: red"> *
                                                                </span> </label>
                                                            <input type="text" class="form-control" name="name" value="{{ $join->name }}" required>
                                                            @if ($errors->has('image'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('name') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group modual_space">
                                                        <div class="col">
                                                            <label for="id_number" class="mr-sm-2">{{ __('رقم الهوية') }} : <span style="color: red"> *
                                                                </span> </label>
                                                            <input type="number" class="form-control" name="id_number" value="{{ $join->id_number }}" required>
                                                            @if ($errors->has('id_number'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('id_number') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group modual_space">
                                                        <div class="col">
                                                            <label for="phone" class="mr-sm-2">{{ __('رقم التليفون') }} : <span style="color: red"> *
                                                                </span> </label>
                                                            <input type="text" class="form-control" name="phone" value="{{ $join->phone }}" required>
                                                            @if ($errors->has('image'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group modual_space">
                                                        <div class="col">
                                                            <label class="mr-sm-2" for="place_zoom">{{__('المنطقة') }} :  <span style="color: red"> * </span> </label>
                                                            <select name="place_zoom" required class="form-control custom-select">
                                                                <option value="0">       {{__('اخـتـر---') }}                   </option>
                                                                <option value="المنطقة الشمالية" <?php if($join->place_zoom == "المنطقة الشمالية")   echo "selected"; ?> > {{__('المنطقة الشمالية') }}  </option>
                                                                <option value="المنطقة الجنوبية" <?php if($join->place_zoom == "المنطقة الجنوبية")   echo "selected"; ?> > {{__('المنطقة الجنوبية') }}  </option>
                                                                <option value="المنطقة الوسطي"   <?php if($join->place_zoom == "المنطقة الوسطي")     echo "selected"; ?> > {{__('المنطقة الوسطي') }}    </option>
                                                                <option value="المنطقة الشرقية"  <?php if($join->place_zoom == "المنطقة الشرقية")    echo "selected"; ?> > {{__('المنطقة الشرقية') }}   </option>
                                                                <option value="المنطقة الغربية"  <?php if($join->place_zoom == "المنطقة الغربية")    echo "selected"; ?> > {{__('المنطقة الغربية') }}   </option>
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
                                                            <input type="text" class="form-control" name="region" value="{{ $join->region }}" required>
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
                                                            <input type="text" class="form-control" name="address" value="{{ $join->address }}" required>
                                                            @if ($errors->has('image'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('address') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    @if (auth()->user()->hasRole(['super_admin', 'super_admin_join']))
                                                        <div class="form-group modual_space">
                                                            <div class="col">
                                                                <label class="mr-sm-2"
                                                                    for="agent_id">{{ __('الـوكـيـل/الادمــن') }} : <span
                                                                        style="color: red"> * </span> </label>
                                                                <select name="agent_id" required
                                                                    class="form-control custom-select selectpicker">
                                                                    <option value="0"> {{ __('اخـتـر---') }} </option>
                                                                    @foreach (\App\User::all() as $user)
                                                                        <option <?php if ($join->agent_id == $user->id) { echo 'selected'; } ?> value="{{ $user->id }}">
                                                                            {{ $user->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @if ($errors->has('agent_id'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('agent_id') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <div class="form-group modual_space">
                                                        <div class="col">
                                                            <label for="file" class="mr-sm-2">{{ __('إيصال البنك') }} : <span style="color: red"> *
                                                                </span> </label>
                                                            <input type="file" class="form-control" name="file">
                                                            @if ($errors->has('file'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('file') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ __('اغــلاق') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-success">{{ __('حفظ البيانات') }}</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- delete_modal_Join -->
                            <div class="modal fade" id="delete{{ $join->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ __('حـذف مشترك') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('join.destroy', 'test') }}"
                                                method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ __('هـل أنـت مـتـأكـد مـن هـذه الـعـمـلـبـة') }}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $join->id }}">
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
        <div class="modal-content">
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
                <form action="{{ route('join.store') }}" method="POST" enctype="multipart/form-data"
                autocomplete="off">
                    @csrf
                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="name" class="mr-sm-2">{{ __('الاســم') }} : <span style="color: red"> *
                                </span> </label>
                            <input type="text" class="form-control" name="name" required>
                            @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="id_number" class="mr-sm-2">{{ __('رقم الهوية') }} : <span style="color: red"> *
                                </span> </label>
                            <input type="number" class="form-control" name="id_number" required>
                            @if ($errors->has('id_number'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('id_number') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    {{-- <div class="col-md-12 make-space">
                        <label for="password" class="mr-sm-2">{{ trans('كلمة المرور') }} :</label>
                        <input type="password" class="form-control" name="password" required autocomplete="new-password">
                    </div> --}}
                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="phone" class="mr-sm-2">{{ __('رقم التليفون') }} : <span style="color: red"> *
                                </span> </label>
                            <input type="text" class="form-control" name="phone">
                            @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
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
                            @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    @if (auth()->user()->hasRole(['super_admin', 'super_admin_join']))
                        <div class="form-group modual_space">
                            <div class="col">
                                <label class="mr-sm-2" for="agent_id">{{ __('الـوكـيـل/الادمــن') }} : <span
                                        style="color: red"> * </span> </label>
                                <select name="agent_id" required class="form-control custom-select selectpicker">
                                    <option value="0"> {{ __('اخـتـر---') }} </option>

                                    @foreach (\App\User::get() as $user)
                                        <option value="{{ $user->id }}"> {{ $user->name }} </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('agent_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('agent_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endif

                   <div class="form-group modual_space">
                        <div class="col">
                            <label for="file" class="mr-sm-2">{{ __('إيصال البنك') }} : <span style="color: red"> *
                                </span> </label>
                            <input type="file" class="form-control" name="file">
                            @if ($errors->has('file'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('file') }}</strong>
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
