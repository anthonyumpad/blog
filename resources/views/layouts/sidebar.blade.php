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

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">General</li>
            <!-- Optionally, you can add icons to the links -->
            <li id="dashboard-menu"><a href="/admin/dashboard"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
            <li id="customers-menu"><a href="/admin/customers/list"><i class="fa fa-users"></i><span>Customers</span></a></li>
            <li class="header">Payments</li>
            <li id="payments-overview"><a href="/admin/payments/overview"><i class="fa fa-eye"></i><span>Overview</span></a></li>
            <li id="payments-list"><a href="/admin/payments/list"><i class="fa fa-list"></i><span>List</span></a></li>
            <li class="header">Gateway Subscriptions</li>
            <li id="plans-list"><a href="/admin/plans"><i class="fa fa-gift"></i><span>Plans</span></a></li>
            <li id="agreements-list"><a href="/admin/agreements"><i class="fa fa-thumbs-up"></i><span>Agreements</span></a></li>
            <li class="header">Tests</li>
            <li class="treeview">
                <a href="#"><i class="fa fa-check-square-o"></i><span>Tests</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li id="add-cust"><a href="/admin/test-add-customer"><span>Add Customer</span></a></li>
                    <li id="add-card"><a href="/admin/test-add-card"><span>Add Card</span></a></li>
                    <li id="card-payment"><a href="/admin/test-card-payment"><span>Card Payment</span></a></li>
                    <li id="token-payment"><a href="/admin/test-token-payment"><span>Token Payment</span></a></li>
                    <li id="redirect-payment"><a href="/admin/test-redirect-payment"><span>Redirect Payment</span></a></li>
                    <li id="pww-paymentlist"><a href="/admin/test-pww-paymentlist"><span>Widget Payment List Test</span></a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>