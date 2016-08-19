<!DOCTYPE HTML>
<html>
<head>
	<title>Admin @yield('head.title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset= "utf-8" />
	<meta name="csrf-token" content="{{ csrf_token() }}"/>
	<link href="{!! asset('assets-admin/css/bootstrap.min.css') !!}" rel='stylesheet' />
	<link href="{!! asset('assets-admin/css/font-awesome.css') !!}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/jquery-ui.css')}}"/>
	<link href="{!! asset('assets-admin/css/icon-font.min.css') !!}"  rel="stylesheet"/>
	<link href="{!! asset('assets-admin/css/animate.css') !!}" rel="stylesheet"  media="all">
	<link href="{!! asset('assets-admin/css/image_uploader.css') !!}" rel="stylesheet" type="text/css">
	<!-- MetisMenu CSS -->
	<link href="{!! asset('assets-admin/bower_components/metisMenu/dist/metisMenu.min.css') !!}" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="{!! asset('assets-admin/dist/css/style.css') !!}" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="{!! asset('assets-admin/bower_components/font-awesome/css/font-awesome.min.css') !!}" rel="stylesheet" type="text/css">

	<!-- DataTables CSS -->
	<link href="{!! asset('assets-admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') !!}" rel="stylesheet">

	DataTables Responsive CSS
	<link href="{!! asset('assets-admin/bower_components/datatables-responsive/css/dataTables.responsive.css') !!}" rel="stylesheet">
	<link href="{!! asset('assets-admin/css/style.css') !!}" rel='stylesheet' />
	<link href="{!! asset('assets-admin/css/main.css') !!}" rel='stylesheet' />
	<script src="{!! asset('assets-admin/ckeditor/ckeditor.js') !!}"></script>

	@yield('style')

</head> 
<body class="sticky-header left-side-collapsed">
    <section>
    <!-- left side start-->
		<div class="left-side sticky-left-side">
			<div class="logo">
				<h1>Admin</h1>
			</div>
			<div class="logo-icon text-center">
				<a href="#"><i class="lnr lnr-home"></i> </a>
			</div>

			<!--logo and iconic logo end-->
			<div class="left-side-inner">

				<!--sidebar nav start-->
					<ul class="nav nav-pills nav-stacked custom-nav">
						<li class="active"><a href="{{asset('admin')}}">
							<i class="lnr lnr-layers"></i>
							<span>Dashboard</span></a>
						</li>
						<li class="menu-list">
							<a href="#">
								<i class="lnr lnr-database"></i>
								<span>Product</span>
							</a>
							<ul class="sub-menu-list">
								<li>
									<a href="{!! url('admin/product') !!}">Product List</a> </li>
								<li><a href="{!! url('admin/product/create') !!}">Add Product</a></li>
								<li><a href="{!! url('admin/sizecolor') !!}">Size_Color</a></li>
							</ul>
						</li>
						<li class="menu-list">
							<a href="#">
								<i class="lnr lnr-list"></i>
								<span>Category</span>
							</a>
							<ul class="sub-menu-list">
								<li>
									<a href="{!! url('admin/category') !!}">Category List</a> </li>
								<li><a href="{!! url('admin/category/add') !!}">Add Product</a></li>
							</ul>
						</li>
						<li class="menu-list"><a href="#">
							<i class="lnr lnr-cart"></i>
							<span>Order</span>
						</a>
							<ul class="sub-menu-list">
								<li><a href="{!! url('admin/order/list') !!}">Order List</a> </li>
								<li><a href="{!! url('admin/order/add') !!}">Order Add</a></li>
							</ul>
						</li>
						<!-- Customer -->
						<li class="menu-list"><a href="#">
								<i class="lnr lnr-users"></i>
								<span>Customer</span>
							</a>
							<ul class="sub-menu-list">
								<li><a href="{!! url('admin/customer/list') !!}">Customer List</a> </li>
								<li><a href="{!! url('admin/customer/add') !!}">Customer Add</a></li>
							</ul>
						</li>
					</ul>
				<!--sidebar nav end-->
			</div>
		</div>
		<!-- left side end-->
    
		<!-- main content start-->
		<div class="main-content">
			<!-- header-starts -->
			<div class="header-section">
			<!--toggle button start-->
			<a class="toggle-btn  menu-collapsed"><i class="fa fa-bars"></i></a>
			<!--toggle button end-->
			<!--notification menu start -->
			<div class="menu-right">
				<div class="user-panel-top">  	
					<div class="profile_details">		
						<ul>
							<li class="dropdown profile_details_drop">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									<div class="profile_img">
<!--										<span><img src="{!! url('admin/images/1.png') !!}" alt=""> </span>-->
										 <div class="user-name">
											<p>{{Auth::guard('admin')->user()->email}}<span>Administrator</span></p>
										 </div>
										 <i class="lnr lnr-chevron-down"></i>
										 <i class="lnr lnr-chevron-up"></i>
										<div class="clearfix"></div>	
									</div>	
								</a>
								<ul class="dropdown-menu drp-mnu">
<!--									<li> <a href="#"><i class="fa fa-cog"></i> Settings</a> </li>-->
<!--									<li> <a href="#"><i class="fa fa-user"></i>Profile</a> </li>-->
									<li> <a href="{{asset('admin/auth/logout')}}"><i class="fa fa-sign-out"></i> Logout</a> </li>
								</ul>
							</li>
							<div class="clearfix"> </div>
						</ul>
					</div>		
					<div class="clearfix"></div>
				</div>
			  </div>
			<!--notification menu end -->
			</div>
			<div id="page-wrapper">
				<div class="row">
					<div class="col-sm-12">
						@if(Session::has('message'))
							<div class="alert alert-{!! Session::get('level') !!}">
								{!! Session::get('message') !!}
							</div>
						@endif
					</div>
				</div>
				@yield('content')
			</div>
    </section>
	<script src="{!! asset('assets-admin/js/jquery-1.10.2.min.js') !!}"></script>
	<script src="{!! asset('assets-admin/js/bootstrap.min.js') !!}"></script>
	<script type="text/javascript" src="{{asset('assets/js/jquery/jquery-ui.js')}}"></script>
	<!-- Metis Menu Plugin JavaScript -->
	<script src="{{ url('assets-admin/bower_components/metisMenu/dist/metisMenu.min.js') }}"></script>

	<!-- Custom Theme JavaScript -->
	<script src="{{ url('assets-admin/dist/js/script.js') }}"></script>

	<!-- DataTables JavaScript -->
	<script src="{{ url('assets-admin/bower_components/DataTables/media/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ url('assets-admin/bower_components/datatables-responsive/js/dataTables.responsive.js') }}"></script>
	<script src="{{ url('assets-admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>

	<script src="{!! asset('assets-admin/js/imgupload.min.js') !!}"></script>
	<script src="{!! asset('assets-admin/js/jquery.nicescroll.js') !!}"></script>
	<script src="{!! asset('assets-admin/js/scripts.js') !!}"></script>
	<script type="text/javascript" src="{!! asset('assets-admin/javascript/myscript.js') !!}"></script>
	<script>
		$(document).ready(function(){
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
		});
	</script>
	@yield('body.js')
</body>
</html>