@extends('indexSub')
@section('contendBieumau')

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
			<table border="1px" class="table-bieumau">
				<thead>
					<tr>
						<th>Tên biểu mẫu</th>
						<th>Đơn vị</th>
						<th>Loại</th>
						<th>Mô tả tài nguyên</th>
						<th>Tải về</th>
					</tr>
				</thead>
				<tbody>
					@foreach($all_form as $value_form)
					<tr>
						<td><a href="{{URL::to('chi-tiet-bieu-mau/'.$value_form->id_form)}}">{{$value_form->ten_form}}</a></td>
						<td>{{$value_form->name_dvf}}</td>
						<td>{{$value_form->loai}}</td>
						<td>{{$value_form->mo_ta}}</td>
						<!-- <td>{{date('d/m/Y', strtotime($value_form->ngay_dang))}}</td> -->
						<td>{{$value_form->luot_tai}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<div class="main-bieu-mau-right">
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