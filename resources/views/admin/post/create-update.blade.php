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
    @include('layouts/flash-message')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-md-4">
                <h1 id="post-action-title">
                    {{ $action }} Post
                </h1>
            </div>
            <div class="col-md-8">
                <div class="btn-group pull-right">
                    <button style="display:none"></button>
                    <button type="button" id="save" onClick="savePost()" class="btn btn-default btn-sm ladda-button" data-style="zoom-in" data-size="xs" data-spinner-color="#000000"><i class="fa fa-save"></i> Save</button>
                   <script> var saveLadda  = Ladda.create(document.querySelector('#save'));</script>
                    @if(! empty($blog))
                        <button type="button" id="publish" onClick="togglePublish('published')" class="btn btn-default btn-sm ladda-button" data-style="zoom-in" data-size="xs" data-spinner-color="#000000" @if($blog->status !== "draft") disabled="true" @endif ><i class="fa fa-share-square-o"></i> Publish</button>
                        <button type="button" id="unpublish" onClick="togglePublish('draft')" class="btn btn-default btn-sm ladda-button" data-style="zoom-in" data-size="xs" data-spinner-color="#000000" @if($blog->status !== "published") disabled="true" @endif ><i class="fa fa-file"></i> UnPublish</button>
                        <button type="button" id="preview" class="btn btn-default btn-sm ladda-button" data-style="zoom-in" data-size="xs" data-spinner-color="#000000"><i class="fa fa-newspaper-o"> </i> Preview</button>
                        <button type="button" id="delete" class="btn btn-default btn-sm ladda-button" data-style="zoom-in" data-size="xs" data-spinner-color="#000000"><i class="fa fa-remove"> </i> Delete</button>
                        <script>
                            var publishLadda = Ladda.create(document.querySelector( '#publish'));
                            var unpublishLadda = Ladda.create(document.querySelector( '#unpublish'));
                            var previewLadda = Ladda.create(document.querySelector( '#preview'));
                            var deleteLadda  = Ladda.create(document.querySelector( '#delete'));
                        </script>
                    @endif
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
                <form role="form" id="create-form">
                <div class="box box-default">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-10">
                                <h3 class="box-title">Heading Details</h3>
                            </div>
                            <div class="col-md-1 pull-right">
                                <div class="box-tools">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="col-md-1 pull-right">
                                @if(empty($blog))
                                    <span id="blog-status" class="label label-success">NEW</span>
                                @else
                                    <input type="hidden" id="status" name="status" value="{{ $blog->status }}">
                                    @if($blog->status == 'draft')
                                        <span id="blog-status" class="label label-warning">{{ strtoupper($blog->status) }}</span>
                                    @else
                                        <span id="blog-status" class="label label-info">{{ strtoupper($blog->status) }}</span>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" @if(! empty($blog)) value="{{ $blog->title }}" @endif placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Description">@if(! empty($blog)){{ $blog->description }}@endif</textarea>
                        </div>
                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <input type="text" class="form-control" id="tags" name="tags" placeholder="Tags" @if(! empty($blog)) value="{{ $blog->tags }}"@endif>
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
                                <textarea id="content" name="content" rows="10" cols="120" style="visibility: hidden; display: none;">@if(! empty($blog)){{ $blog->content }}@endif</textarea>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </form>
                    <div class="overlay">
                        <i class="fa fa-refresh fa-spin "></i>
                        <input type="hidden" id="uid" name="uid" value ={{ $user->uid }}>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="post-id" name="post-id" @if(! empty($blog)) value={{ $blog->id }}@else value="" @endif>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')
        <script>
        setSideBarActive('posts-menu');
        $('.overlay').hide();
        $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('content');
        });

        var savePost = function() {
            for ( instance in CKEDITOR.instances ) {
                CKEDITOR.instances[instance].updateElement();
            }

            $('.overlay').show();
            startLaddas();

            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
            $.ajax( {
                type: "POST",
                url: "/admin/post/create",
                data: $('#create-form').serialize(),
                success: function( response ) {

                    $('#flash-message').find('.container').html(response.message);
                    if(response.status == 'error') {
                        $('#flash-message').addClass('alert-error');
                        if (response.error.errors) {
                            $('#flash-message').find('.container').append('<br>' + response.error.errors);
                        }
                    }
                    if(response.status == 'success') {
                        $('#flash-message').addClass('alert-success');
                        @if($action == 'Create')
                                window.location.href = '/admin/post/edit/' + response.id;
                        @endif
                    }

                    $('#post-id').val(response.id);
                    $('#publish').addClass('disabled');
                    $('#unpublish').addClass('disabled');
                    if(response.blog_status == 'draft') {
                        $('#blog-status').removeClass('label-success').addClass('label-warning');
                        $('#blog-status').removeClass('label-info').addClass('label-warning');
                        $('#publish').removeClass('disabled');
                    } else {
                        $('#blog-status').removeClass('label-warning').addClass('label-info');
                        $('#unpublish').removeClass('disabled');
                    }

                    if(response.blog_status) {
                        $('#blog-status').text(response.blog_status.toUpperCase());
                    }
                    $('#flash-message').fadeIn();
                    stopLaddas();
                    $('.overlay').hide();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('#flash-message').addClass('alert-error');
                    $('#flash-message').find('.container').html(jqXHR.error.message);
                    $('#flash-message').show();
                    stopLaddas();
                    $('.overlay').hide();
                }

            } );
        };

        var togglePublish = function(newstatus) {
            $('#status').val(newstatus);
            savePost();
        };

        var startLaddas = function() {
            saveLadda.start();
            @if( ! empty($blog))
                publishLadda.start();
                unpublishLadda.start();
                previewLadda.start();
                deleteLadda.start();
            @endif
        };

        var stopLaddas = function() {
            @if( ! empty($blog))
               saveLadda.stop();
                publishLadda.stop();
                unpublishLadda.stop();
                previewLadda.stop();
                deleteLadda.stop();
            @endif
        };

        </script>
@stop