@extends('indexSub')
@section('contendThongTinChiTiet')

<div class="main-thong-tin-chi-tiet">
	<div class="top-main-thong-tin-chi-tiet">
		<div class="title-tmgt">
			<ul>
				<li><p>Trang chủ</p></li>
				<li><i class="fas fa-chevron-right"></i></li>
				<li><p>Thông tin chi tiết</p></li>
			</ul>
		</div>
	</div>
	
	<div class="main-thong-tin-chi-tiet-left">
		<div class="block-1">
			<div class="title-block-1">
				<div class="content-title-block-1">
					<h3>{{ $contentdetail->Title_l0 }}</h3>
					<p>{{ $contentdetail->ViewedCount }} lượt xem</p>
				</div>
			</div>
		
			<div class="content-block-1" id="content-tt-bl1">
				
			</div>
			<script type="text/javascript">
				var dataenc = <?php echo json_encode(html_entity_decode($contentdetail->Content_l0, ENT_QUOTES, "utf-8")); ?>;
				$('#content-tt-bl1').html(dataenc);
			</script>
			<div class="list-hash-tags-ttct">
				<p>Tags:</p>
				
			</div>
		</div>
	</div>
	<div class="main-thong-tin-chi-tiet-right">
			<div class="right-hien-thi" style="width: 90%;">
				<div class="right-danh-muc">
					<h2 class="i-title">Danh mục</h2>
					<ul>
						<li><a href="#">1</a></li>
						
					</ul> 
				</div>
				<div class="right-danh-muc">
					<h2 class="i-title">Tin tức nổi bật nhất</h2>
					<div class="rg-post clearfix">
						<a href="#" class="img">
							<img class="embed-responsive" alt="IMG Description" src="">
						</a>
						<h3 class="title">
							<a href="#">1</a>
						</h3>
					</div>
				</div>	
			</div>
	</div>
</div>

@endsection