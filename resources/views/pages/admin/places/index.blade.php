@extends('layouts.master')
@section('css')
    @toastr_css


@section('title')
    {{ __('الأماكن') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ __('الأماكن') }}
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
                            <th>{{ __('الـصـورة') }}</th>
                            <th>{{ __('الاســم') }}</th>
                            <th>{{ __('الرقم') }}</th>
                            <th>{{ __('وصف للمكان') }}</th>
                            <th>{{ __('الرابط') }}</th>
                            {{-- <th>{{ __('الموقع بالخريطة') }}</th> --}}
                            <th>{{ __('التصنيف') }}</th>
                            <th>{{ __('منطقة - حي') }}</th>
                            <th>{{ __('عروض و كوبونات') }}</th>

                            @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                <th>{{ trans('users_trans.Processes') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0;
                        ?>

                        @foreach ($places as $place)
                            @if ($place)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td><img class="img-responsive thumbnail"
                                        src="{{ url('image/place/photo/' . $place->photo) }}"
                                        style="width: 70px; border-radius: 20px;    height: 56.01px;"></td>
                                <td>{{ $place->name }}</td>
                                <td>{{ $place->phone }}</td>
                                <td>{{  \Str::limit($place->description, 50) }}</td>
                                <td><a href="{{ $place->url }}" target="_blank" style="color: blue">{{__('زيارة المكان')}}</a></td>
                                {{-- <td><a href="{{ $place->map }}" target="_blank" style="color: blue">{{__('عرض الموثع بالخريطة')}}</a></td> --}}

                                <?php $category = \App\Models\Category::findOrFail($place->category_id); ?>
                                <td>{{ $category->name }} </td>

                                <?php $region = \App\Models\Region::findOrFail($place->region_id); ?>
                                <td>{{ $region->name }} - {{ $region->type }}</td>

                                <td><a href="{{ route('places.show', $place) }}" target="_blank" style="color: blue">{{__('رؤية العروض')}}</a></td>

                                @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                    <td>
                                        <?php
                                             $region = \App\Models\Region::findOrFail($place->region_id);
                                             $current_user = Auth::user()->id;
                                         ?>
                                        @if ($current_user == $region->agent_id | auth()->user()->hasRole('super_admin'))
                                            {{-- <a href="{{ route('places.show', $place) }}"><button type="button" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></button></a> --}}
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $place->id }}" title="{{ __('تـعـديـل') }}"><i
                                                    class="fa fa-edit"></i>
                                            </button>
                                        @endif

                                        @if (auth()->user()->hasRole('super_admin'))
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $place->id }}" title="{{ __('حــذف') }}"><i
                                                    class="fa fa-trash"></i>
                                            </button>
                                        @endif
                                    </td>
                                @endif


                            </tr>

                            <!-- edit_modal_social -->
                            <div class="modal fade" id="edit{{ $place->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content" style="width: 140%;">
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
                                            <form action="{{ route('places.update', $place->id) }}"
                                                method="post" enctype="multipart/form-data"
                                                autocomplete="off">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $place->id }}">
                                                <div class="form-group modual_space">
                                                    <div class="col">
                                                        <label for="photo" class="mr-sm-2">{{ __('الـصـورة') }} :
                                                            <span style="color: red"> * </span> </label>
                                                        <input type="file" class="form-control" name="photo" required>
                                                        @if ($errors->has('image'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('photo') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group modual_space">
                                                    <div class="col">
                                                        <label for="name" class="mr-sm-2">{{ __('الاســم') }} :
                                                            <span style="color: red"> * </span> </label>
                                                        <input type="text" class="form-control" name="name"
                                                            value="{{ $place->name }}">
                                                        @if ($errors->has('image'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('name') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group modual_space">
                                                    <div class="col">
                                                        <label for="name" class="mr-sm-2">{{ __('الرقم') }} :
                                                            <span style="color: red"> * </span> </label>
                                                        <input type="text" class="form-control" name="phone"
                                                            value="{{ $place->phone }}">
                                                        @if ($errors->has('image'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('name') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group modual_space">
                                                    <div class="col">
                                                        <label for="name" class="mr-sm-2">{{ __('الرابط') }} :
                                                            <span style="color: red"> * </span> </label>
                                                        <input type="text" class="form-control" name="url"
                                                            value="{{ $place->url }}">
                                                        @if ($errors->has('image'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('name') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group modual_space">
                                                    <div class="col">
                                                        <label class="mr-sm-2"
                                                            for="category_id">{{ __('التصنيف') }} : <span
                                                                style="color: red"> * </span> </label>
                                                        <select name="category_id" required
                                                            class="form-control custom-select selectpicker">
                                                            <option value="0"> {{ __('اخـتـر---') }} </option>
                                                            @foreach( $categories as $cat)
                                                            <option value="{{ $cat->id }}" <?php if ($cat->id == $place->category_id){ echo 'selected';}  ?>>{{ $cat->name }} </option>
                                                            @endforeach

                                                        </select>
                                                        @if ($errors->has('category_id'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('category_id') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group modual_space">
                                                    <div class="col">
                                                        <label class="mr-sm-2"
                                                            for="region_id">{{ __('الـمـنـطـقـة / الـحـي') }} :
                                                            <span style="color: red"> * </span> </label>
                                                        <select name="region_id" required
                                                            class="form-control custom-select selectpicker">
                                                            <option value="0"> {{ __('اخـتـر---') }} </option>
                                                            @foreach (\App\Models\Region::all() as $region)
                                                                <option <?php if ($place->region_id == $region->id) { echo 'selected'; } ?> value="{{ $region->id }}">
                                                                    {{ $region->name }} / {{ $region->type }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('region_id'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('region_id') }}</strong>
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

                            <!-- delete_modal_social -->
                            <div class="modal fade" id="delete{{ $place->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ __('حـذف المكان') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('places.destroy',  $place->id ) }}"
                                                method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ __('هـل أنـت مـتـأكـد مـن هـذه الـعـمـلـبـة') }}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $place->id }}">
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
        <div class="modal-content" style="width: 140%;">
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
                <form action="{{ route('places.store') }}" method="POST" enctype="multipart/form-data"
                    autocomplete="off">
                    @csrf
                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="photo" class="mr-sm-2">{{ __('الـصـورة') }} : <span style="color: red"> *
                                </span> </label>
                            <input type="file" class="form-control" name="photo">
                            @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('photo') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="name" class="mr-sm-2">{{ __('الاســم') }} : <span style="color: red"> *
                                </span> </label>
                            <input type="text" class="form-control" name="name">
                            @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="phone" class="mr-sm-2">{{ __('الرقم') }} : <span style="color: red"> *
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
                            <label for="description" class="mr-sm-2">{{ __('وصـف الـمـكـان') }}   </label>
                            <textarea class="form-control" name="description"></textarea>
                            @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="name" class="mr-sm-2">{{ __('الرابط') }} : <span style="color: red"> * </span> </label>
                            <input type="text" class="form-control" name="url">
                            @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="map" class="mr-sm-2">{{ __('رابط الموقع علي الخريطة') }} : <span style="color: red"> * </span> </label>
                            <input type="text" class="form-control" name="map">
                            @if ($errors->has('map'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="name" class="mr-sm-2">{{ __('التصنيف') }} : <span style="color: red"> *
                                </span> </label>
                            <select name="category_id" required
                                    class="form-control custom-select selectpicker">
                                    <option value="0"> {{ __('اخـتـر---') }} </option>
                                    @foreach( $categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }} </option>
                                    @endforeach

                            </select>
                            @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group modual_space">
                        <div class="col">
                            <label class="mr-sm-2" for="region_id">{{ __('الـمـنـطـقـة / الـحـي') }} : <span
                                    style="color: red"> * </span> </label>
                            <select name="region_id" required class="form-control custom-select selectpicker">
                                <option value="0"> {{ __('اخـتـر---') }} </option>
                                @foreach (\App\Models\Region::get() as $region)
                                    <option value="{{ $region->id }}">
                                         {{ $region->name }} / {{ $region->type }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('region_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('region_id') }}</strong>
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



<script type="text/javascript">
    $(document).ready(function() {
        $('.summernote').summernote({
            tabSize: 2,
            height: 200,
        });
    });
</script>

@endsection
