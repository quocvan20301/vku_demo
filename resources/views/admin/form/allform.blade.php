@extends('admin_layout')
@section('admin_content') 

<div class="top-dang-bai-viet">
	<p>Danh sách mẫu lên</p>
</div> 

<div class="all-post">
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<td>ID</td>
				<td>Tên biểu mẫu</td>
				<td>Đơn vị</td>
				<td>Loại</td>
				<td>Mô tả</td>
				<td colspan="2">Tác vụ</td>
			</tr>
		</thead>
		<tbody>
			@foreach($all_form as $value_form)
			<tr>
				<td>{{$value_form->id_form}}</td>
				<td>{{$value_form->ten_form}}</td>
				<td>{{$value_form->name_dvf}}</td>
				<td>{{$value_form->loai}}</td>
				<td>{{$value_form->mo_ta}}</td>
				<td><a href="{{URL::to('edit-form/'.$value_form->id_form)}}"><i class="fas fa-edit" style="color: #28a745;"></i></a></td>
				<td><a href="{{URL::to('delete-form/'.$value_form->id_form)}}"><i class="fas fa-trash-alt" style="color: #dc3545;"></i></a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

@endsection