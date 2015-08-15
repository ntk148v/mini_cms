@extends('site.layouts.default')
{{-- Styles --}}
@section('styles')
@parent
@stop
{{-- Web site Title --}}
@section('title')
{{{ String::title($post->title) }}} ::
@parent
@stop
{{-- Update the Meta Title --}}
@section('meta_title')
@parent
@stop
{{-- Update the Meta Description --}}
@section('meta_description')
<meta name="description" content="{{{ $post->meta_description() }}}" />
@stop
{{-- Update the Meta Keywords --}}
@section('meta_keywords')
<meta name="keywords" content="{{{ $post->meta_keywords() }}}" />
@stop
@section('meta_author')
<meta name="author" content="{{{ $post->author->username }}}" />
@stop
{{-- Content --}}
@section('content')
<div class="col-md-8">
	<h2>{{ $post->title }}</h2>
	<p>{{ $post->content() }}</p>
	<div>
		<span class="badge badge-info">Posted {{{ $post->date() }}}</span>
	</div>
	<hr>
	<!-- social button -->
	<div class="addthis_sharing_toolbox"></div>
	<!-- ./ socical button -->
	<hr>
	<a id="comments"></a>
	<h4>{{ $comments->count() }} {{ \Illuminate\Support\Pluralizer::plural('Comment', $comments->count()) }}</h4>
	@if ($comments->count())
	@foreach ($comments as $comment)
	<div class="row">
		<div class="col-md-1">
			@if(empty($comment->author->img_path))
			<img class="thumbnail" src="http://placehold.it/60x60" alt="">
			@else
			<img class="thumbnail" src="{{asset($comment->author->img_path)}}">
			@endif
		</div>
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<div class="row">
				<div class="col-md-11">
					<span class="muted">{{{ $comment->author->username }}}</span>
					&bull;
					{{{ $comment->date() }}}
				</div>
				<div class="col-md-11">
					<hr />
				</div>
				<div class="col-md-11">
					{{ nl2br(e($comment->content())) }}
				</div>
			</div>
		</div>
	</div>
	<hr />
	@endforeach
	@else
	<hr />
	@endif
	{{ $commentForm }}
</div>
<!--Right Panel -->
@include('site/right_panel')
<!-- ./right panel -->
@stop