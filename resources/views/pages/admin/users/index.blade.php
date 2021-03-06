@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('users_trans.title_page') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('main_trans.Users') }}
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

            @if (auth()->user()->hasRole(['super_admin', 'admin']))
                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                    {{ trans('users_trans.add_user') }}
                </button>
            @endif
            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ trans('users_trans.Name') }}</th>
                            <th>{{ trans('users_trans.email') }}</th>
                            <th>{{__('مـهـمـتـه') }}</th>
                            <th>{{ trans('users_trans.created_at') }}</th>

                            @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                <th>{{ trans('users_trans.Processes') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($users as $user)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td>{{ $user->name }}</td>

                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach ($user->roles as $index=>$role )
                                         {{ $role->display_name }} {{ $index+1 < $user->roles->count() ? ',' : '' }}
                                    @endforeach
                                </td>
                                <td>{{ $user->created_at->diffForHumans() }}</td>

                                @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                    <td class="#">
                                        <button type="button" class="btn btn-info btn-sm given" data-toggle="modal"
                                            data-target="#edit{{ $user->id }}"
                                            title="{{ trans('users_trans.Edit') }}"><i class="fa fa-edit"></i></button>

                                            @if (auth()->user()->hasRole('super_admin'))
                                                @if ($user->id != auth()->id())
                                                    <form action="{{ route('users.destroy', 'test') }}" method="post">
                                                        {{ method_field('Delete') }}
                                                        @csrf
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                            value="{{ $user->id }}">
                                                        <button type="button" class="btn btn-danger btn-sm given"
                                                            onclick="confirm('{{ __("Are You Sure You Want To Delete This User ?") }}') ? this.parentElement.submit() : ''" style="position:absolute; margin-top: -28px; margin-right: 20px;"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                @endif
                                            @endif
                                    </td>
                                @endif
                            </tr>

                            <!-- edit_modal_user -->
                            <div class="modal fade" id="edit{{ $user->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('users_trans.edit_user') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('users.update', 'test') }}" method="post">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="col-md-12 make-space">
                                                            <label for="name" class="mr-sm-2">{{ trans('admins_trans.name') }} :</label>
                                                            <input id="name" type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                                                            <input id="id" type="hidden" name="id" class="form-control"
                                                                value="{{ $user->id }}">
                                                        </div>

                                                        <div class="col-md-12 make-space">
                                                            <label for="email" class="mr-sm-2">{{ trans('users_trans.email') }} :</label>
                                                            <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                                                        </div>

                                                        <div class="col-md-12 make-space">
                                                            <label for="password" class="mr-sm-2">{{ trans('users_trans.password') }} :</label>
                                                            <input type="password" class="form-control" name="password" value="">
                                                        </div>

                                                        <div class="col-md-12 make-space">
                                                            <label class="mr-sm-2" for="input-password-confirmation">{{ trans('users_trans.confirm_password') }} :</label>
                                                            <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control" value="">
                                                        </div>

                                                        <div class="col-md-12 make-space">
                                                            <label class="mr-sm-2" for="roles">{{__('المهمة / النوع') }} :</label> <br>
                                                            <?php $roles = \App\Role::all(); ?>
                                                            @foreach ($roles as $role )
                                                               <input type="checkbox" name="roles[]" value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'checked' : '' }}> {{ $role->display_name }} <br>
                                                            @endforeach
                                                        </div>
                                                <br><br>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('users_trans.Close') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-success">{{ trans('users_trans.submit') }}</button>
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


<!-- add_modal_user -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('users_trans.add_user') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 make-space">
                            <label for="name" class="mr-sm-2">{{ trans('users_trans.Name') }} : <span style="color: red"> * </span> </label>
                            <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        </div>

                        <div class="col-md-12 make-space">
                            <label for="email" class="mr-sm-2">{{ trans('users_trans.email') }} : <span style="color: red"> * </span> </label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">
                        </div>

                        <div class="col-md-12 make-space">
                            <label for="password" class="mr-sm-2">{{ trans('users_trans.password') }} : <span style="color: red"> * </span> </label>
                            <input type="password" class="form-control" name="password" required autocomplete="new-password">
                        </div>

                        <div class="col-md-12 make-space">
                            <label class="mr-sm-2" for="input-password-confirmation">{{ trans('users_trans.confirm_password') }} : <span style="color: red"> * </span> </label>
                            <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control" required>
                        </div>

                        <div class="col-md-12 make-space">
                            <label class="mr-sm-2" for="roles">{{__('المهمة / النوع') }} :</label> <br>
                            <?php $roles = \App\Role::all(); ?>
                            @foreach ($roles as $role )
                               <input type="checkbox" name="roles[]" value="{{ $role->name }}"> {{ $role->display_name }} <br>
                            @endforeach
                        </div>
                    <br><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">{{ trans('users_trans.Close') }}</button>
                <button type="submit" class="btn btn-success">{{ trans('users_trans.submit') }}</button>
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
