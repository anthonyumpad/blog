<!-- Main Header -->
<header class="main-header">
    <!-- Logo -->
    <a href="/admin/dashboard" class="logo">
        <!--span class="logo-mini">
            <img src="/img/logo2.svg"  class="dashboard-logo-mini"/>
        </span>
        <span class="logo-lg">
            <img src="/img/logo2.svg" width="200px" alt="" class="dashboard-logo"/>
        </span-->
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="header-site-name">
            {{Session::get('site_name')['name']}}

            @if(!empty(Session::get('site_name')['short_code']))
            ({{Session::get('site_name')['short_code']}})
            @endif
        </div>

        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="{{ asset("img/default_user.png") }}" class="user-image" alt="User Image"/>
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{$user->first_name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="{{  asset("img/default_user.png") }}" class="img-circle" alt="User Image" />
                            <p>
                               {{$user->username}}
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a class="btn btn-default btn-flat" onclick="changePassword()">Change Password</a>
                            </div>
                            <div class="pull-right">
                                <a href="/admin/logout" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
@if (Session::has('passwordErrors'))
    <script>
        $(document).ready(function() {
            $('#changePasswordModal').modal('show');
        });
    </script>
    @endif
<!-- Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLable">
    <form id="form_change_password" method="post" action="/admin/change-password">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Change Password</h4>
                </div>
                <div class="modal-body">
                    @if (Session::has('passwordErrors'))
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                                <p>{{Session::get('passwordErrors')}}</p>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="currentPassword">Current Password</label>
                        <input type="password" class="form-control" id="accountId" name="currentPassword" placeholder="Enter Current Password" required>
                    </div>
                    <div class="form-group">
                        <label for="newPassword">New Password</label>
                        <input type="password" class="form-control" id="email" name="newPassword" placeholder="Enter New Password" required>
                    </div>
                    <div class="form-group">
                        <label for="re-newPassword">Re-enter New Password</label>
                        <input type="password" class="form-control" id="email" name="re-newPassword" placeholder="Re-Enter New Password" required>
                    </div>
                </div><!-- /.box-body -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="password" class="btn btn-info"  id="changePasswordButton">Change</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </form>
</div><!-- /.modal -->
<script>
    var changePassword = function(){
        $('#changePasswordModal').modal('show');
    };
</script>