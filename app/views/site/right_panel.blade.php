<div class="col-md-4">
	<br>
	<!-- Blog Search -->
	<form class="form-horizontal" method="POST" action="{{ URL::to('blog/index') }}" accept-charset="UTF-8">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="well">
			<h4 style="text-align:center">Blog Search</h4>
			<div class="input-group">
				<input type="text" class="form-control" name="searchBlog">
				<span class="input-group-btn">
					<button class="btn btn-default" type="submit" name="submitSearch">
					<span class="fa fa-fw fa-search"></span>
					</button>
				</span>
			</div>
		</div>
	</form>
	<div class="well">
		<h4 style="text-align:center">Blog Categories</h4>
		<div class="row">
			<div class="col-lg-12">
				<ul class="list-unstyled">
					<?php
						$count=1;
					?>
					@foreach($posts1 as $post)
					<li><a href="{{{ $post->url() }}}"><button type="button" class="btn btn-default" style="width: 300px">Post {{{$count++}}}: {{{$post->date_month()}}}</button></a></li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
	<div class="well">
		<table class="table table-hover">
			<h4 style="text-align:center">About Us</h4>
			<thead>
				<tr>
					<th>Sinh Viên Đại Học Bách Khoa</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td style="padding-top:20px;">Nguyễn Tuấn Kiên </td>
					<td><a href="https://www.facebook.com/taosedodaihoc?fref=ts" target="_blank"> <img src="https://fbcdn-sphotos-d-a.akamaihd.net/hphotos-ak-xfp1/v/t1.0-9/10014535_603192623104293_1955181261_n.jpg?oh=e6cfaeaea3f1c5287a8e57dc2b9bf000&oe=55D594BA&__gda__=1439330528_ccec48cada68c8718405a86d0ef5d5e7" height="50" width="50"/></a></td>
				</tr>
				
				<tr>
					<td style="padding-top:20px;">Nguyễn Đa Long </td>
					<td><a href="https://www.facebook.com/profile.php?id=100006727534054" target="_blank"> <img src="https://fbcdn-sphotos-f-a.akamaihd.net/hphotos-ak-xap1/v/t1.0-9/1970943_1453383301562574_1042695051_n.jpg?oh=08fe403f09723953c4966e14867846f9&oe=560B7054&__gda__=1440189708_d30c523094b5789dcb42a7a5493386dd" height="50" width="50"/></a></td>
				</tr>
				<tr>
					<td style="padding-top:20px;">Phạm Ngọc Hiếu </td>
					<td><a href="https://www.facebook.com/phamhieu94hn?fref=ts" target="_blank"> <img src="https://fbcdn-sphotos-f-a.akamaihd.net/hphotos-ak-xfa1/v/t1.0-9/394581_307558462675320_1981367494_n.jpg?oh=4344caf5611ada6e149f738465ffcbb2&oe=55BEB0F8&__gda__=1439928945_dcb39ccabdc8be22e7d5bb4224c45365" height="50" width="50"/></a></td>
				</tr>
			<tr></tr>
		</tbody>
	</table>
</div>
</div>