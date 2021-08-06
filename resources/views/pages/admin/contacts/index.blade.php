@extends('layouts.master')
@section('css')
    @toastr_css


@section('title')
{{__('اتـصـل بـنـا') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{__('اتـصـل بـنـا') }}
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
                            <th>{{__('رقـم الـهـاتـف')}}</th>
                            <th>{{__('البريد الالكتروني')}}</th>
                            <th>{{__('الـفـاكـس')}}</th>


                            @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                <th>{{__('الـحـالـة')}}</th>
                                <th>{{__('الـعـمـلـيـات')}}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($contacts as $contact)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td>{{ $contact->phone }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->fax }}</td>

                                @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                    <td>
                                        @if  ($contact->status == '1')
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#vis_contact{{ $contact->id }}"
                                            title="{{ trans('social_trans.Delete') }}"> <i class="fa fa-eye"></i> {{__('عـرض')}} </button>
                                        @elseif ($contact->status == '0')
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#vis_contact{{ $contact->id }}"
                                            title="{{ trans('social_trans.Delete') }}"> <i class="fa fa-eye-slash"></i> {{__('اخـفـاء')}} </button>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#edit{{ $contact->id }}"
                                            title="{{__('تـعـديـل')}}"><i
                                                class="fa fa-edit"></i></button>

                                        @if (auth()->user()->hasRole('super_admin'))
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $contact->id }}"
                                            title="{{__('حــذف')}}"><i
                                                class="fa fa-trash"></i></button>
                                        @endif
                                    </td>
                                @endif
                            </tr>

                            <!-- edit_modal_social -->
                            <div class="modal fade" id="edit{{ $contact->id }}" tabindex="-1" role="dialog"
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
                                            <form action="{{ route('contacts.update', 'test') }}" method="post">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $contact->id }}">
                                                    <div class="form-group modual_space">
                                                        <div class="col">
                                                            <label for="phone" class="mr-sm-2">{{__('رقـم الـهـاتـف')}} :  <span style="color: red"> * </span> </label>
                                                            <input type="text" class="form-control" name="phone" value="{{ $contact->phone }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group modual_space">
                                                        <div class="col">
                                                            <label for="email" class="mr-sm-2">{{__('البريد الالكتروني')}} :  <span style="color: red"> * </span> </label>
                                                            <input type="text" class="form-control" name="email" value="{{ $contact->email }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group modual_space">
                                                        <div class="col">
                                                            <label for="fax" class="mr-sm-2">{{__('الـفـاكـس')}} :  </label>
                                                            <input type="text" class="form-control" name="fax" value="{{ $contact->fax }}">
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


                            <!-- Make_contact_Visible -->
                            <div class="modal fade" id="vis_contact{{ $contact->id }}" tabindex="-1" role="dialog"
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
                                            <form action="{{ route('contact/visible', 'test') }}" method="post">
                                                {{ method_field('post') }}
                                                @csrf
                                                    @if  ($contact->status == '1')
                                                        {{__('هـل أنـت مـتـأكـد مـن هـذه الـعـمـلـبـة')}}
                                                    @elseif ($contact->status == '0')
                                                        {{__('هـل أنـت مـتـأكـد مـن هـذه الـعـمـلـبـة')}}
                                                    @endif
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $contact->id }}">
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
                            <div class="modal fade" id="delete{{ $contact->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{__('حــــذف') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('contacts.destroy', 'test') }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                    {{__('هـل أنـت مـتـأكـد مـن هـذه الـعـمـلـبـة')}}
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $contact->id }}">
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
                <form action="{{ route('contacts.store') }}" method="POST">
                    @csrf
                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="phone" class="mr-sm-2">{{__('رقـم الـهـاتـف')}} :  <span style="color: red"> * </span> </label>
                            <input type="text" class="form-control" name="phone">
                        </div>
                    </div>
                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="email" class="mr-sm-2">{{__('البريد الالكتروني')}} :  <span style="color: red"> * </span> </label>
                            <input type="text" class="form-control" name="email">
                        </div>
                    </div>
                    <div class="form-group modual_space">
                        <div class="col">
                            <label for="fax" class="mr-sm-2">{{__('الـفـاكـس')}} :  </label>
                            <input type="text" class="form-control" name="fax">
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
