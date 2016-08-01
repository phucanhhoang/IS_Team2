<!DOCTYPE HTML>
<html>
<head>
	<title>Admin @yield('head.title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset= "utf-8" />
	<link href="{!! asset('assets-admin/css/bootstrap.min.css') !!}" rel='stylesheet' />
	<link href="{!! asset('assets-admin/css/font-awesome.css') !!}" rel="stylesheet"> 
	<link href="{!! asset('assets-admin/css/icon-font.min.css') !!}"  rel="stylesheet"/>
	<link href="{!! asset('assets-admin/css/animate.css') !!}" rel="stylesheet"  media="all">
	<link href="{!! asset('assets-admin/css/style.css') !!}" rel='stylesheet' />
	<link href="{!! asset('assets-admin/css/main.css') !!}" rel='stylesheet' />
	<link href="{!! asset('assets-admin/css/mycss.css') !!}" rel='stylesheet' />
	
	<script src="{!! asset('assets-admin/ckeditor/ckeditor.js') !!}"></script>

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
							<i class="lnr lnr-power-switch"></i>
							<span>Dashboard</span></a>
						</li>
						<li class="menu-list">
							<a href="#">
								<i class="lnr lnr-briefcase"></i>
								<span>Product</span>
							</a>
							<ul class="sub-menu-list">
								<li>
									<a href="{!! url('admin/product/list') !!}">Product List</a> </li>
								<li><a href="{!! url('admin/product/add') !!}">Add Product</a></li>
							</ul>
						</li>
						<li class="menu-list">
							<a href="#">
								<i class="lnr lnr-list"></i>
								<span>Category</span>
							</a>
							<ul class="sub-menu-list">
								<li>
									<a href="{!! url('assets-admin/category/list') !!}">Category List</a> </li>
								<li><a href="{!! url('assets-admin/category/add') !!}">Add Product</a></li>
							</ul>
						</li>              
						<li class="menu-list"><a href="#">
							<i class="lnr lnr-envelope"></i> 
							<span>Order</span>
						</a>
							<ul class="sub-menu-list">
								<li><a href="{!! url('admin/order/list') !!}">Order List</a> </li>
								<li><a href="{!! url('admin/order/add') !!}">Order Add</a></li>
							</ul>
						</li>      
						<li class="menu-list"><a href="#">
							<i class="lnr lnr-indent-increase"></i>
						 	<span>Customer</span>
						 </a>  
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
									<div class="profile_img"> <span><img src="{!! url('admin/images/1.png') !!}" alt=""> </span>
										 <div class="user-name">
											<p>Michael<span>Administrator</span></p>
										 </div>
										 <i class="lnr lnr-chevron-down"></i>
										 <i class="lnr lnr-chevron-up"></i>
										<div class="clearfix"></div>	
									</div>	
								</a>
								<ul class="dropdown-menu drp-mnu">
									<li> <a href="#"><i class="fa fa-cog"></i> Settings</a> </li> 
									<li> <a href="#"><i class="fa fa-user"></i>Profile</a> </li> 
									<li> <a href="sign-up.html"><i class="fa fa-sign-out"></i> Logout</a> </li>
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
	<script src="{!! asset('assets-admin/js/jquery.nicescroll.js') !!}"></script>
	<script src="{!! asset('assets-admin/js/scripts.js') !!}"></script>
	<script src="{!! asset('assets-admin/js/bootstrap.min.js') !!}"></script>
<!--	<script src="{!! asset('assets/js/myscript.js') !!}"></script>-->
	@yield('body.js')
</body>
</html>