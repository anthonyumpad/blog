@extends('dashboard')
@section('head')
@endsection

@section('content')
    @include('layouts/flash-message-session')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-md-6">
                <h1>
                    {{ $action }} User
                </h1>
            </div>
            <div class="col-md-6">
                <div class="btn-group pull-right">
                    <button style="display:none"></button>
                    <button type="button" id="save" onClick="saveUser()" class="btn btn-default btn-sm ladda-button" data-style="zoom-in" data-size="xs" data-spinner-color="#000000"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <form role="form" id="form-user" method="POST" action="/superadmin/user/create">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-default">
                        <!-- /.box-body -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="User Name" @if(! empty($blogUser))value="{{ $blogUser->name }}" @else value="{{ Input::old('username') }}" @endif>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" @if(! empty($blogUser))value="{{ $blogUser->email }}" @else value="{{ Input::old('email') }}" @endif>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" @if(! empty($blogUser))value="{{ $blogUser->first_name }}" @else value="{{ Input::old('first_name') }}" @endif>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" @if(! empty($blogUser))value="{{ $blogUser->last_name }}" @else value="{{ Input::old('last_name') }}" @endif>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <select id="usertype" name="type" class="form-control">
                                            <option value="admin" selected>User</option>
                                            <option value="superadmin">Admin</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="overlay">
                            <i class="fa fa-refresh fa-spin "></i>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="uid" name="uid" @if(! empty($blogUser)) value={{ $blogUser->uid }}@else value="" @endif>
                        <!-- /.box -->
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('footer')
    <script>
        var saveLadda    = Ladda.create(document.querySelector( '#save'));
        $('.overlay').hide();
        setSideBarActive('categories-menu');

        var saveUser = function() {
            $('.overlay').show();
            saveLadda.start();
            $('#form-user').submit();
        };

        @if(! empty(Input::old('type')))
            $('#usertype').val("{{ Input::old('type') }}");
        @endif
    </script>
@stop