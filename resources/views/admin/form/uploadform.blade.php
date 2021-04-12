@extends('admin_layout')
@section('admin_content') 

<div class="top-dang-bai-viet">
	<p>Tải biểu mẫu lên</p>
</div>

<form action="{{URL::to('./upload-form')}}" enctype="multipart/form-data" method="post" data-parsley-validate>
	{{ csrf_field() }}
	<div class="bieu-mau">
		<table>
			<tr>
				<td class="c1">Tên:</td>
				<td class="c2"><input type="text" name="name_form" class="nameform"></td>
			</tr>
			<tr>
				<td class="c1">Đơn vị:</td>
				<td class="c2">
					<select name="donvi_form">
						@foreach($all_donvi as $value_donvi)
						<option value="{{$value_donvi->id_dvf}}">{{$value_donvi->name_dvf}}</option>
						@endforeach
					</select>
				</td>
			</tr>
			<tr>
				<td class="c1">Loại:</td>
				<td class="c2">
					<select name="loai_form">
						<option value="maudon">Mẫu đơn</option>
						<option value="baocao">Báo cáo</option>
						<option value="bieumau">Biểu mẫu</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="c1">Mô tả tài nguyên:</td>
				<td class="c2"><textarea name="mota_form" class="motaform"></textarea></td>
			</tr>
			<tr>
				<td class="c1">File:</td>
				<td class="c2"><input type="file" name="file_form"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="submit" value="Đăng biểu mẫu" id="bieumau_sm"></td>
			</tr>
		</table>
	</div>
</form>


@endsection