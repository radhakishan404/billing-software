<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>VPRAN | Dashboard</title>
	<!-- <script src="<?php echo base_url('resources/'); ?>global/plugins/jquery.min.js" type="text/javascript"></script> -->

	<!-- <script src="<?php echo base_url('resources/'); ?>js/script/jquery.validate.js"></script> -->
	<!-- <script src="<?php echo base_url('resources/'); ?>js/script/form_validation.js"></script> -->

	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?php echo base_url('resources/'); ?>bower_components/bootstrap/dist/css/bootstrap.min.css">

	<link rel="stylesheet" href="<?php echo base_url('resources/'); ?>css/style.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url('resources/'); ?>bower_components/font-awesome/css/font-awesome.min.css">

	<link rel="stylesheet" href="<?php echo base_url('resources/'); ?>bower_components/bootstrap-daterangepicker/daterangepicker.css">
	<!-- bootstrap datepicker -->
	<link rel="stylesheet" href="<?php echo base_url('resources/'); ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	<!-- iCheck for checkboxes and radio inputs -->
	<link rel="stylesheet" href="<?php echo base_url('resources/'); ?>plugins/iCheck/all.css">
	<!-- Ionicons -->
	<!-- Select2 -->
	<link rel="stylesheet" href="<?php echo base_url('resources/'); ?>bower_components/select2/dist/css/select2.min.css">
	<link rel="stylesheet" href="<?php echo base_url('resources/'); ?>bower_components/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('resources/'); ?>dist/css/AdminLTE.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins
	folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="<?php echo base_url('resources/'); ?>dist/css/skins/_all-skins.min.css">
	<!-- jvectormap -->
	<link rel="stylesheet" href="<?php echo base_url('resources/'); ?>bower_components/jvectormap/jquery-jvectormap.css">
	<!-- Date Picker -->
	<link rel="stylesheet" href="<?php echo base_url('resources/'); ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="<?php echo base_url('resources/'); ?>bower_components/bootstrap-daterangepicker/daterangepicker.css">
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" href="<?php echo base_url('resources/'); ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">


	<!-- datatables -->
	<link rel="stylesheet" href="<?php echo base_url('resources/'); ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
	<link href="<?php echo base_url('resources/'); ?>global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" href="<?php echo base_url('resources/'); ?>css/countrySelect.css">
	<!-- <link rel="stylesheet" href="<?php echo base_url('resources/'); ?>css/demo.css"> -->
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<script src="<?php echo base_url('resources/'); ?>bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url('resources'); ?>/dist/css/js/custom.min.js"></script>
<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<style type="text/css">


