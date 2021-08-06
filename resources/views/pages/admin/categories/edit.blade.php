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
@if ($errors->any())
    <div class="error">{{ $errors->first('Name') }}</div>
@endif

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

            <button type="button" class="button x-small back_property">
                <a href="{{ route('categories.index') }}">{{ trans('property_trans.return') }}</a>
            </button>
            <br><br>



            {!! Form::open(['route' => ['categories.update', $category->id], 'method' => 'patch', 'files' => true]) !!}
            {{-- ------- Title --------- --}}
            <input id="id" type="hidden" name="id" class="form-control"
                    value="{{ $category->id }}">

            <div class="row pt-4">
                <div class="col-12">
                    {!! Form::label('photo', trans('property_trans.photo'), ['class' => 'control-label']) !!}
                    {!! Form::file('photo', ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="row pt-4">
                <div class="col-12">
                    <div class="form-group">
                        {!! Form::label('name', 'الاســم') !!}
                        {!! Form::text('name', old('title', $category->name), ['class' => 'form-control']) !!}
                        @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            {{-- <div class="form-group modual_space">
                <div class="col">
                    <label for="new_images" class="mr-sm-2">{{ __('اضـافـة مـجـمـوعـة صـور') }} : <span
                            style="color: red"> * </span> </label>
                    <input type="file" class="form-control file-input-overview" name="new_images[]" multiple>
                    @if ($errors->has('new_images'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('new_images') }}</strong>
                        </span>
                    @endif
                </div>
            </div> --}}

            <div class="row pt-4">
                <div class="col-12">
                    {!! Form::label('new_images', 'اضـافـة مـجـمـوعـة صـور' ) !!}
                    <br>
                    <div>
                        {!! Form::file('new_images[]', ['class' => 'form-control file-input-overview', 'multiple' => 'multiple']) !!}
                        @error('new_images')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="form-group pt-4">
                {!! Form::submit(trans('property_trans.submit'), ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>


        <?php
        $category_count = \App\Models\Category::all()->count();
        ?>
        <div class="container">
            <div class="row">
                @foreach ($category->categories_media as $image)
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                        <div class="card" style="width: 100%" >
                            <img src="{{ url($image->path) }}" class="card-img-top" alt="..." style="width: 100%; height:300px">
                            <div class="card-body" style="text-align: center">
                                <a href="/deleteimg/{{ $image->id }}" class="btn btn-danger">Delete Image</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!--end card section-->
    </div>
</div>

<?php
$category_count = \App\Models\Category::all()->count();
?>
<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render

<script>
    $(function() {
        $('#category_images').fileinput({
            theme: "fas",
            maxFileCount: 10,
            allowedFileTypes: ['image'],
            showCancel: true,
            showRemove: false,
            showUpload: false,
            overwriteInitial: false,
            initialPreview: [
                @if ($category_count != '')
                    @foreach ($category->categories_media as $image)
                        // "{{ asset($image->path) }}",
                        // @endforeach

                    @foreach ($category->categories_media as $image)
                        "{{ asset($image->path) }}",
                    @endforeach
                @endif
            ],
            initialPreviewAsData: true,
            initialPreviewFileType: ['image'],
            initialPreviewConfig: [
                @if ($category_count != '')
                    @foreach ($category->categories_media as $image)
                        // {caption: "{{ $image->path }}", url: "{{ route('removeImage', [$image->id, '_token' => csrf_token()]) }}",
                        key: "{{ $category->id }}"},
                        {caption: "{{ $image->path }}", url: "{{ route('removeImage', [$image->id, '_token' => csrf_token()]) }}",
                        key: "{{ $image->id }}"},
                    @endforeach
                @endif
            ],
        });
    });
</script>
<script>
    function myFunction() {
        var x = document.getElementById("myFile").disabled;
        document.getElementById("demo").innerHTML = x;
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.summernote').summernote({
            tabSize: 2,
            height: 200,
        });
    });
</script>
@endsection
