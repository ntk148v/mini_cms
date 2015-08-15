@extends('admin.layouts.default')
@section('content')
<div class="page-header">
	<h1>
	Dashboard <small>  Statistics Overview</small>
	</h1>
	<ol class="breadcrumb">
		<li class="active">
			<i class="fa fa-fw fa-dashboard"></i>	Dashboard
		</li>
	</ol>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-4 col-md-6">
			<div class="panel panel-danger">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-pencil fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<h2>{{$posts->count()}}</h2>
							<div>Posts</div>
						</div>
					</div>
				</div>
				<a href="{{{URL::to('admin/blogs')}}}">
					<div class="panel-footer">
						<span class="pull-left">View Details</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-lg-4 col-md-6">
			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-comments fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<h2>{{$comments->count()}}</h2>
							<div>Comments</div>
						</div>
					</div>
				</div>
				<a href="{{{URL::to('admin/comments')}}}">
					<div class="panel-footer">
						<span class="pull-left">View Details</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
		<div class="col-lg-4 col-md-6">
			<div class="panel panel-success">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<i class="fa fa-users fa-5x"></i>
						</div>
						<div class="col-xs-9 text-right">
							<h2>{{$users->count()}}</h2>
							<div>Users</div>
						</div>
					</div>
				</div>
				<a href="{{{URL::to('admin/users')}}}">
					<div class="panel-footer">
						<span class="pull-left">View Details</span>
						<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
						<div class="clearfix"></div>
					</div>
				</a>
			</div>
		</div>
	</div>
</div>
@stop