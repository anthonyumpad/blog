<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                  <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        @if(isset($user) && $user->inRole('admin'))
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">General</li>
            <!-- Optionally, you can add icons to the links -->
            <li id="dashboard-menu"><a href="/admin/dashboard"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
            <li id="categories-menu"><a href="/admin/category/list"><i class="fa fa-cubes"></i><span>Categories</span></a></li>
            <li id="posts-menu"><a href="/admin/post/list"><i class="fa fa-file-text-o"></i><span>Posts</span></a></li>
        </ul><!-- /.sidebar-menu -->
        @endif
    </section>
    <!-- /.sidebar -->
</aside>