<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>
		@section('title')
		Administration
		@show
		</title>
		<meta name="keywords" content="@yield('keywords')" />
		<meta name="author" content="@yield('author')" />
		<!-- Google will often use this as its description of your page/site. Make it good. -->
		<meta name="description" content="@yield('description')" />
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
		<link rel="shortcut icon" href="{{{ asset('assets/ico/favicon.png') }}}">
		<!-- iOS favicons. -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{{ asset('assets/ico/apple-touch-icon-144-precomposed.png') }}}">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{{ asset('assets/ico/apple-touch-icon-114-precomposed.png') }}}">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}}">
		<link rel="apple-touch-icon-precomposed" href="{{{ asset('assets/ico/apple-touch-icon-57-precomposed.png') }}}">
		<!-- CSS -->
		<link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap-theme.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/css/wysihtml5/prettify.css')}}">
		<link rel="stylesheet" href="{{asset('assets/css/wysihtml5/bootstrap-wysihtml5.css')}}">
		<link rel="stylesheet" href="{{asset('assets/css/datatables-bootstrap.css')}}">
		<link rel="stylesheet" href="{{asset('assets/css/colorbox.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}">
		
	</head>
	<body>
		<!-- Header -->
		<div id="top-nav" class="navbar navbar-inverse navbar-static-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-toggle"></span>
					</button>
					<a class="navbar-brand" href="#">MINI CMS</a>
				</div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#">
								<i class="fa fa-fw fa-user"></i> Admin <span class="caret"></span></a>
								<ul id="g-account-menu" class="dropdown-menu" role="menu">
									<li><a href="{{URL::to('user')}}">My Profile</a></li>
									<li><a href="{{{URL::to('user/logout')}}}"><i class="glyphicon glyphicon-lock"></i> Logout</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
				</div> <!-- /Header -->
				<!-- Main -->
				<div class="container">
					<div class="row">
						<div class="col-sm-3">
							<h3><i class="glyphicon glyphicon-briefcase"></i> Toolbox</h3>
							<hr>
							<ul class="nav nav-stacked">
								<li>
									<a href="{{{URL::to('/')}}}"><i class="fa fa-2x pull-right fa-home"></i><h4>  View Site  </h4></a>
								</li>
								<li>
									<a href="{{{URL::to('admin')}}}"><i class="fa fa-2x pull-right fa-dashboard"></i><h4>  Dashboard  </h4></a>
								</li>
								<li>
									<a href="{{{URL::to('admin/blogs')}}}"><i class="fa fa-2x pull-right fa-pencil"></i><h4>  Posts  </h4></a>
								</li>
								<li>
									<a href="{{{URL::to('admin/comments')}}}"><i class="fa fa-2x pull-right fa-comments"></i><h4>  Comments  </h4></a>
								</li>
								<li>
									<a href="{{{URL::to('admin/users')}}}"><i class="fa fa-2x pull-right fa-users"></i><h4>  Users  </h4></a>
								</li>
								<li>
									<a href="{{{URL::to('admin/roles')}}}"><i class="fa fa-2x pull-right fa-lock"></i><h4>  User's Roles  </h4></a>
								</li>
							</ul>
						</div>
						<div class="col-sm-9">
							@include('notifications')
							@yield('content')
						</div>
					</div>
				</div>
				<!-- Footer -->
				<div id="footer" class="navbar navbar-default navbar-fixed-bottom">
					<div class="container">
						<p class="navbar-text pull-left">Blog Built By Kien Team</p>
						<a href="https://www.facebook.com/taosedodaihoc" class="navbar-btn btn btn-primary pull-right"><i class="fa fa-fw fa-facebook"></i></a>
						<a href="https://www.twitter.com/ntk148v" class="navbar-btn btn btn-info pull-right"><i class="fa fa-fw fa-twitter"></i></a>
						<a href="https://youtube.com" class="navbar-btn btn btn-danger pull-right"><i class="fa fa-lg fa-youtube"></i></a>
					</div>
				</div>
				<!-- ./footer -->
				
				
				<!-- Javascripts -->
				<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
				<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
				<script src="{{asset('assets/js/wysihtml5/wysihtml5-0.3.0.js')}}"></script>
				<script src="{{asset('assets/js/wysihtml5/bootstrap-wysihtml5.js')}}"></script>
				<script src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
				<script src="{{asset('assets/js/datatables-bootstrap.js')}}"></script>
				<script src="{{asset('assets/js/datatables.fnReloadAjax.js')}}"></script>
				<script src="{{asset('assets/js/jquery.colorbox.js')}}"></script>
				<script src="{{asset('assets/js/prettify.js')}}"></script>
				<script type="text/javascript">
					$('.wysihtml5').wysihtml5();
				$(prettyPrint);
				</script>
				@yield('scripts')
			</body>
		</html>