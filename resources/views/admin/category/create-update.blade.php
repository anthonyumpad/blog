@extends('dashboard')
@section('head')
    <style>.cke{visibility:hidden;}</style>
    <script type="text/javascript" src="{{ asset("/bower_components/admin-lte/plugins/ckeditor/ckeditor.js") }}"></script>
    <script type="text/javascript" src="{{ asset("/bower_components/admin-lte/plugins/ckeditor/config.js") }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset("/bower_components/admin-lte/plugins/ckeditor/skins/moono/editor.css") }}">
    <script type="text/javascript" src="{{ asset("/bower_components/admin-lte/plugins/ckeditor/lang/en.js") }}"></script>
    <script type="text/javascript" src="{{ asset("/bower_components/admin-lte/plugins/ckeditor/styles.js")}}"></script>
@endsection

@section('content')
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
                    <button type="button" id="save" class="btn btn-default btn-sm ladda-button" data-style="zoom-in" data-size="xs" data-spinner-color="gray"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <!-- form start -->
                    <form role="form">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="title">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Category Name">
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </form>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection

@section('footer')
    <script>
        var saveLadda    = Ladda.create(document.querySelector( '#save'));
        setSideBarActive('categories-menu');
    </script>
@stop