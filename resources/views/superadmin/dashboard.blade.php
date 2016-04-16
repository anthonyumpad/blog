@extends('dashboard')

@section('head')
    <!-- Ladda Themeless -->
    <link href="{{ asset("/css/ladda-themeless.min.css") }}" rel="stylesheet">

    <style>
        #reportRange{
            background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc
        }
    </style>
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-md-4">
                <h1 id="dashboard-title">
                    Dashboard
                </h1>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="small-box bg-olive">
                    <div class="inner">
                        <h3>{{ $userCount }}</h3>
                        <p>Users</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="/superadmin/user/list" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="small-box bg-gray">
                    <div class="inner">
                        <h3>{{ $categoryCount }}</h3>
                        <p>User Categories</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cubes"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-file-circle-right"></i></a>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{ $postCount }}</h3>
                        <p>User Posts</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-file-text-o"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-file-circle-right"></i></a>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-file-text-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">User Draft Posts</span>
                        <span class="info-box-number">{{ $draftPostCount }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-file-text-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">User Published Posts</span>
                        <span class="info-box-number">{{ $publishedPostCount }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-black"><i class="fa fa-file-text-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">User Deleted Posts</span>
                        <span class="info-box-number">{{ $deletePostCount }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>
    </section>
@endsection

@section('footer')
    <script>
        setSideBarActive('dashboard-menu');
    </script>
@stop