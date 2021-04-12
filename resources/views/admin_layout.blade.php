<!DOCTYPE html>
<html lang="en">
<head> 
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('./public/Css/admin.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('./public/Css/menu_footer.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('./public/Css/decuongchitiet.css')}}">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
	<link rel="stylesheet" href="{{ asset('./public/Js/dropzone/dropzone.css')}}" type="text/css">
	<script src="https://cdn.tiny.cloud/1/gs0pa5cuczbr5b24pvedu0twwply9bryqr1lal4ncmjdtkfm/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">

</head>
<body>
	
	<div class="admin">
		<div class="aside-left">
			<div class="top-aside-left">
				<div class="img">
					<a href="{{URL::to('/')}}"><img src="{{ asset('./public/Images/home/logofooter.png')}}" id="imgscrhd"></a>
				</div>
			</div>
			<ul class="menu-ad-nav">
				<li class="menu-ad-item item-dashboard">
					<p><a href="{{URL::to('/admin')}}">Dashboard</a></p>
				</li>
				<li class="menu-ad-item1">
					<p>Custom</p>
				</li>
				<li class="menu-ad-item">
					<p>Bài viết</p>
					<i class="icon-menu-ad-item fas fa-chevron-right"></i>
					<ul class="sub-menu-ad-item">
						<li><p><a href="{{URL::to('/insert-post')}}">Đăng bài</a></p></li>
						<li><p><a href="{{URL::to('/all-post/all/1')}}">Danh sách bài đăng</a></p></li>
					</ul>
				</li>
				<li class="menu-ad-item">
					<p>Bài viết Khoa</p>
					<i class="icon-menu-ad-item fas fa-chevron-right"></i>
					<ul class="sub-menu-ad-item">
						<li><p><a href="{{URL::to('/insert-post-khoa')}}">Đăng bài Khoa</a></p></li>
						<li><p><a href="{{URL::to('/all-post-khoa/1')}}">Danh sách bài đăng Khoa</a></p></li>
					</ul>
				</li>
				<li class="menu-ad-item">
					<p>Biểu mẫu</p>
					<i class="icon-menu-ad-item fas fa-chevron-right"></i>
					<ul class="sub-menu-ad-item">
						<li><p><a href="{{URL::to('/upload-form')}}">Tải biểu mẫu lên</a></p></li>
						<li><p><a href="{{URL::to('/all-form')}}">Danh sách biểu mẫu</a></p></li>
					</ul>
				</li>
				<li class="menu-ad-item">
					<p>Menu Footer</p>
					<i class="icon-menu-ad-item fas fa-chevron-right"></i>
					<ul class="sub-menu-ad-item">
						<li><p><a href="{{URL::to('/edit-menu')}}">Quản lí Menu</a></p></li>
						<li><p><a href="{{URL::to('/edit-footer')}}">Quản lí Footer</a></p></li>
					</ul>
				</li>
				<li class="menu-ad-item">
					<p>Đề cương</p>
					<i class="icon-menu-ad-item fas fa-chevron-right"></i>
					<ul class="sub-menu-ad-item">
						<li><p><a href="{{URL::to('/them-de-cuong')}}">Thêm đề cương</a></p></li>
						<li><p><a href="{{URL::to('/danh-sach-de-cuong')}}">Danh sách đề cương</a></p></li>
					</ul>
				</li>
				<li class="menu-ad-item">
					<p><a href="#">Dashboard1</a></p>
				</li>
			</ul>
		</div>
		<div class="aside-right">
			<div class="top-aside-right">
				<div class="div-info-left">
					{{__('Hello') }}
				</div>
				<div class="div-info-right" id="info-right">
					<div class="logo-div-info-right">
						<img src="{{ asset('./public/Images/home/logofooter.png')}}">
					</div>
					<h3>Admin</h3>
				</div>
				<a href="#">
					<div id="logout">
						<p>Thoát</p>
					</div>
				</a>
			</div>
			<div class="bottom-aside-right">

		 		@yield('admin_content')

			</div>
		</div>
	</div>

</body>
</html>

<script type="text/javascript">

	$(document).ready(function() {

		$('.menu-ad-nav .menu-ad-item').on('click', function() {
			$(this).children('.sub-menu-ad-item').slideToggle();
			$(this).children('.icon-menu-ad-item').toggleClass('fa-chevron-right fa-chevron-down');
		});

		$('.list-danh-muc .icon-menu').on('click', function () {
			$(this).parent('li').children('.sub-menu').slideToggle();
			$(this).toggleClass('fa-chevron-right fa-chevron-down');
		});

		$('.list-danh-muc > li > ul > li > p').on('click', function() {
			var datadmcl = this.dataset.value;
			$('.list-danh-muc > li > ul > li > p').removeClass('ocldm');
			(this).classList.toggle('ocldm');
			$('#hddanhmuc').val(datadmcl);
			var namedmcl = $(this).text();
			$('#thumucdc').val(namedmcl);
		});

		$('#info-right').on('click', function() {
			// alert('msg');
			document.getElementById("logout").style.display = 'block';
		});
		
		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function(e) {
					$('#imgPrime').attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]); 
			}
		}		

		$("#fileUpload").change(function() {
			readURL(this);
		});


	});

</script>