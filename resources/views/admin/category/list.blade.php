@extends('dashboard')

@section('head')

@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-md-6">
                <h1>
                    Categories
                </h1>
            </div>
            <div class="col-md-6">
                <div class="btn-group pull-right">
                    <button type="button" id="add-category" class="btn btn-default btn-sm ladda-button" data-style="zoom-in" data-size="xs" data-spinner-color="gray"><i class="fa fa-plus"></i> New</button>
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
        setSideBarActive('categories-menu');
    </script>
@stop