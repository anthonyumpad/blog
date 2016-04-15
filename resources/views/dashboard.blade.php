<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
	<meta charset="UTF-8">
	<title>{{ $page_title or Session::get('site_name')['name'].' Dashboard' }}</title>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<!-- Bootstrap 3.3.2 -->
	<link href="{{ asset("/bower_components/admin-lte/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
	<!-- Font Awesome Icons -->
	<link href="{{ asset("/bower_components/fontawesome/css/font-awesome.min.css") }}" rel="stylesheet" type="text/css" />
	<!-- Ionicons -->
	<link href="//code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
	<!-- Theme style -->
	<link href="{{ asset("/bower_components/admin-lte/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
	<!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
	<link href="{{ asset('/css/blog-admin.css') }}" rel="stylesheet">
	<link href="{{ asset("/bower_components/admin-lte/dist/css/skins/_all-skins.min.css")}}" rel="stylesheet" type="text/css" />
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="//oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>	<!-- jQuery 2.1.3 -->
	<script src="{{ asset ("/bower_components/admin-lte/plugins/jQuery/jQuery-2.1.4.min.js") }}"></script>
	<script src="{{ asset("/bower_components/moment/moment.js") }}"></script>
	<!-- blog specific js stuff -->
	<script src="{{ asset ("/js/blog-admin.js") }}" type="text/javascript"></script>
	<!--[endif]-->
	<!-- Ladda Themeless -->
	<link href="{{ asset("/bower_components/ladda/dist/ladda-themeless.min.css") }}" rel="stylesheet">
	<script src="{{ asset("/bower_components/ladda/js/spin.js") }}"></script>
	<script src="{{ asset("/bower_components/ladda/js/ladda.js") }}"></script>
	<link href="{{ asset('/css/blog-admin.css') }}" rel="stylesheet">
	<!-- datatables -->
	<link href="{{ asset("/bower_components/admin-lte/plugins/datatables/dataTables.bootstrap.css") }}" rel="stylesheet">
    @yield('head')
</head>
<body class="skin-blue sidebar-mini layout-boxed">
<div class="wrapper">
	<!-- Header -->
	@include('layouts/header')
	<!-- Sidebar -->
    @if (! empty($user))
	    @include('layouts/sidebar')
    @else
        @include('layouts/sidebar-system')
    @endif
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Main content -->
		<section class="content">
			<!-- Your Page Content Here -->
			@yield('content')
		</section><!-- /.content -->
	</div><!-- /.content-wrapper -->

	<!-- Footer -->
	@include('layouts/footer')
			<!-- Control Sidebar -->
	@if(Session::has('user_config'))
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Create the tabs -->
			<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
				<li class="active"><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">
				<!-- Settings tab content -->
				<div class="tab-pane active" id="control-sidebar-settings-tab">
					<form role="form" action="/admin/users/save-settings" method="POST">
						<h3 class="control-sidebar-heading">General</h3>

						<h3 class="control-sidebar-heading">TimeZone Settings</h3>
						<ul class="control-sidebar-menu" >
							<li>
								<a>
									<i class="menu-icon fa fa-clock-o bg-red"></i>
									<div class="menu-info" style="margin-top:0">
										<select name="timezone" class="form-control">
											@foreach(Session::get('timezones') as $timezone)
												@if(! empty($timezone->keyname))
													@if(Session::get('user_timezone') == $timezone->keyname)
														<option value="{{$timezone->keyname}}" selected>{{$timezone->description}}</option>
													@else
														<option value="{{$timezone->keyname}}">{{$timezone->description}}</option>
													@endif
												@endif
											@endforeach
										</select>
									</div>
								</a>
							</li>
						</ul>
						<div class="form-group-sm pull-right" style="margin-top:30px">
							<button type="submit" class="btn btn-primary">Save</button>
						</div>
					</form>
				</div><!-- /.tab-pane -->
			</div>
		</aside><!-- /.control-sidebar -->
	@endif
	<!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
	<div class='control-sidebar-bg'></div>
</div><!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- AdminLTE App -->
<script src="{{ asset ("/bower_components/admin-lte/dist/js/app.js") }}" type="text/javascript"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset ("/bower_components/admin-lte/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>
<!-- Slimscroll -->
<script src="{{ asset ("/bower_components/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js") }}" type="text/javascript"></script>
<!-- FastClick -->
<script src="{{ asset ("/bower_components/admin-lte/plugins/fastclick/fastclick.min.js") }}" type="text/javascript"></script>
<script>
	var AdminLTEOptions = {
		//Enable sidebar expand on hover effect for sidebar mini
		//This option is forced to true if both the fixed layout and sidebar mini
		//are used together
		sidebarExpandOnHover: true,
		//BoxRefresh Plugin
		enableBoxRefresh: true,
		//Bootstrap.js tooltip
		enableBSToppltip: true,
		//Add slimscroll to navbar menus
		//This requires you to load the slimscroll plugin
		//in every page before app.js
		navbarMenuSlimscroll: true,
		navbarMenuSlimscrollWidth: "3px", //The width of the scroll bar
		navbarMenuHeight: "200px", //The height of the inner menu
		//General animation speed for JS animated elements such as box collapse/expand and
		//sidebar treeview slide up/down. This options accepts an integer as milliseconds,
		//'fast', 'normal', or 'slow'
		animationSpeed: 500,
		//Sidebar push menu toggle button selector
		sidebarToggleSelector: "[data-toggle='offcanvas']",
		//Activate sidebar push menu
		sidebarPushMenu: true,
		//Activate sidebar slimscroll if the fixed layout is set (requires SlimScroll Plugin)
		sidebarSlimScroll: true,
		//Enable sidebar expand on hover effect for sidebar mini
		//This option is forced to true if both the fixed layout and sidebar mini
		//are used together
		sidebarExpandOnHover: false,
		//BoxRefresh Plugin
		enableBoxRefresh: true,
		//Bootstrap.js tooltip
		enableBSToppltip: true,
		BSTooltipSelector: "[data-toggle='tooltip']",
		//Enable Fast Click. Fastclick.js creates a more
		//native touch experience with touch devices. If you
		//choose to enable the plugin, make sure you load the script
		//before AdminLTE's app.js
		enableFastclick: true,
		//Control Sidebar Options
		enableControlSidebar: true,
		controlSidebarOptions: {
			//Which button should trigger the open/close event
			toggleBtnSelector: "[data-toggle='control-sidebar']",
			//The sidebar selector
			selector: ".control-sidebar",
			//Enable slide over content
			slide: true
		},
	};
</script>
@yield('footer')

</body>
</html>