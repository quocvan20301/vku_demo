@extends('indexSub')
@section('contendGioithieu')

<div class="main-the-manh">
	<div class="top-main-the-manh">
		<div class="title-tmgt">
			<ul>
				<li><p>Trang chủ</p></li>
				<li><i class="fas fa-chevron-right"></i></li>
				<li><p>Nghiên cứu khoa học</p></li>
			</ul>
		</div>
	</div>
	<div class="main-the-manh-left">
		<div class="block-1">
			<div class="title-block-1">
				<div class="content-title-block-1">
					<h3>Nghiên cứu khoa học</h3>
				</div>
			</div>
			<div class="content-block-1">

				<ul>
					@foreach($all_nghiencuukhoahoc as $value_phdnk)
					<li>
						<div class="img-ctbl1">
							<a href="{{URL::to('thong-tin-chi-tiet/'.$value_phdnk->Slug)}}"><img src="{{ asset('./public/uploads/Cms_img/'.$value_phdnk->Avatar)}}"></a>
						</div>
						<div class="tt-ctbl1">
							<a href="{{URL::to('thong-tin-chi-tiet/'.$value_phdnk->Slug)}}"><p class="p-text">{{$value_phdnk->Title_l0}}</p></a>
							<p class="p-day">{{date('d/m/Y', strtotime($value_phdnk->Date))}}</p>
							<p class="p-ct">{{$value_phdnk->SimpleContent_l0}}</p>
							<a href="{{URL::to('thong-tin-chi-tiet/'.$value_phdnk->Slug)}}"><p class="p-xct">Xem chi tiết <i class="fas fa-chevron-right"></i></p></a>
						</div>
					</li>
					@endforeach
				</ul>

			</div>
		</div>
	</div>
	<div class="main-the-manh-right">
		<div class="block-2">
			<div class="title-block-2">
				<div class="content-title-block-2">
					<h3>Thông tin - thông báo</h3>
				</div>
			</div>
			<div class="content-block-2">
				<ul>
					@foreach($all_thongtinthongbao as $value_thongtinthongbao)
					<li>
						<div class="img-ctbl2">
							<a href="{{URL::to('thong-tin-chi-tiet/'.$value_thongtinthongbao->Slug)}}"><img src="{{ asset('./public/uploads/Cms_img/'.$value_thongtinthongbao->Avatar)}}"></a>
						</div>
						<div class="tt-ctbl2">
							<a href="{{URL::to('thong-tin-chi-tiet/'.$value_thongtinthongbao->Slug)}}"><p class="nd-ctbl2">{{$value_thongtinthongbao->Title_l0}}</p></a>
							<p class="day-ctbl2">{{date('d/m/Y', strtotime($value_thongtinthongbao->Date))}}</p>
						</div>
					</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</div>

@endsection