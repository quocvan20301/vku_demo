@extends('admin_layout')
@section('admin_content') 

<div class="top-dang-bai-viet">
	<p>Chỉnh sửa mẫu lên</p>
</div>

<form action="{{URL::to('./edit-form/'.$all_edit_form->id_form)}}" enctype="multipart/form-data" method="post" data-parsley-validate>
	{{ csrf_field() }}
	<div class="bieu-mau">
		<table>
			<tr>
				<td class="c1">Tên:</td>
				<td class="c2"><input type="text" name="name_form" class="nameform" value="{{$all_edit_form->ten_form}}"></td>
			</tr>
			<tr>
				<td class="c1">Đơn vị:</td>
				<td class="c2">
					<select name="donvi_form">
						@foreach($all_donvi as $value_donvi)
						<option value="{{$value_donvi->id_dvf}}" <?php if ($all_edit_form->don_vi == $value_donvi->id_dvf) {echo "selected";} ?>>{{$value_donvi->name_dvf}}</option>
						@endforeach
					</select>
				</td>
			</tr>
			<tr>
				<td class="c1">Loại:</td>
				<td class="c2">
					<select name="loai_form">
						<option value="maudon" <?php if($all_edit_form->loai == "maudon") {echo "selected";} ?>>Mẫu đơn</option>
						<option value="baocao" <?php if($all_edit_form->loai == "baocao") {echo "selected";} ?>>Báo cáo</option>
						<option value="bieumau" <?php if($all_edit_form->loai == "bieumau") {echo "selected";} ?>>Biểu mẫu</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="c1">Mô tả tài nguyên:</td>
				<td class="c2"><textarea name="mota_form" class="motaform">{{$all_edit_form->mo_ta}}</textarea></td>
			</tr>
			<tr>
				<td class="c1">File:</td>
				<td class="c2">
					<input type="file" name="file_form">
					<span>{{$all_edit_form->duong_dan}}</span>
				</td>
			</tr>
			<tr>
				<td><input type="submit" name="submit" value="Sửa biểu mẫu" id="bieumau_sm"></td>
			</tr>
		</table>
	</div>
</form>


@endsection