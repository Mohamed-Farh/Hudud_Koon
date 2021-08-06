@extends('layouts.master')
@section('css')
    @toastr_css


@section('title')
    {{ __('الـتـصـنـيـفـات') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ __('الـتـصـنـيـفـات') }}
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

                            @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                <th>{{ __('الـحـالـة') }}</th>
                                <th>{{ trans('users_trans.Processes') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0;
                            $categories = \App\Models\Category::orderBy('id', 'desc')->get();
                        ?>

                        @foreach ($categories as $category)
                            @if ($category)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td><img class="img-responsive thumbnail"
                                        src="{{ url('image/category/photo/' . $category->photo) }}"
                                        style="width: 70px; border-radius: 20px;    height: 56.01px;"></td>
                                <td>{{ $category->name }}</td>

                                @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                    <td>
                                        @if ($category->status == '1')
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#vis_category{{ $category->id }}"
                                                title="{{ trans('social_trans.Delete') }}"> <i class="fa fa-eye"></i>
                                                {{ __('عـرض') }} </button>
                                        @elseif ($category->status == '0')
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#vis_category{{ $category->id }}"
                                                title="{{ trans('social_trans.Delete') }}"> <i
                                                    class="fa fa-eye-slash"></i> {{ __('اخـفـاء') }} </button>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#edit{{ $category->id }}" title="{{ __('تـعـديـل') }}"><i
                                                class="fa fa-edit"></i></button> --}}

                                        <a href="{{ route('categories.edit', $category) }}"><button type="button" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button></a>

                                        @if (auth()->user()->hasRole('super_admin'))
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $category->id }}" title="{{ __('حــذف') }}"><i
                                                    class="fa fa-trash"></i></button>
                                        @endif
                                    </td>
                                @endif
                            </tr>


                            <!-- Make_category_Visible -->

                            <div class="modal fade" id="vis_category{{ $category->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ __('عـرض/اخـفاء بالصـفحـة الرئيـسـيـة') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('category/visible', 'test') }}" method="post">
                                                {{ method_field('post') }}
                                                @csrf
                                                @if ($category->status == '1')
                                                    {{ __('هـل أنـت مـتـأكـد مـن هـذه الـعـمـلـبـة') }}
                                                @elseif ($category->status == '0')
                                                    {{ __('هـل أنـت مـتـأكـد مـن هـذه الـعـمـلـبـة') }}
                                                @endif
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $category->id }}">
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


                            <!-- delete_modal_social -->
                            <div class="modal fade" id="delete{{ $category->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ __('حـذف الـمـنـطـقـة') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('categories.destroy', 'test') }}"
                                                method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ __('هـل أنـت مـتـأكـد مـن هـذه الـعـمـلـبـة') }}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $category->id }}">
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
                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data"
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
                            <label for="images" class="mr-sm-2">{{ __('مـجـمـوعـة صـور') }} : <span style="color: red"> * </span> </label>
                            <input type="file" class="form-control file-input-overview" name="images[]" multiple required>
                            @if ($errors->has('images'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('images') }}</strong>
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
