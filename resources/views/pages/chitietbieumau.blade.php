@extends('indexSub')
@section('contendChitietbieumau')
<div class="main-bieu-mau">
	<div class="top-main-bieu-mau">
		<div class="title-tmbm">
			<ul>
				<li><p>Trang chủ</p></li>
				<li><i class="fas fa-chevron-right"></i></li>
				<li><p>Văn bản - biểu mẫu</p></li>
			</ul>
		</div>
	</div>
	<div class="main-bieu-mau-left">
		<div class="title-mbml">
			<div class="content-tmbml">
				<h3>Kho lưu trữ - tài nguyên</h3>
			</div>
		</div>
		<div class="bieu-mau">
			<ul>
				<li>
					<p class="name-bm">Tên tài nguyên:</p>
					<p>{{$all_form->ten_form}}</p>
				</li>
				<li>
					<p class="name-bm">Đơn vị:</p>
					<p>{{$all_form->name_dvf}}</p>
				</li>
				<li>
					<p class="name-bm">Loại:</p>
					<p>{{$all_form->loai}}</p>
				</li>
				<li>
					<p class="name-bm">Số lần tải về:</p>
					<p>{{$all_form->luot_tai}}</p>
				</li>
				<li>
					<p class="name-bm">Tải về:</p>
					<a href="{{URL::to('download/'.$all_form->duong_dan.'/'.$all_form->id_form)}}"><p><i class="fas fa-cloud-download-alt"></i></p></a>
				</li>
				<li>
					<p class="name-bm">Miêu tả:</p>
					<p>{{$all_form->mo_ta}}</p>
				</li>
			</ul>
		</div>
	</div>
	<div class="main-bieu-mau-right">
		2
	</div>
</div>
@endsection