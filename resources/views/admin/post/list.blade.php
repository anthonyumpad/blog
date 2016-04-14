@extends('dashboard')

@section('head')

@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-md-6">
                <h1>
                    Posts
                </h1>
            </div>
            <div class="col-md-6">
                <div class="btn-group pull-right">
                    <a href="/admin/post/create" class="button btn-success btn-sm" role="button"><i class="fa fa-plus"></i> New</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
    </section>
@endsection

@section('footer')
    <script>
        setSideBarActive('posts-menu');
    </script>
@stop