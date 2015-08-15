@extends('site.layouts.default')
@section('styles')
@parent
<style type="text/css">
	#main_row{
		margin-top: 50px;
	}
</style>
@stop
{{-- Content --}}
@section('content')
<div class="page-header">
	<ol class="breadcrumb">
		<h1><strong>All Posts</strong></h1>
	</ol>
</div>
<div class="col-md-8">
	@foreach ($posts as $post)
	<div class="row">
		<div>
			<!-- Post Title -->
			<div class="row">
				<div class="col-md-10">
					<h3><strong><a href="{{{ $post->url() }}}">{{ String::title($post->title) }}</a></strong></h3>
				</div>
			</div>
			<hr>
			<!-- ./ post title -->
			<!-- Post Content -->
			<div class="row">
				<div class="col-md-4">
					<a href="{{{ $post->url() }}}" class="thumbnail">
						@if(empty($post->img_path))
						<img src="http://placehold.it/260x180" alt="">
						@else
						<img src="{{asset($post->img_path)}}">
						@endif
					</a>
				</div>
				<div class="col-md-7">
					<p>
						{{ String::tidy(Str::limit($post->content, 200)) }}
					</p>
					<br>
					<div class="row">
						<div class="col-md-8"></div>
						<div class="col-md-3">
							<p><a class="btn btn-mini btn-primary" href="{{{ $post->url() }}}">Read more  <span class="fa fa-fw fa-chevron-right"></span></a></p>
						</div>
					</div>
				</div>
			</div>
			<!-- ./ post content -->
			<!-- Post Footer -->
			<div class="row">
				<div class="col-md-8">
					<p></p>
					<p>
						<span class="fa fa-fw fa-user"></span> by <span class="muted">{{{ $post->author->username }}}</span>
						| <span class="fa fa-fw fa-calendar"></span> <!--Sept 16th, 2012-->{{{ $post->date() }}}
						| <span class="fa fa-fw fa-comments"></span> <a href="{{{ $post->url() }}}#comments">{{$post->comments()->count()}} {{ \Illuminate\Support\Pluralizer::plural('Comment', $post->comments()->count()) }}</a>
					</p>
				</div>
			</div>
			<!-- ./ post footer -->
		</div>
	</div>
	<hr />
	@endforeach
</div>
{{ $posts1->links() }}
<!--Right Panel -->
@include('site/right_panel')
<!-- ./right panel -->
@stop