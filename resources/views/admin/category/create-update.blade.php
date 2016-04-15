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
                    {{ $action }} Category
                </h1>
            </div>
            <div class="col-md-6">
                <div class="btn-group pull-right">
                    <button style="display:none"></button>
                    <button type="button" id="save" onClick="saveCategory()" class="btn btn-default btn-sm ladda-button" data-style="zoom-in" data-size="xs" data-spinner-color="#000000"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <form role="form" id="form-category" method="POST" action="/admin/category/create">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-default">
                        <!-- /.box-body -->
                        <div class="box-body">
                            <div class="form-group">
                                <label for="title">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Category Name" @if(! empty($category))value="{{ $category->name }}"@endif>
                            </div>
                            <div class="form-group">
                                <label for="title">Type</label>
                                <select name="type" class="form-control">
                                    <option value="main">Main</option>
                                    <option value="post" selected>Post</option>
                                </select>
                            </div>
                        </div>

                        <div class="overlay">
                            <i class="fa fa-refresh fa-spin "></i>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="uid" name="uid" value ={{ $user->uid }}>
                        <input type="hidden" id="category-id" name="category-id" @if(! empty($category)) value={{ $category->id }}@else value="" @endif>
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

        var saveCategory = function() {
            $('.overlay').show();
            saveLadda.start();
            $('#form-category').submit();
        };
    </script>
@stop