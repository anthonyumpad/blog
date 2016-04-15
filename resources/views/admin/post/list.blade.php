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
        <div class="box box-default">
            <div class="box-header">
                <div class="row">
                    <form id="list-form"  method="get">
                        <div class="col-sm-2">
                            <div class="dataTables_filter">
                                <div class="dataTables_length" id="example1_length">
                                    <label>Show</label>
                                        <select class="form-control" name="limit" id="limit" onchange="changeParams()">
                                            <option selected>10</option>
                                            <option>25</option>
                                            <option>50</option>
                                            <option>100</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8 pull-right">
                            <div class="dataTables_filter">
                                <div class="dataTables_length" id="example1_length">
                                    <label>Sort By</label>
                                        <select class="form-control" name="sortBy" id="sortBy"  onchange="changeParams()">
                                            <option value="sortByDateDesc" selected>Latest</option>
                                            <option value="sortByDateAsc">Oldest</option>
                                            <option value="sortByCategory">Category</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table no-margin bg-white">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Created Date</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td><a href="/admin/post/edit/{{ $post->id }}">{{ $post->title }}</a></td>
                                    <td>@if(! empty($post->category->name)) {{ $post->category->name }} @endif</td>
                                    <td>{{ $post->description }}</td>
                                    <td class="date">{{ $post->created_at }}</td>
                                    <td>
                                        @if($post->status == 'draft')
                                            <span class="label label-warning">DRAFT</span>
                                        @elseif($post->status == 'published')
                                            <span class="label label-info">PUBLISHED</span>
                                        @else
                                            <span class="label label-default">{{ $post->status }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="dataTables_info" >Showing 1 to {{ $posts->perPage() }} of {{ $posts->total() }} entries
                        </div>
                    </div>
                    <div class="col-sm-7 text-right">{!! $posts->render() !!}</div>
                </div>
            </div>
            <div class="overlay">
                <i class="fa fa-refresh fa-spin "></i>
            </div>
        </div>
    </section>
@endsection

@section('footer')
    <script>
        $('.overlay').hide();
        $('#limit').val("{{  $limit }}");
        $('#sortBy').val("{{  $sortBy }}");
        var changeParams = function() {
            $('.overlay').show();
            var url = '/admin/post/list?limit=' + $('#limit').val() + '&sortBy=' + $('#sortBy').val();
            window.location.href = url;
        };

        setSideBarActive('posts-menu');
    </script>
@stop