@extends('indexHome')
@section('contendHome')

<iframe src="{{URL::to('/carousel')}}" id="frameSlide" frameborder="0" scrolling="no"></iframe>

<div class="main-theme-1">
	<div class="theme-1-left">
		<div class="title-theme-1">
			<p>Tin mới nhất</p>
		</div>
		 
		<div class="block-ct-theme-1">
			<div class="block-bl-t1">
				<div class="list-block-bl-t1">
					<span class="day-list-t1">TH12  10TH</span>
					<span class="time-list-t1">4:36 CHIỀU</span>
					<div class="content-list-t1">
						<i class="bullet bullet-3"></i>
						<span class="tt-l-t1"><a href="#">Sự kiện nổi bật</a></span>
						<p><a href="#">Sơ đồ chỗ ngồi Lễ tốt nghiệp - Khoa HTTT- 15.12.2020</a></p>
					</div>
				</div>
				<div class="list-block-bl-t1">
					<span class="day-list-t1">TH12  10TH</span>
					<span class="time-list-t1">4:36 CHIỀU</span>
					<div class="content-list-t1">
						<i class="bullet bullet-3"></i>
						<span class="tt-l-t1"><a href="#">Sự kiện nổi bật</a></span>
						<p><a href="#">Sơ đồ chỗ ngồi Lễ tốt nghiệp - Khoa HTTT- 15.12.2020</a></p>
					</div>
				</div>
				<div class="list-block-bl-t1">
					<span class="day-list-t1">TH12  10TH</span>
					<span class="time-list-t1">4:36 CHIỀU</span>
					<div class="content-list-t1">
						<i class="bullet bullet-3"></i>
						<span class="tt-l-t1"><a href="#">Sự kiện nổi bật</a></span>
						<p><a href="#">Thông báo v/v sinh viên khoa HTTT tham dự Lễ trao bằng tốt nghiệp ngày 15/12/2020 (Quan trọng)</a></p>
					</div>
				</div>
				<div class="list-block-bl-t1">
					<span class="day-list-t1">TH12  10TH</span>
					<span class="time-list-t1">4:36 CHIỀU</span>
					<div class="content-list-t1">
						<i class="bullet bullet-3"></i>
						<span class="tt-l-t1"><a href="#">Sự kiện nổi bật</a></span>
						<p><a href="#">Sơ đồ chỗ ngồi Lễ tốt nghiệp - Khoa HTTT- 15.12.2020</a></p>
					</div>
				</div>
		 		<div class="list-block-bl-t1">
					<span class="day-list-t1">TH12  10TH</span>
					<span class="time-list-t1">4:36 CHIỀU</span>
					<div class="content-list-t1">
						<i class="bullet bullet-3"></i>
						<span class="tt-l-t1"><a href="#">Seminar - học thuật</a></span>
						<p><a href="#">Thông báo tập huấn nâng cao nhận thức về Sở hữu trí tuệ "Những vấn đề cơ bản về sáng chế"</a></p>
					</div>
				</div>
			</div>
			<div class="block-bl-t2">
				<ul>
					<li><p><i class="fas fa-chevron-right"></i><a href="#">Thông báo – Học vụ</a></p></li>
					<li><p><i class="fas fa-chevron-right"></i><a href="#">Học bổng – Tuyển dụng</a></p></li>
					<li><p><i class="fas fa-chevron-right"></i><a href="#">Sự kiện nổi bật</a></p></li>
					<li><p><i class="fas fa-chevron-right"></i><a href="#">Giới thiệu – văn bản</a></p></li>
					<li><p><i class="fas fa-chevron-right"></i><a href="#">Tuyển sinh</a></p></li>
				</ul>
			</div>
		</div>

		<div class="title-2-theme-1">
			<p>QUICK LINKS</p>
		</div>

		<div class="block-2-ct-theme-1">
			<ul>
				<li><p><i class="fas fa-chevron-right"></i><a href="#">University of Information Technology</a></p></li>
				<li><p><i class="fas fa-chevron-right"></i><a href="#">University of Information Technology</a></p></li>
				<li><p><i class="fas fa-chevron-right"></i><a href="#">University of Information Technology</a></p></li>
			</ul>
		</div>
	</div>

	<script type="text/javascript">
	
	getdatattheme1(1);

	function getdatattheme1(pageCurrent) {
		var url = "http://localhost:2003/vku/theme-2/getdataallaj";
		$.ajax({
			url: url,
			type: 'GET',
			cache: false,
			data: {"pageCurrent":pageCurrent},
			success: function(data) {
				if (data != null) {
					 $('#theme-1-right-getdata').html(data);
				}   
			}
		});
	}

	</script>

	<div class="theme-1-right" id="theme-1-right-getdata">

		<!-- <div class="block-theme-1-right">
			<div class="img-theme-1-right">
				<img src="{{ asset('./public/Images/home/img1.jpg')}}">
				<div class="title-img-theme-1-right">
					<p>Sự kiện nổi bật</p>
				</div>
			</div>
			<span>THÁNG MƯỜI HAI 4TH, 2020</span>
			<p>Thông tin khóa học Scrum dành cho Sinh viênThông tin khóa học Scrum dành cho Sinh viên</p>
		</div>
		<div class="block-theme-1-right">
			<div class="img-theme-1-right">
				<img src="{{ asset('./public/Images/home/img1.jpg')}}">
				<div class="title-img-theme-1-right">
					<p>Sự kiện nổi bật</p>
				</div>
			</div>
			<span>THÁNG MƯỜI HAI 4TH, 2020</span>
			<p>Thông tin khóa học Scrum dành cho Sinh viên</p>
		</div>
		<div class="block-theme-1-right">
			<div class="img-theme-1-right">
				<img src="{{ asset('./public/Images/home/img1.jpg')}}">
				<div class="title-img-theme-1-right">
					<p>Sự kiện nổi bật</p>
				</div>
			</div>
			<span>THÁNG MƯỜI HAI 4TH, 2020</span>
			<p>Thông tin khóa học Scrum dành cho Sinh viên</p>
		</div>
		<div class="block-theme-1-right">
			<div class="img-theme-1-right">
				<img src="{{ asset('./public/Images/home/img1.jpg')}}">
				<div class="title-img-theme-1-right">
					<p>Sự kiện nổi bật</p>
				</div>
			</div>
			<span>THÁNG MƯỜI HAI 4TH, 2020</span>
			<p>Thông tin khóa học Scrum dành cho Sinh viên</p>
		</div>
		<div class="block-theme-1-right">
			<div class="img-theme-1-right">
				<img src="{{ asset('./public/Images/home/img1.jpg')}}">
				<div class="title-img-theme-1-right">
					<p>Sự kiện nổi bật</p>
				</div>
			</div>
			<span>THÁNG MƯỜI HAI 4TH, 2020</span>
			<p>Thông tin khóa học Scrum dành cho Sinh viênThông tin khóa học Scrum dành cho Sinh viên</p>
		</div>
		<div class="block-theme-1-right">
			<div class="img-theme-1-right">
				<img src="{{ asset('./public/Images/home/img1.jpg')}}">
				<div class="title-img-theme-1-right">
					<p>Sự kiện nổi bật</p>
				</div>
			</div>
			<span>THÁNG MƯỜI HAI 4TH, 2020</span>
			<p>Thông tin khóa học Scrum dành cho Sinh viên</p>
		</div>
		<div class="block-theme-1-right">
			<div class="img-theme-1-right">
				<img src="{{ asset('./public/Images/home/img1.jpg')}}">
				<div class="title-img-theme-1-right">
					<p>Sự kiện nổi bật</p>
				</div>
			</div>
			<span>THÁNG MƯỜI HAI 4TH, 2020</span>
			<p>Thông tin khóa học Scrum dành cho Sinh viên</p>
		</div>
		<div class="block-theme-1-right">
			<div class="img-theme-1-right">
				<img src="{{ asset('./public/Images/home/img1.jpg')}}">
				<div class="title-img-theme-1-right">
					<p>Sự kiện nổi bật</p>
				</div>
			</div>
			<span>THÁNG MƯỜI HAI 4TH, 2020</span>
			<p>Thông tin khóa học Scrum dành cho Sinh viên</p>
		</div>
		<div class="block-theme-1-right">
			<div class="img-theme-1-right">
				<img src="{{ asset('./public/Images/home/img1.jpg')}}">
				<div class="title-img-theme-1-right">
					<p>Sự kiện nổi bật</p>
				</div>
			</div>
			<span>THÁNG MƯỜI HAI 4TH, 2020</span>
			<p>Thông tin khóa học Scrum dành cho Sinh viên</p>
		</div>
		<div class="block-theme-1-right">
			<div class="img-theme-1-right">
				<img src="{{ asset('./public/Images/home/img1.jpg')}}">
				<div class="title-img-theme-1-right">
					<p>Sự kiện nổi bật</p>
				</div>
			</div>
			<span>THÁNG MƯỜI HAI 4TH, 2020</span>
			<p>Thông tin khóa học Scrum dành cho Sinh viên</p>
		</div>
		<div class="block-theme-1-right">
			<div class="img-theme-1-right">
				<img src="{{ asset('./public/Images/home/img1.jpg')}}">
				<div class="title-img-theme-1-right">
					<p>Sự kiện nổi bật</p>
				</div>
			</div>
			<span>THÁNG MƯỜI HAI 4TH, 2020</span>
			<p>Thông tin khóa học Scrum dành cho Sinh viên</p>
		</div>
		<div class="block-theme-1-right">
			<div class="img-theme-1-right">
				<img src="{{ asset('./public/Images/home/img1.jpg')}}">
				<div class="title-img-theme-1-right">
					<p>Sự kiện nổi bật</p>
				</div>
			</div>
			<span>THÁNG MƯỜI HAI 4TH, 2020</span>
			<p>Thông tin khóa học Scrum dành cho Sinh viên</p>
		</div>

		<div class="post-pagination">
			<span class="info">Page 1 of 64</span>
			<p><i class="fas fa-angle-left"></i></p>
			<p class="active-ppa">1</p>
			<p>2</p>
			<p><i class="fas fa-angle-right"></i></p>
		</div> -->

		<script type="text/javascript">
			$(document).ready(function() {
				$('.post-pagination p').live('click',function() {
					var getidt1 = this.id;
					getdatattheme1(getidt1);
				});
			});
		</script>

	</div>
