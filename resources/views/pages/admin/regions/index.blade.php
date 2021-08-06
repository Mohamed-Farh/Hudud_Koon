@extends('layouts.master')
@section('css')
    @toastr_css


@section('title')
{{__('مـنـطـقـة - حــي') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{__('مـنـطـقـة - حــي') }}
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
                    {{__('اضـافـة')}}
                </button>
            @endif
            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('الاســم')}}</th>
                            <th>{{ __('الـعـمـيـل') }}</th>
                            <th>{{__('الـمـنـطـقـة')}}</th>
                            @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                <th>{{__('الـحـالـة')}}</th>
                                <th>{{__('الـعـمـلـيـات')}}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($regions as $region)
                        <?php $user_name = \App\User::findOrFail($region->agent_id); ?>
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td>{{ $region->name }}</td>
                                <td>{{ $user_name->name }}</td>
                                <td>{{ $region->type }}</td>

                                @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                    <td>
                                        @if  ($region->status == '1')
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#vis_region{{ $region->id }}"
                                            title="{{ trans('social_trans.Delete') }}"> <i class="fa fa-eye"></i> {{__('عـرض')}} </button>
                                        @elseif ($region->status == '0')
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#vis_region{{ $region->id }}"
                                            title="{{ trans('social_trans.Delete') }}"> <i class="fa fa-eye-slash"></i> {{__('اخـفـاء')}} </button>
                                        @endif
                                    </td>
                                    <td>
                                        <?php $current_user = Auth::user()->id;  ?>
                                        @if ($current_user == $region->agent_id | auth()->user()->hasRole('super_admin'))
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $region->id }}"
                                                title="{{__('تـعـديـل')}}"><i
                                                    class="fa fa-edit"></i></button>
                                        @endif

                                        @if (auth()->user()->hasRole('super_admin'))
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $region->id }}"
                                                title="{{__('حــذف')}}"><i
                                                    class="fa fa-trash"></i></button>
                                        @endif
                                    </td>
                                @endif
                            </tr>

                            <!-- edit_modal_social -->
                            <div class="modal fade" id="edit{{ $region->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{__('تـعـديـل')}}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('regions.update', 'test') }}" method="post">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $region->id }}">
                                                <div class="form-group modual_space">
                                                    <div class="col">
                                                        <label for="name" class="mr-sm-2">{{__('الاســم') }} :  <span style="color: red"> * </span> </label>
                                                        <input type="text" class="form-control" name="name" value="{{ $region->name }}">
                                                    </div>
                                                </div>
                                                <div class="form-group modual_space">
                                                    <div class="col">
                                                        <label class="mr-sm-2"
                                                            for="agent_id">{{ __('الـوكـيـل') }} : <span
                                                                style="color: red"> * </span> </label>
                                                        <select name="agent_id" required
                                                            class="form-control custom-select selectpicker">
                                                            <option value="0"> {{ __('اخـتـر---') }} </option>
                                                            @foreach (\App\User::all() as $user)
                                                                <option <?php if ($region->agent_id == $user->id) { echo 'selected'; } ?> value="{{ $user->id }}">
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
                                                <div class="form-group">
                                                    <div class="col">
                                                        <label class="mr-sm-2" for="type">{{__('المنطقة') }} :  <span style="color: red"> * </span> </label>
                                                        <select name="type" required class="form-control custom-select">
                                                            <option value="0">       {{__('اخـتـر---') }}                   </option>
                                                            <option value="المنطقة الشمالية" <?php if($region->type == "المنطقة الشمالية")   echo "selected"; ?> > {{__('المنطقة الشمالية') }}  </option>
                                                            <option value="المنطقة الجنوبية" <?php if($region->type == "المنطقة الجنوبية")   echo "selected"; ?> > {{__('المنطقة الجنوبية') }}  </option>
                                                            <option value="المنطقة الوسطي"   <?php if($region->type == "المنطقة الوسطي")     echo "selected"; ?> > {{__('المنطقة الوسطي') }}    </option>
                                                            <option value="المنطقة الشرقية"  <?php if($region->type == "المنطقة الشرقية")    echo "selected"; ?> > {{__('المنطقة الشرقية') }}   </option>
                                                            <option value="المنطقة الغربية"  <?php if($region->type == "المنطقة الغربية")    echo "selected"; ?> > {{__('المنطقة الغربية') }}   </option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{__('اغــلاق') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-success">{{__('حفظ البيانات') }}</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Make_region_Visible -->
                            <div class="modal fade" id="vis_region{{ $region->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{__('عـرض/اخـفاء بالصـفحـة الرئيـسـيـة') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('region/visible', 'test') }}" method="post">
                                                {{ method_field('post') }}
                                                @csrf
                                                    @if  ($region->status == '1')
                                                        {{__('هـل أنـت مـتـأكـد مـن هـذه الـعـمـلـبـة')}}
                                                    @elseif ($region->status == '0')
                                                        {{__('هـل أنـت مـتـأكـد مـن هـذه الـعـمـلـبـة')}}
                                                    @endif
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $region->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{__('اغــلاق')}}</button>
                                                    <button type="submit"
                                                        class="btn btn-info">{{__('حفظ البيانات') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- delete_modal_social -->
                            <div class="modal fade" id="delete{{ $region->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{__('حـذف الـمـنـطـقـة') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('regions.destroy', 'test') }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                    {{__('هـل أنـت مـتـأكـد مـن هـذه الـعـمـلـبـة')}}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $region->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{__('اغــلاق')}}</button>
                                                    <button type="submit"
                                                        class="btn btn-danger">{{__('حــذف')}}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                    {{__('اضـافـة')}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('regions.store') }}" method="POST">
                    @csrf
                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="name" class="mr-sm-2">{{__('الاســم') }} :  <span style="color: red"> * </span> </label>
                            <input type="text" class="form-control" name="name">
                        </div>
                    </div>
                    <div class="form-group modual_space">
                        <div class="col">
                            <label class="mr-sm-2" for="agent_id">{{ __('الـوكـيـل') }} : <span
                                    style="color: red"> * </span> </label>
                            <select name="agent_id" required class="form-control custom-select selectpicker">
                                <option value="0"> {{ __('اخـتـر---') }} </option>

                                {{-- <?php
                                     $users = \App\User::whereHas('roles', function ($query) {
                                                $query->where('name'=>'Admin', 'name'=>'User');
                                    })->get();
                                ?>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"> {{ $user->name }} </option>
                                @endforeach --}}

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
                    <div class="form-group modual_space">
                        <div class="col">
                            <label class="mr-sm-2" for="type">{{__('المنطقة') }} :  <span style="color: red"> * </span> </label>
                            <select name="type" required class="form-control custom-select">
                                <option value="0">       {{__('اخـتـر---') }}                   </option>
                                <option value="المنطقة الشمالية" class="" > {{__('المنطقة الشمالية') }}  </option>
                                <option value="المنطقة الجنوبية" class="" > {{__('المنطقة الجنوبية') }}  </option>
                                <option value="المنطقة الوسطي"   class="" > {{__('المنطقة الوسطي') }}    </option>
                                <option value="المنطقة الشرقية"  class="" > {{__('المنطقة الشرقية') }}   </option>
                                <option value="المنطقة الغربية"  class="" > {{__('المنطقة الغربية') }}   </option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{__('اغــلاق') }}</button>
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
                    height: 200,
                });
                $("#summernote").code()
                    .replace(/<\/p>/gi, "\n")
                    .replace(/<br\// ** end_phptag ** //gi, "\n")
                        .replace(/<\/?[^>]+(>|$)/g, "");
                    });

</script>
@endsection
