@extends('indexSub')
@section('contendGioithieu')
 
<div class="main-hash-tags">
	<div class="main-hash-tags-left">
		<div class="block-1">
			<div class="top-block-1">
				<p>Tag</p>
				<h3>{{$name_hashtagsl}}</h3>
			</div>
			@foreach ($list_name_tags as $value_lnht)
			<div class="content-block-1">
				<ul>
					<li>
						<div class="tt-ctbl1">
							<p class="p-text"><a href="{{URL::to('thong-tin-chi-tiet/'.$value_lnht->Slug)}}">{{$value_lnht->Title_l0}}</a></p>
							<p class="p-day">{{date('d/m/Y', strtotime($value_lnht->Date))}}</p>
							<p class="p-ct">{{$value_lnht->SimpleContent_l0}}</p>
						</div>
						<div class="img-ctbl1">
							<a href="{{URL::to('thong-tin-chi-tiet/'.$value_lnht->Slug)}}"><img src="{{ asset('./public/uploads/Cms_img/'.$value_lnht->Avatar)}}"></a>
						</div>
					</li>
				</ul>
			</div>
			@endforeach
		</div>
	</div>
	<div class="main-hash-tags-right">
		<div class="block-2">
			<div class="title-block-2">
				<div class="content-title-block-2">
					<h3>Thế mạnh của khoa</h3>
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