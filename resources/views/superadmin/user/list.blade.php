@extends('dashboard')
@section('content')
    @include('layouts/flash-message-session')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-md-6">
                <h1>
                    Users
                </h1>
            </div>
            <div class="col-md-6">
                <div class="btn-group pull-right">
                    <a href="/superadmin/user/create" class="button btn-success btn-sm" role="button"><i class="fa fa-plus"></i> New</a>
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
                                            <option value="sortByUserName">Username</option>
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
                                <th>Username</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Created Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $adminuser)
                                <tr>
                                    <td><a href="/superadmin/user/edit/{{ $adminuser->uid }}">{{ $adminuser->username }}</a></td>
                                    <td>{{ $adminuser->email }}</td>
                                    <td>{{ $adminuser->roles[0]->slug }}</td>
                                    <td class="date">{{ $adminuser->created_at }}</td>
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
                        <div class="dataTables_info" >Showing 1 to {{ $users->perPage() }} of {{ $users->total() }} entries
                        </div>
                    </div>
                    <div class="col-sm-7 text-right">{!! $users->render() !!}</div>
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
            var url = '/superadmin/user/list?limit=' + $('#limit').val() + '&sortBy=' + $('#sortBy').val();
            window.location.href = url;
        };
        setSideBarActive('users-menu');
    </script>
@stop