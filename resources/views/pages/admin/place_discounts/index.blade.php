@extends('layouts.master')
@section('css')
    @toastr_css


@section('title')
{{__('الـعـروض / الـكـوبـونـات') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{__('الـعـروض / الـكـوبـونـات') }}
@stop
{{ ($place->name) }}
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
                            <th>{{ __('الـصـورة') }}</th>
                            <th>{{__('اسم المنتج')}}</th>
                            <th>{{ __('وصف المنتج') }}</th>
                            <th>{{ __('السعر الاصلي') }}</th>
                            <th>{{__('قيمة الخصم')}}</th>
                            <th>{{__('السعر بعد الخصم')}}</th>
                            <th>{{__('تاريخ بدأ العرض')}}</th>
                            <th>{{__('تاريخ إنتهاء العرض')}}</th>
                            <th>{{__('النوع')}}</th>

                            @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                <th>{{__('الحالة')}}</th>
                                <th>{{__('الـعـمـلـيـات')}}</th>
                            @endif

                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($place_discounts as $place_discount)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td><img class="img-responsive thumbnail"
                                    src="{{ url('/image/place/product/' . $place_discount->photo) }}"
                                    style="width: 70px; border-radius: 20px;    height: 56.01px;"></td>
                                <td>{{ $place_discount->name }}</td>
                                <td>{{  \Str::limit($place_discount->description, 50) }}</td>
                                <td>{{ $place_discount->price }}</td>
                                <td>{{ $place_discount->discount }}</td>
                                <td>{{ $place_discount->new_price }}</td>
                                <td>{{ $place_discount->start_day }}</td>
                                <td>{{ $place_discount->end_day }}</td>
                                <td>{{ $place_discount->type }}</td>

                                @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                    <td>
                                        @if  ($place_discount->status == '1')
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#vis_discount{{ $place_discount->id }}"
                                            title="{{ trans('social_trans.Delete') }}"> <i class="fa fa-eye"></i> {{__('عـرض')}} </button>
                                        @elseif ($place_discount->status == '0')
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#vis_discount{{ $place_discount->id }}"
                                            title="{{ trans('social_trans.Delete') }}"> <i class="fa fa-eye-slash"></i> {{__('اخـفـاء')}} </button>
                                        @endif
                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#edit{{ $place_discount->id }}"
                                            title="{{__('تـعـديـل')}}"><i
                                                class="fa fa-edit"></i></button>

                                        @if (auth()->user()->hasRole('super_admin'))
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $place_discount->id }}"
                                                title="{{__('حــذف')}}"><i
                                                    class="fa fa-trash"></i></button>
                                        @endif
                                    </td>
                                @endif
                            </tr>

                            <!-- edit_modal_social -->
                            <div class="modal fade" id="edit{{ $place_discount->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content" style="width: 120%">
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
                                            <form action="{{ route('place_discounts.update', 'test') }}" method="post" enctype="multipart/form-data">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $place_discount->id }}">
                                                    <input type="hidden" class="form-control" name="place_id" value="{{ $place->id }}">
                                                    <div class="form-group modual_space">
                                                        <div class="col">
                                                            <label for="photo" class="mr-sm-2">{{ __('الـصـورة') }} :
                                                                <span style="color: red"> * </span> </label>
                                                            <input type="file" class="form-control" name="photo">
                                                            @if ($errors->has('photo'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('photo') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group modual_space">
                                                        <div class="col">
                                                            <label for="name" class="mr-sm-2">{{__('اسم المنتج') }} :  <span style="color: red"> * </span> </label>
                                                            <input type="text" class="form-control" name="name" value="{{ $place_discount->name }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group modual_space">
                                                        <div class="col">
                                                            <label for="description" class="mr-sm-2">{{ __('وصـف المنتج') }}   </label>
                                                            <textarea class="form-control" name="description">
                                                                {{ $place_discount->description }}
                                                            </textarea>
                                                            @if ($errors->has('description'))
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('description') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col">
                                                            <label class="mr-sm-2" for="type">{{__('النوع') }} :  <span style="color: red"> * </span> </label>
                                                            <select name="type" required class="form-control custom-select">
                                                                <option value="0">       {{__('اخـتـر---') }}                   </option>
                                                                <option value="عرض"   <?php if($place_discount->type == "عرض")   echo "selected"; ?> > {{__('عرض') }}  </option>
                                                                <option value="كوبون" <?php if($place_discount->type == "كوبون")   echo "selected"; ?> > {{__('كوبون') }}  </option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group modual_space">
                                                        <div class="col">
                                                            <label for="price" class="mr-sm-2">{{__('السعر الاصلي') }} :  <span style="color: red"> * </span> </label>
                                                            <input type="number" class="form-control" name="price" value="{{ $place_discount->price }}">
                                                        </div>

                                                        <div class="col">
                                                            <label for="discount" class="mr-sm-2">{{__('قيمة الخصم') }} :  <span style="color: red"> * </span> </label>
                                                            <input type="number" class="form-control" name="discount" value="{{ $place_discount->discount }}">
                                                        </div>

                                                        <div class="col">
                                                            <label for="new_price" class="mr-sm-2">{{__('السعر بعد الخصم') }} :  <span style="color: red"> * </span> </label>
                                                            <input type="number" class="form-control" name="new_price" value="{{ $place_discount->new_price }}">
                                                        </div>
                                                    </div>

                                                    <div class="row form-group modual_space">
                                                        <div class="col">
                                                            <label for="start_day" class="mr-sm-2">{{__('تاريخ بدأ العرض') }} :  <span style="color: red"> * </span> </label>
                                                            <input type="date" class="form-control" name="start_day" value="{{ $place_discount->start_day }}">
                                                        </div>

                                                        <div class="col">
                                                            <label for="end_day" class="mr-sm-2">{{__('تاريخ إنتهاء العرض') }} :  <span style="color: red"> * </span> </label>
                                                            <input type="date" class="form-control" name="end_day" value="{{ $place_discount->end_day }}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group modual_space">
                                                        <label for="exampleFormControlTextarea1">{{ trans('Grades_trans.Notes') }} : </label>
                                                        <textarea class="form-control" name="notes"  value="{{ $place_discount->notes }}">{{ $place_discount->notes }}
                                                        </textarea>
                                                    </div>
                                                    <br><br>

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
                            <div class="modal fade" id="vis_discount{{ $place_discount->id }}" tabindex="-1" role="dialog"
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
                                            <form action="{{ route('place_discounts/visible', 'test') }}" method="post">
                                                {{ method_field('post') }}
                                                @csrf
                                                    @if  ($place_discount->status == '1')
                                                        {{__('هـل أنـت مـتـأكـد مـن هـذه الـعـمـلـبـة')}}
                                                    @elseif ($place_discount->status == '0')
                                                        {{__('هـل أنـت مـتـأكـد مـن هـذه الـعـمـلـبـة')}}
                                                    @endif
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $place_discount->id }}">
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
                            <div class="modal fade" id="delete{{ $place_discount->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{__('حـذف الـعـرض') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('place_discounts.destroy', 'test') }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                    {{__('هـل أنـت مـتـأكـد مـن هـذه الـعـمـلـبـة')}}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $place_discount->id }}">
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
        <div class="modal-content" style="width: 120%">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ $place->name }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('place_discounts.store') }}" method="POST" enctype="multipart/form-data"
                autocomplete="off">
                    @csrf
                    <input type="hidden" class="form-control" name="place_id" value="{{ $place->id }}">
                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="photo" class="mr-sm-2">{{ __('الـصـورة') }} : <span style="color: red"> *
                                </span> </label>
                            <input type="file" class="form-control" name="photo">
                            @if ($errors->has('photo'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('photo') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="name" class="mr-sm-2">{{__('اسم المنتج') }} :  <span style="color: red"> * </span> </label>
                            <input type="text" class="form-control" name="name">
                        </div>
                    </div>
                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="description" class="mr-sm-2">{{ __('وصـف المنتج') }}   </label>
                            <textarea class="form-control" name="description">
                            </textarea>
                            @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group modual_space">
                        <div class="col">
                            <label class="mr-sm-2" for="type">{{__('النوع') }} :  <span style="color: red"> * </span> </label>
                            <select name="type" required class="form-control custom-select">
                                <option value="0">       {{__('اخـتـر---') }}                   </option>
                                <option value="عرض" class="" > {{__('عرض') }}  </option>
                                <option value="كوبون" class="" > {{__('كوبون') }}  </option>
                            </select>
                        </div>
                    </div>

                    <div class="row form-group modual_space">
                        <div class="col">
                            <label for="price" class="mr-sm-2">{{__('السعر الاصلي') }} :  <span style="color: red"> * </span> </label>
                            <input type="number" class="form-control" name="price">
                        </div>

                        <div class="col">
                            <label for="discount" class="mr-sm-2">{{__('قيمة الخصم') }} :  <span style="color: red"> * </span> </label>
                            <input type="number" class="form-control" name="discount">
                        </div>

                        <div class="col">
                            <label for="new_price" class="mr-sm-2">{{__('السعر بعد الخصم') }} :  <span style="color: red"> * </span> </label>
                            <input type="number" class="form-control" name="new_price">
                        </div>
                    </div>

                    <div class="row form-group modual_space">
                        <div class="col">
                            <label for="start_day" class="mr-sm-2">{{__('تاريخ بدأ العرض') }} :  <span style="color: red"> * </span> </label>
                            <input type="date" class="form-control" name="start_day">
                        </div>

                        <div class="col">
                            <label for="end_day" class="mr-sm-2">{{__('تاريخ إنتهاء العرض') }} :  <span style="color: red"> * </span> </label>
                            <input type="date" class="form-control" name="end_day">
                        </div>
                    </div>

                    <div class="form-group modual_space">
                        <label
                            for="exampleFormControlTextarea1">{{__('مـلاحـظـات') }} : </label>
                        <textarea class="form-control" name="notes" id="exampleFormControlTextarea1" rows="3">
                        </textarea>
                    </div>
                    <br><br>


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
