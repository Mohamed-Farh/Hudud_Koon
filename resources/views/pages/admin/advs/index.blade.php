@extends('layouts.master')
@section('css')
    @toastr_css


@section('title')
    {{ __('الاعلانات') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ __('الاعلانات') }}
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
                            <th>{{ __('العنوان') }}</th>
                            <th>{{ __(' الهاتف') }}</th>
                            <th>{{ __('وصف للاعلان') }}</th>
                            <th>{{ __('مشاهدة الفيديو') }}</th>
                            <th>{{ __('الرابط') }}</th>

                            @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                <th>{{ __('الحالة') }}</th>
                                <th>{{ trans('users_trans.Processes') }}</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 0;
                        ?>

                        @foreach ($advs as $adv)
                            @if ($adv)
                            <tr>
                                <?php $i++;  ?>
                                <td>{{ $i }}</td>
                                <td><img class="img-responsive thumbnail"
                                    src="{{ url('image/adv_images/photo/'.$adv->photo) }}"
                                    style="width: 70px; border-radius: 20px;    height: 56.01px;"></td>
                                <td>{{ $adv->title }}</td>
                                <td>{{ $adv->phone }}</td>
                                <td>{{ $adv->description }}</td>

                                <td><a href="{{ $adv->video_link }}" target="_blank" style="color: blue">{{__('مشاهدة الفيديو')}}</a></td>
                                <td><a href="{{ $adv->url }}" target="_blank" style="color: blue">{{__('زيارة المكان')}}</a></td>

                                @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                    <td>
                                        @if  ($adv->status == '1')
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#vis_adv{{ $adv->id }}"
                                            title="{{ trans('social_trans.Delete') }}"> <i class="fa fa-eye"></i> {{__('عـرض')}} </button>
                                        @elseif ($adv->status == '0')
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#vis_adv{{ $adv->id }}"
                                            title="{{ trans('social_trans.Delete') }}"> <i class="fa fa-eye-slash"></i> {{__('اخـفـاء')}} </button>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#edit{{ $adv->id }}" title="{{ __('تـعـديـل') }}"><i
                                                class="fa fa-edit"></i>
                                        </button>


                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $adv->id }}" title="{{ __('حــذف') }}"><i
                                                class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                @endif


                            </tr>

                            <!-- edit_modal_social -->
                            <div class="modal fade" id="edit{{ $adv->id }}" tabindex="-1" role="dialog"
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
                                            <form action="{{ route('advs.update', $adv->id) }}"
                                                method="post" enctype="multipart/form-data"
                                                autocomplete="off">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $adv->id }}">
                                                <div class="form-group modual_space">
                                                    <div class="col">
                                                        <label for="photo" class="mr-sm-2">{{ __('الـصـورة') }} :
                                                            <span style="color: red"> * </span> </label>
                                                        <input type="file" class="form-control" name="photo" required>
                                                        @if ($errors->has('photo'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('photo') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group modual_space">
                                                    <div class="col">
                                                        <label for="title" class="mr-sm-2">{{ __('العنوان') }} :
                                                            <span style="color: red"> * </span> </label>
                                                        <input type="text" class="form-control" name="title"
                                                            value="{{ $adv->title }}">
                                                        @if ($errors->has('title'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('title') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group modual_space">
                                                    <div class="col">
                                                        <label for="phone" class="mr-sm-2">{{ __('الـهـاتـف') }} :
                                                            <span style="color: red"> * </span> </label>
                                                        <input type="text" class="form-control" name="phone"
                                                            value="{{ $adv->phone }}">
                                                        @if ($errors->has('phone'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('phone') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group modual_space">
                                                    <div class="col">
                                                        <label for="description" class="mr-sm-2">{{ __('وصـف الاعــلان') }}   </label>
                                                        <textarea class="form-control" name="description">{{ $adv->description }}</textarea>
                                                        @if ($errors->has('description'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('description') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group modual_space">
                                                    <div class="col">
                                                        <label for="video_link" class="mr-sm-2">{{ __('مشاهدة الفيديو') }} :
                                                            <span style="color: red"> * </span> </label>
                                                        <input type="text" class="form-control" name="video_link"
                                                            value="{{ $adv->url }}">
                                                        @if ($errors->has('video_link'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('video_link') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group modual_space">
                                                    <div class="col">
                                                        <label for="url" class="mr-sm-2">{{ __('الرابط') }} :
                                                            <span style="color: red"> * </span> </label>
                                                        <input type="text" class="form-control" name="url"
                                                            value="{{ $adv->url }}">
                                                        @if ($errors->has('url'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('name') }}</strong>
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

                            <!-- Make_Company Word_Visible -->
                            <div class="modal fade" id="vis_adv{{ $adv->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('social_trans.Edit') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('advs/visible', 'test') }}" method="post">
                                                {{ method_field('post') }}
                                                @csrf
                                                    @if  ($adv->type == '1')
                                                        {{ trans('social_trans.unvisible_social') }}
                                                    @elseif ($adv->type == '0')
                                                        {{ trans('social_trans.visible_social') }}
                                                    @endif
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $adv->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal">{{ trans('social_trans.Close') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-info">{{ trans('social_trans.submit') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- delete_modal_social -->
                            <div class="modal fade" id="delete{{ $adv->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ __('حـذف الاعلان') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('advs.destroy',  $adv->id ) }}"
                                                method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ __('هـل أنـت مـتـأكـد مـن هـذه الـعـمـلـبـة') }}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $adv->id }}">
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


                            {{-- <div class="container video">
                                <!-- Modal -->
                                <div class="modal fade" id="myModal_{{ $adv->video_link }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">

                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>

                                                <!-- 16:9 aspect ratio -->
                                                <div class="embed-responsive embed-responsive-16by9">
                                                    <iframe class="embed-responsive-item" src="{{ $adv->video_link }}" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

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
                <form action="{{ route('advs.store') }}" method="POST" enctype="multipart/form-data"
                    autocomplete="off">
                    @csrf
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
                            <label for="title" class="mr-sm-2">{{ __('الـعـنـوان') }} : <span style="color: red"> *
                                </span> </label>
                            <input type="text" class="form-control" name="title">
                            @if ($errors->has('title'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="phone" class="mr-sm-2">{{ __('الـهـاتـف') }} : <span style="color: red"> *
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
                            <label for="description" class="mr-sm-2">{{ __('وصـف الاعــلان') }}   </label>
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
                            <label for="video_link" class="mr-sm-2">{{ __('رابط الفيديو') }} : <span style="color: red"> * </span> </label>
                            <input type="text" class="form-control" name="video_link">
                            @if ($errors->has('video_link'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('video_link') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="url" class="mr-sm-2">{{ __('الرابط') }} : <span style="color: red"> * </span> </label>
                            <input type="text" class="form-control" name="url">
                            @if ($errors->has('url'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('url') }}</strong>
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
