<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Trường Đại học Công nghệ Thông tin và Truyền thông Việt Hàn - Đại học Đà Nẵng - Khoa Khoa học máy tính</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('./public/Css/home.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('./public/Css/chitiet-bieumau.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('./public/Css/gioithieukhoa.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('./public/Css/bieumau.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('./public/Css/themanh.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('./public/Css/thongtinchitiet.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('./public/Css/thongtinthongbao.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('./public/Css/main-theme-1.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('./public/Css/main-theme-2.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('./public/Css/hashtags.css')}}">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
</head>
<body>

<div class="back-admin">
	<a href="{{URL::to('./admin')}}"><h3>Về Admin</h3></a>
</div>
	
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
					<p>06/02/2020 | 1311 lượt xem</p>
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
				@foreach($list_hash_tags as $value_hashtags)
				<a href="{{URL::to('tags/'.$value_hashtags->Slug_tags)}}">{{$value_hashtags->name_tags}}</a>
				@endforeach
			</div>
		</div>
	</div>
	<div class="main-thong-tin-chi-tiet-right">
		<div class="block-2">
			<div class="title-block-2">
				<div class="content-title-block-2">
					<h3>Thế mạnh của khoa</h3>
				</div>
			</div>
			<div class="content-block-2">
				<ul>
					<li>
						<div class="img-ctbl2">
							<img src="{{ asset('./public/Images/home/image1.jpg')}}">
						</div>
						<div class="tt-ctbl2">
							<p class="nd-ctbl2">Ngay cả các công ty an ninh mạng cũng để rò rỉ dữ liệu nội bộ</p>
							<p class="day-ctbl2">17/09/2020</p>
						</div>
					</li>
					<li>
						<div class="img-ctbl2">
							<img src="{{ asset('./public/Images/home/image1.jpg')}}">
						</div>
						<div class="tt-ctbl2">
							<p class="nd-ctbl2">Ngay cả các công ty an ninh mạng cũng để rò rỉ dữ liệu nội bộ</p>
							<p class="day-ctbl2">17/09/2020</p>
						</div>
					</li>
					<li>
						<div class="img-ctbl2">
							<img src="{{ asset('./public/Images/home/image1.jpg')}}">
						</div>
						<div class="tt-ctbl2">
							<p class="nd-ctbl2">Ngành Công nghệ thông tin (CNTT): Đào tạo nhân lực chất lượng cao cho thị trường nước ngoài</p>
							<p class="day-ctbl2">17/09/2020</p>
						</div>
					</li>
					<li>
						<div class="img-ctbl2">
							<img src="{{ asset('./public/Images/home/image1.jpg')}}">
						</div>
						<div class="tt-ctbl2">
							<p class="nd-ctbl2">Ngành Công nghệ thông tin (CNTT): Đào tạo nhân lực chất lượng cao cho thị trường nước ngoài</p>
							<p class="day-ctbl2">17/09/2020</p>
						</div>
					</li>
					<li>
						<div class="img-ctbl2">
							<img src="{{ asset('./public/Images/home/image1.jpg')}}">
						</div>
						<div class="tt-ctbl2">
							<p class="nd-ctbl2">Ngành Công nghệ thông tin (CNTT): Đào tạo nhân lực chất lượng cao cho thị trường nước ngoài</p>
							<p class="day-ctbl2">17/09/2020</p>
						</div>
					</li>
					<li>
						<div class="img-ctbl2">
							<img src="{{ asset('./public/Images/home/image1.jpg')}}">
						</div>
						<div class="tt-ctbl2">
							<p class="nd-ctbl2">Ngành Công nghệ thông tin (CNTT): Đào tạo nhân lực chất lượng cao cho thị trường nước ngoài</p>
							<p class="day-ctbl2">17/09/2020</p>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>

</body>
</html>