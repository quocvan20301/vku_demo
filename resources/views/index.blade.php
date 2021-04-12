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
	<link rel="stylesheet" type="text/css" href="{{ asset('./public/Css/layout_list.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('./public/Css/layout_thongbao.css')}}">
	<!-- <script type="text/javascript" src="{{ asset('./public/Js/snow.js')}}"></script> -->
	<link rel="stylesheet" type="text/css" href="{{ asset('./public/Css/hashtags.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('./public/Css/tuyensinh.css')}}">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<script type="text/javascript" src="{{ asset('./public/Js/jssor.js')}}"></script>
	<script type="text/javascript" src="{{ asset('./public/Js/jssor.slider.js')}}"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
</head>
<body>
 
	<div class="header-top">
		<div class="back-home">
			<i class="fas fa-chevron-left"></i>
			@if($_SESSION['theme'] == "Theme-2")
			<a href="{{route('them-2')}}"><p>{{__('back_home')}}</p></a>
			@elseif($_SESSION['theme'] == "Theme-3")
			<a href="{{route('them-3')}}"><p>{{__('back_home')}}</p></a>
			@else
			<a href="{{URL::to('/')}}"><p>{{__('back_home')}}</p></a>
			@endif		
		</div>
		<ul>
			<a href="http://daotao.vku.udn.vn/sv">
				<li>
					<p>Sinh viên</p>
		 		</li>
			</a>
			<a href="http://daotao.vku.udn.vn/gv">
				<li>
					<p>Cb-gv</p>
				</li>
			</a>	
			<li id="list-language">
				<p>
					@if(Session::get('language') == "vi")
					<img src="{{ asset('./public/Images/home/lg-vietnam.jpg')}}" alt="Viet Nam">
					@elseif(Session::get('language') == "kr")
					<img src="{{ asset('./public/Images/home/lg-hanquoc.png')}}" alt="Han Quoc">
					@else
					<img src="{{ asset('./public/Images/home/lg-en.png')}}" alt="English">
					@endif
				</p>
				<div class="sub-language">
					@if(Session::get('language') == "vi")
					<a href="{{URL::to('language/en')}}">
						<p class="p-language">
							<img src="{{ asset('./public/Images/home/lg-en.png')}}" alt="">
							English
						</p>
					</a>
					<a href="{{URL::to('language/kr')}}">
						<p class="p-language">
						<img src="{{ asset('./public/Images/home/lg-hanquoc.png')}}" alt="">
							Korea
						</p>
					</a>
					@elseif(Session::get('language') == "kr")
					<a href="{{URL::to('language/vi')}}">
						<p class="p-language">
							<img src="{{ asset('./public/Images/home/lg-vietnam.jpg')}}" alt="">
							Việt
						</p>
					</a>
					<a href="{{URL::to('language/en')}}">
						<p class="p-language">
						<img src="{{ asset('./public/Images/home/lg-en.png')}}" alt="">
							English
						</p>
					</a>
					@else
					<a href="{{URL::to('language/vi')}}">
						<p class="p-language">
							<img src="{{ asset('./public/Images/home/lg-vietnam.jpg')}}" alt="">
							Việt
						</p>
					</a>
					<a href="{{URL::to('language/kr')}}">
						<p class="p-language">
						<img src="{{ asset('./public/Images/home/lg-hanquoc.png')}}" alt="">
							Korea
						</p>
					</a>
					@endif
					
				</div>
			</li>
			<li id="list-them">
				<p>{{$_SESSION['theme']}}</p>
				<div class="sub-theme">
					@if($_SESSION['theme'] == "Theme-2")
					<a href="{{URL::to('/')}}"><p class="p-theme">Theme-1</p></a>
					<a href="{{route('them-3')}}"><p class="p-theme">Theme-3</p></a>
					@elseif($_SESSION['theme'] == "Theme-3")
					<a href="{{URL::to('/')}}"><p class="p-theme">Theme-1</p></a>
					<a href="{{route('them-2')}}"><p class="p-theme">Theme-2</p></a>
					@else
					<a href="{{route('them-2')}}"><p class="p-theme">Theme-2</p></a>
					<a href="{{route('them-3')}}"><p class="p-theme">Theme-3</p></a>
					@endif
				</div>
			</li>
		</ul>
	</div>

	<div class="header-logo">
		<?php if(isset($id_khoa)) { ?>
			<?php if($id_khoa == "khmt") { ?>
				<img src="{{ asset('./public/Images/home/vku.png')}}">
			<?php } elseif ($id_khoa == "ktmtvdt") { ?>
				<img src="{{ asset('./public/Images/home/ktmt.png')}}">
			<?php } else { ?>
				<img src="{{ asset('./public/Images/home/ktstmdt.png')}}">
			<?php } ?>
		<?php } ?>
		<div class="burger-container">
			<div id="burger">
				<div class="bar topBar"></div>
				<div class="bar btmBar"></div>
				<div class="bar btmBar-1"></div>
			</div>
		</div>
		<div class="img-header">
			<img src="{{ asset('./public/Images/home/vku.png')}}">
		</div>
		<div class="header">		
			<ul class="menu-moblie">
				@if($_SESSION['theme'] == "Theme-2")
				<li class="menu-item"><a href="{{URL::to('/theme-2')}}">Trang chủ</a></li>
				@elseif($_SESSION['theme'] == "Theme-3")
				<li class="menu-item"><a href="{{URL::to('/theme-3')}}">Trang chủ</a></li>
				@else
				<li class="menu-item"><a href="{{URL::to('/')}}">Trang chủ</a></li>
				@endif
				<li class="menu-item"><a href="{{URL::to('/gioi-thieu-khoa')}}">Giới thiệu khoa</a></li>
				<li class="menu-item"><a href="#">Ngành đào tạo</a></li>
				<li class="menu-item"><a href="{{URL::to('/tuyen-sinh')}}">Tuyển sinh</a></li>
				<li class="menu-item"><a href="{{URL::to('thong-tin-thong-bao')}}">Thông tin thông báo</a></li>
				<li class="menu-item"><a href="{{URL::to('/nghien-cuu-khoa-hoc')}}">Nghiên cứu khoa học</a></li>
			</ul>
		</div>
		<script type="text/javascript">
			(function(){
				var header = document.querySelector('.burger-container'),
				header_open = document.querySelector('.header');

				burger.onclick = function() {
					header_open.classList.toggle('menu-opened');
					header.classList.toggle('burger-opened');
				}
			}());
		</script>
	</div>

	<div class="header-menu">
		@if($_SESSION['theme'] == "Theme-2")
		<a href="{{URL::to('/theme-2')}}" id="imgscrhd"><img src="{{ asset('./public/Images/home/logofooter.png')}}"></a>
		@elseif($_SESSION['theme'] == "Theme-3")
		<a href="{{URL::to('/theme-3')}}" id="imgscrhd"><img src="{{ asset('./public/Images/home/logofooter.png')}}"></a>
		@else
		<a href="{{URL::to('/')}}" id="imgscrhd"><img src="{{ asset('./public/Images/home/logofooter.png')}}"></a>
		@endif
		<ul>
			@if($_SESSION['theme'] == "Theme-2")
			<li class="home"><p><a href="{{URL::to('/theme-2')}}">Trang chủ</a></p></li>
			@elseif($_SESSION['theme'] == "Theme-3")
			<li class="home"><p><a href="{{URL::to('/theme-3')}}">Trang chủ</a></p></li>
			@else
			<li class="home"><p><a href="{{URL::to('/')}}">Trang chủ</a></p></li>
			@endif	

			<li class="cool-link">
				<p>Giới thiệu</p>
				<div class="nav-sub-content">
					<ul>
						<li><a href="{{URL::to('/gioi-thieu-khoa')}}">Giới thiệu khoa</a></li>
						<li><a href="{{URL::to('/the-manh')}}">Thế mạnh của khoa</a></li>
						<li><a href="#">Đội ngũ GV-CB</a></li>
						<li><a href="{{URL::to('/thong-tin-lien-he')}}">Thông tin liên hệ</a></li>
					</ul>
				</div>
			</li>
			<li class="cool-link">
				<p>Ngành đào tạo</p>
				<div class="nav-sub-content">
					<ul>
						<li><a href="#">Chương trình đào tạo</a></li>
						<li><a href="#">Danh sách môn học</a></li>
					</ul>
				</div>
			</li>
			<li class="cool-link"><p><a href="{{URL::to('/tuyen-sinh')}}">Tuyển sinh</a></p></li>
			<li class="cool-link">
				<p>Tin tức - Sự kiên</p>
				<div class="nav-sub-content">
					<ul>
						<li><a href="{{URL::to('thong-tin-thong-bao')}}">Thông tin - Thông báo</a></li>
						<li><a href="{{URL::to('hoat-dong-ngoai-khoa')}}">Hoạt động ngoại khoá</a></li>
						<li><a href="{{URL::to('/bieu-mau')}}">Văn bản - Biểu mẫu</a></li>
						<li><a href="{{URL::to('/tin-tuc-nganh')}}">Tin tức ngành</a></li>
					</ul>
				</div>
			</li>
			<li class="cool-link"><p><a href="{{URL::to('/nghien-cuu-khoa-hoc')}}">Nghiên cứu khoa học</a></p></li>
			<li class="cool-link">
				<p>Sinh viên</p>
				<div class="nav-sub-content-sv">
					<ul>
						<li>
							<ul>
								<li><a href="#">Hoạt động sinh viên</a></li>
								<li><a href="#">Vinh danh sinh viên</a></li>
							</ul>
						</li>
						<li>
							<ul>
								<li><a href="#">Clb sinh viên</a></li>
								<li><a href="#">Cơ hội việc làm</a></li>
							</ul>
						</li>
						<li class="nav-sub-sv-1">
							<ul>
								<li><a href="{{URL::to('/goc-ky-nang')}}">Góc kĩ năng</a></li>
								<li><a href="#">Góc tiếng Anh</a></li>
								<li><a href="#">ĐA, KL, luận văn, luận án TN</a></li>
							</ul>
						</li>
						<li>
							<ul>
								<li><a href="#">Thời khoá biểu</a></li>
								<li><a href="http://elearning.vku.udn.vn/">E-learning</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</li>
		</ul>	
	</div>

	<script type="text/javascript">
		$(window).scroll(function() {
			if($(window).scrollTop() > $(window).height() - 200) {
				$('.header-menu').addClass('fixed');
				document.getElementById('imgscrhd').style.display = 'block';
			} else {
				$('.header-menu').removeClass('fixed');
				document.getElementById('imgscrhd').style.display = 'none';
			}
		});	

		$('#list-them').on('click', function () {
			$(this).children('.sub-theme').slideToggle();
		});

		$('#list-language').on('click', function () {
			$(this).children('.sub-language').slideToggle();
		});

	</script>

	@yield('indexHome')
	@yield('indexSub')

</body>
</html>