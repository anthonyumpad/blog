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
                    {{ $action }} Post
                </h1>
            </div>
            <div class="col-md-6">
                <div class="btn-group pull-right">
                    <button type="button" id="save" class="btn btn-default btn-sm ladda-button" data-style="zoom-in" data-size="xs" data-spinner-color="gray"><i class="fa fa-save"></i> Save</button>
                    <button type="button" id="publish" class="btn btn-default btn-sm"><i class="fa fa-share-square-o"></i> Publish</button>
                    <button type="button" id="unpublish" class="btn btn-default btn-sm"><i class="fa fa-file"></i> UnPublish</button>
                    <button type="button" id="preview" class="btn btn-default btn-sm"><i class="fa fa-newspaper-o"> </i> Preview</button>
                    <button type="button" id="delete" class="btn btn-default btn-sm"><i class="fa fa-remove"> </i> Delete</button>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <!-- form start -->
                <form role="form">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Heading Details</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tags">Tags</label>
                                <input type="text" class="form-control" id="tag" name="tag" placeholder="Tags">
                            </div>
                        </div>
                        <!-- /.box-body -->
                    <div class="overlay">
                        <i class="fa fa-refresh fa-spin "></i>
                    </div>
                </div>
                <!-- /.box -->
                <div class="box box-default">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea id="content" name="body" rows="10" cols="120" style="visibility: hidden; display: none;"></textarea>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </form>
                    <div class="overlay">
                        <i class="fa fa-refresh fa-spin "></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')
    <script>
        var saveLadda    = Ladda.create(document.querySelector( '#save'));
        var publishLadda = Ladda.create(document.querySelector( '#publish'));
        setSideBarActive('posts-menu');
        $('.overlay').hide();
        $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('content');
        });
    </script>
@stop