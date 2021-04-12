@extends('indexSub')
@section('contendThontinThongbao')

<script type="text/javascript">
	
getdatacms(1);

function getdatacms(pageCurrent) {
	var url = "http://localhost:2003/vku/thong-tin-thong-bao/getdataajax";
	$.ajax({
		url: url,
		type: 'GET',
		cache: false,
		data: {"pageCurrent":pageCurrent},
		success: function(data) {
			if (data != null) {
				 $('#thongtinthongbao-gaj').html(data);
			}   
		}
	});
} 

</script>
<div class="main-thong-tin-thong-bao">
	<div class="top-main-thong-tin-thong-bao">
		<div class="title-tmgt">
			<ul>
				<li><p>Trang chủ</p></li>
				<li><i class="fas fa-chevron-right"></i></li>
				<li><p>Thông tin - thông báo</p></li>
			</ul>
		</div>
	</div>
	<div class="main-thong-tin-thong-bao-left">
		<div class="block-1" id="thongtinthongbao-gaj">
			<div class="title-block-1">
				<div class="content-title-block-1">
					<h3>Thông tin thông báo</h3>
				</div>
			</div>
			<script type="text/javascript">
				$(document).ready(function() {
					$('.pagin-pagea .qwer1 li').live('click',function() {
						var getabc = this.id; 
						getdatacms(getabc);
					});
				});
			</script>
		</div>
	</div>
	<div class="main-thong-tin-thong-bao-right">
		<div class="block-2">
			<div class="title-block-2">
				<div class="content-title-block-2">
					<h3>Hoạt động ngoại khoá</h3>
				</div>
			</div>
			<div class="content-block-2">
				<ul>
					@foreach($all_hoatdongngoaikhoa as $value_hdnkhoaa)
					<li>
						<div class="img-ctbl2">
							<a href="{{URL::to('thong-tin-chi-tiet/'.$value_hdnkhoaa->Slug)}}"><img src="{{ asset('./public/uploads/Cms_img/'.$value_hdnkhoaa->Avatar)}}"></a>
						</div>
						<div class="tt-ctbl2">
							<p class="nd-ctbl2"><a href="{{URL::to('thong-tin-chi-tiet/'.$value_hdnkhoaa->Slug)}}">{{$value_hdnkhoaa->Title_l0}}</a></p>
							<p class="day-ctbl2">{{date('d/m/Y', strtotime($value_hdnkhoaa->Date))}}</p>
						</div>
					</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</div>

@endsection