</style>
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">

	<div class="preloader">
		<div class="lds-ripple">
			<div class="lds-pos"></div>
			<div class="lds-pos"></div>
		</div>
	</div>

	<div class="wrapper">

		<header class="main-header">
			<!-- Logo -->
			<a href="" class="logo">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini"><b>Vpran</b></span>
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg"><b>Vpran</b> inc</span>
			</a>
			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<!-- User Account: style can be found in dropdown.less -->
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="<?php echo base_url() ?>/uploads/profile/<?php echo $this->session->userdata['user_data']['profile']; ?>" class="user-image" alt="User Image">
								<span class="hidden-xs"><?php echo $this->session->userdata['user_data']['name']; ?></span>
							</a>
							<ul class="dropdown-menu">
								<!-- User image -->
								<li class="user-header">
									<img src="<?php echo base_url() ?>/uploads/profile/<?php echo $this->session->userdata['user_data']['profile']; ?>" class="img-circle" alt="User Image">
									<p>
										<?php echo $this->session->userdata['user_data']['name']; ?>
										<small>Admin of S/W</small>
									</p>
								</li>
								<li class="user-footer">
									<div class="pull-left">
										<a href="<?php echo base_url('company/profile'); ?>" class="btn btn-default btn-flat">Profile</a>
									</div>
									<div class="pull-right">
										<a href="<?php echo base_url('login/logout/'.$this->session->userdata['user_data']['id']); ?>" class="btn btn-default btn-flat">Sign out</a>
									</div>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
				<!-- Sidebar user panel -->
				<div class="user-panel">
					<div class="pull-left image">
						<img src="<?php echo base_url() ?>/uploads/profile/<?php echo $this->session->userdata['user_data']['profile']; ?>" class="img-circle" alt="User Image">
					</div>
					<div class="pull-left info">
						<p><a href="<?php echo base_url('company/profile'); ?>"><?php echo $this->session->userdata['user_data']['name']; ?></p>
						<i class="fa fa-circle text-success"></i> Online</a>
					</div>
				</div>
				<!-- search form -->
				<div class="sidebar-form">
					<div class="input-group">
						<input type="text" name="q" id="search" class="form-control" placeholder="Search...">
						<span class="input-group-btn">
							<button type="button" class="btn btn-flat"><i class="fa fa-search"></i>
							</button>
						</span>
					</div>
				</div>
				<!-- /.search form -->
				<!-- sidebar menu: : style can be found in sidebar.less -->
				<ul class="sidebar-menu" id="sidebar_menu" data-widget="tree">
					<!-- <li class="header">MAIN NAVIGATION</li> -->
					<?php if($this->session->userdata['role']!='admin'){ ?>

						<li class="nav-item <?php echo $this->uri->segment(1)=='dashboard'?'active open':''; ?>">
							<a href="<?php echo base_url('dashboard') ?>" class="nav-link nav-toggle">
								<i style="padding-right: 5px;" class="icon-home"></i>
								<span class="title">Dashboard</span>
								<span class="selected"></span>
							</a>
						</li>

						<?php
						$service_id = explode(',', $this->session->userdata['user_data']['service_id']);

						$services = $service;
						?>

						<?php foreach($services as $s) { ?>
							<?php if(in_array($s['id'], $service_id)) { ?>
								<li class="nav-item <?php echo $this->uri->segment(1)==strtolower($s['name'])?'active open':''; ?>">
									<a href="<?php echo base_url(strtolower($s['name'])); ?>/lists" class="nav-link nav-toggle">
										<i style="padding-right: 5px;" class=" <?php if($s['name']=='Customer') { echo 'icon-user'; }; if($s['name']=='Product') { echo 'fa fa-cubes'; }; if($s['name']=='Invoice') { echo 'icon-notebook'; }; if($s['name']=='Quotation') { echo 'fa fa-file-text'; }; if($s['name']=='Stock') { echo 'icon-layers'; }; if($s['name']=='Supplier') { echo 'fa fa-industry'; }; if($s['name']=='Purchase') { echo 'fa fa-shopping-cart'; }; if($s['name']=='Ledger') { echo 'icon-book-open'; }; ?> "></i>
										<span class="title"><?php echo ucfirst($s['name']); ?></span>
										<span class="selected"></span>
									</a>
								</li>
							<?php } ?>

						<?php } ?>

					<?php }else{ ?>
						<li class="<?php echo $this->uri->segment(1)=='home'?'active':''; ?>">
							<a href="<?php echo base_url('home') ?>">
								<i class="fa fa-dashboard"></i> <span>Dashboard</span>
							</a>
						</li>
						<li class="<?php echo $this->uri->segment(1)=='user'?'active':''; ?>">
							<a href="<?php echo base_url('user/lists'); ?>">
								<i class="glyphicon glyphicon-user"></i> <span>Users</span>
							</a>
						</li>

						<li class="<?php echo $this->uri->segment(1)=='package'?'active':''; ?>">
							<a href="<?php echo base_url('package/lists'); ?>">
								<i class="glyphicon glyphicon-briefcase"></i> <span>User Package</span>
							</a>
						</li>

						<li class="<?php echo $this->uri->segment(1)=='service'?'active':''; ?>">
							<a href="<?php echo base_url('service/lists'); ?>">
								<i class="glyphicon glyphicon-cog"></i> <span>User Service</span>
							</a>
						</li>
					<?php } ?>
				</ul>
			</section>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					<?php echo $page_title; ?>
					<small><?php echo $caption; ?></small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="<?php if($this->session->userdata['role']!='admin'){ echo base_url('dashboard'); } else { echo base_url('home'); } ?>"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active"><?php echo $page_title; ?></li>
				</ol>
			</section>

			<?php $this->load->view($middle_view); ?>

		</div>

		<!-- /.content-wrapper -->
		<footer class="main-footer">
			<div class="pull-right hidden-xs">
				<b>Version</b> 2.4.0
			</div>
			<strong>Copyright &copy; 2014-2016 <a href="https://vpran.in/">Vpran inc</a>.</strong> All rights reserved.
		</footer>
	</div>
	<!-- ./wrapper -->

	<!-- jQuery 3 -->

	<!-- jQuery UI 1.11.4 -->

	<script src="<?php echo base_url('resources/dist'); ?>/popper.js/dist/umd/popper.min.js"></script>

	<script src="<?php echo base_url('resources/'); ?>bower_components/jquery-ui/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
		$.widget.bridge('uibutton', $.ui.button);
	</script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?php echo base_url('resources/'); ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- Select2 -->
	<script src="<?php echo base_url('resources/'); ?>bower_components/select2/dist/js/select2.full.min.js"></script>
	<!-- InputMask -->
	<script src="<?php echo base_url('resources/'); ?>plugins/input-mask/jquery.inputmask.js"></script>
	<script src="<?php echo base_url('resources/'); ?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
	<script src="<?php echo base_url('resources/'); ?>plugins/input-mask/jquery.inputmask.extensions.js"></script>
	<!-- Sparkline -->
	<script src="<?php echo base_url('resources/'); ?>bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
	<!-- jvectormap -->
	<script src="<?php echo base_url('resources/'); ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="<?php echo base_url('resources/'); ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<!-- jQuery Knob Chart -->
	<script src="<?php echo base_url('resources/'); ?>bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
	<!-- datepicker -->
	<script src="<?php echo base_url('resources/'); ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
	<!-- Bootstrap WYSIHTML5 -->
	<script src="<?php echo base_url('resources/'); ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
	<!-- Slimscroll -->
	<script src="<?php echo base_url('resources/'); ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo base_url('resources/'); ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url('resources/'); ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
	<!-- FastClick -->
	<script src="<?php echo base_url('resources/'); ?>bower_components/fastclick/lib/fastclick.js"></script>
	<script src="<?php echo base_url('resources/'); ?>js/countrySelect.js"></script>

	<script>
		$("#country_selector").countrySelect({
			defaultCountry: "in",
	// onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
	// responsiveDropdown: true,
	preferredCountries: ['in', 'us', 'ca']
});
</script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('resources/'); ?>dist/js/adminlte.min.js"></script>
<script>

	$(function() {
		"use strict";

		$(".preloader").fadeOut();

		$(function() {
			$('[data-toggle="tooltip"]').tooltip()
		})
	});
	$(function () {
//Initialize Select2 Elements
$('.select2').select2({
	dropdownAutoWidth : true,
	minimumResultsForSearch: -1,
	placeholder: "Select a option"
});

$('.select_search').select2({
	placeholder: "Select a option"
});

$('.selectname').select2({
	dropdownAutoWidth : true,
});
$('[data-mask]').inputmask();



$("#search").keyup(function() {

  // Retrieve the input field text and reset the count to zero
  var search = $(this).val(),
  count = 0;

  // Loop through the comment list
  $('#sidebar_menu li').each(function() {


    // If the list item does not contain the text phrase fade it out
    if ($(this).text().search(new RegExp(search, "i")) < 0) {
      $(this).hide();  // MY CHANGE

      // Show the list item if the phrase matches and increase the count by 1
  } else {
      $(this).show(); // MY CHANGE
      count++;
  }

});

});


})
</script>
</body>
</html>