</div>	

<div class="div-theme-1">
	<div class="div-theme">
		<div class="top-div-theme">
			<p>Thông tin thông báo</p>
		</div>
		<div class="bottom-div-theme">
			<div class="row-left">
				<a href="#"><img src="{{ asset('./public/Images/image1.jpg')}}"></a>
				<h3><a href="#">Những hãng xe làm khách hàng hài lòng nhất</a></h3>
				<p>Hãng xe điện Tesla đạt điểm số cao nhất bảng xếp hạng, trong khi hai vị trí cuối bảng thuộc về hai hãng mẹ con là Nissan và Infiniti.</p>
			</div>
			<div class="row-center">
				<div class="line-1">
					<a href="#"><img src="{{ asset('./public/Images/image1.jpg')}}"></a>
					<p><a href="#">Điện thoại khắc họa tiết trâu vàng giá 118 triệu đồng</a></p>
				</div>
				<div class="line-2">
					<a href="#"><img src="{{ asset('./public/Images/image1.jpg')}}"></a>
					<p><a href="#">Điện thoại khắc họa tiết trâu vàng giá 118 triệu đồng</a></p>
				</div>
			</div>
			<div class="row-right">
				<div class="line-right">
					<div class="line-title">
						<p><a href="#">iPhone 13 sẽ nâng cấp ống kính góc siêu rộng</a></p>
					</div>
					<div class="line-img">
						<img src="{{ asset('./public/Images/image1.jpg')}}">
					</div>
				</div>
				<div class="line-right">
					<div class="line-title">
						<p><a href="#">iPhone 13 sẽ nâng cấp ống kính góc siêu rộng</a></p>
					</div>
					<div class="line-img">
						<img src="{{ asset('./public/Images/image1.jpg')}}">
					</div>
				</div>
				<div class="line-right">
					<div class="line-title">
						<p><a href="#">iPhone 13 sẽ nâng cấp ống kính góc siêu rộng</a></p>
					</div>
					<div class="line-img">
						<img src="{{ asset('./public/Images/image1.jpg')}}">
					</div>
				</div>
				<div class="line-right">
					<div class="line-title">
						<p><a href="#">iPhone 13 sẽ nâng cấp ống kính góc siêu rộng</a></p>
					</div>
					<div class="line-img">
						<img src="{{ asset('./public/Images/image1.jpg')}}">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection