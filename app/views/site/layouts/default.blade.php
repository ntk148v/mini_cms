<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>
		@section('title')
		Laravel 4 Sample Site
		@show
		</title>
		@section('meta_keywords')
		<meta name="keywords" content="your, awesome, keywords, here" />
		@show
		@section('meta_author')
		<meta name="author" content="Nguyen Tuan Kien" />
		@show
		@section('meta_description')
		<meta name="description" content="HUST" />
		@show
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap-theme.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}">
		<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
		@section('styles')
		<style>
		body {
			padding: 60px 0;
		}
		h2 {
			font-family: 'Roboto Condensed', sans-serif;
			color: #FCA205;
			margin-bottom: 50px;
		}
		</style>
		@show
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{{ asset('assets/ico/apple-touch-icon-144-precomposed.png') }}}">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{{ asset('assets/ico/apple-touch-icon-114-precomposed.png') }}}">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}}">
		<link rel="apple-touch-icon-precomposed" href="{{{ asset('assets/ico/apple-touch-icon-57-precomposed.png') }}}">
		<link rel="shortcut icon" href="{{{ asset('assets/ico/favicon.png') }}}">
	</head>
	<body>
		<div id="wrap">
			<!-- Navbar -->
			<div class="navbar navbar-default navbar-inverse navbar-fixed-top">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						</button>
					</div>
					<div class="collapse navbar-collapse navbar-ex1-collapse">
						<ul class="nav navbar-nav">
							<li {{ (Request::is('/') ? ' class="active"' : '') }}><a href="{{{ URL::to('') }}}"><h7 style="font-family: 'Lobster', cursive; color: #45c79d;">MY BLOG</h7></a></li>
						</ul>
						<ul class="nav navbar-nav pull-right">
							@if (Auth::check())
							@if (Auth::user()->hasRole('admin'))
							<li><a href="{{{ URL::to('admin') }}}">Admin Panel</a></li>
							@endif
							<li class="dropdown">
								<a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#">
									@if(empty(Auth::user()->img_path))
									<img src="{{asset('/uploads/no_avatar.jpg')}}" alt="no avatar" width="25" height="25">
									@else
									<img src="{{asset(Auth::user()->img_path)}}" width="25" height="25">
									@endif
									<span class="caret"></span>
								</a>
								<ul id="g-account-menu" class="dropdown-menu" role="menu">
									<li><a href="{{URL::to('user')}}">Logged in as {{{ Auth::user()->username }}}</a></li>
									<li><a href="{{{URL::to('user/logout')}}}"><i class="glyphicon glyphicon-lock"></i> Logout</a></li>
								</ul>
							</li>
							@else
							<li {{ (Request::is('user/login') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/login') }}}">Login</a></li>
							<li {{ (Request::is('user/create') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/create') }}}">{{{ Lang::get('site.sign_up') }}}</a></li>
							@endif
						</ul>
						<!-- ./ nav-collapse -->
					</div>
				</div>
			</div>
			<!-- ./ navbar -->
			<!-- Carousel -->
			@if(!Auth::check())
			<div id="bg-fade-carousel" class="carousel slide carousel-fade" data-ride="carousel">
				<div class="carousel-inner">
					<div class="item active">
						<div class="slide1"></div>
					</div>
					<div class="item">
						<div class="slide2"></div>
					</div>
					<div class="item">
						<div class="slide3"></div>
					</div>
				</div>
			</div>
			<div class="container carousel-overlay text-center">
				<h1>Hello! Welcome to My Blog</h1>
				<p class="lead"> This is my 1st blog.Sign up to join with me.</p>
				<p class="lead"> Scroll down to check some posts.You may be interested</p>
				<a class="btn btn-lg btn-success fp-buttons" href="{{{ URL::to('user/login') }}}">
					<span class="fa fa-check"></span> Login
				</a>
				<a class="btn btn-lg btn-success fp-buttons" href="{{{ URL::to('user/create') }}}">
					<span class="fa fa-user-plus"></span> Sign Up
				</a>
			</div>
			@endif
			<!-- ./carousel -->
			<!-- Container -->
			<div class="container">
				<!-- Notifications -->
				@include('notifications')
				<!-- ./ notifications -->
				<!-- Content -->
				@yield('content')
				<!-- ./ content -->
			</div>
			<!-- ./ container -->
			<div id="push"></div>
		</div>
		<!-- ./wrap -->
		<!-- Footer -->
		<div id="footer" class="navbar navbar-default navbar-fixed-bottom">
			<div class="container">
				<p class="navbar-text pull-left">Blog Built By BK Team</p>
				<a href="https://www.facebook.com/taosedodaihoc" class="navbar-btn btn btn-primary pull-right"><i class="fa fa-fw fa-facebook"></i></a>
				<a href="https://www.twitter.com/ntk148v" class="navbar-btn btn btn-info pull-right"><i class="fa fa-fw fa-twitter"></i></a>
				<a href="https://youtube.com" class="navbar-btn btn btn-danger pull-right"><i class="fa fa-lg fa-youtube"></i></a>
			</div>
		</div>
		<!-- ./footer -->
		<!-- Javascripts
		================================================== -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<!-- Add this - add social button -->
		<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5550d7541b6df252" async="async"></script>
		<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5550d7541b6df252" async="async"></script>
		<!-- ./ social button -->
		<!-- Bootstrap -->
		<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
		<!-- ./ bootstrap  -->
		@yield('scripts')
	</body>
</html>