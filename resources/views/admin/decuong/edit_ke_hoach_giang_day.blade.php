@extends('admin_layout')
@section('admin_content') 

<div class="top-dang-bai-viet">
	<p>Sửa Đánh giá học phần </p>
</div>

<?php $temp = 0; $temp_thuchanh = 0; ?>
 
<div class="ke-hoach-giang-day">
    <table border="1px" cellspacing="0" class="last-cdr">
        <thead>
            <tr>
                <td>STT</td>
                <td>Chuẩn đầu ra học phần (CLO)</td>
            </tr>
        </thead>
        <tbody>
			<?php $stt=1; ?>
			@foreach($all_cdr as $value_cdr)
			<tr>
				<td class="row-stt"><?php echo $stt; ?></td>
				<td class="row-cdr">{{$value_cdr->noi_dung}}</td>
			</tr>
			<?php $stt++; ?>
			@endforeach
		</tbody>
    </table>

	<table border="1px" cellspacing="0" class="tb-danh-gia-hoc-phan">
		<thead>
			<tr>
				<td>Thành phần đánh giá</td>
				<td>Bài đánh giá</td>
				<td>Phương pháp đánh giá</td>
				<td>Trọng số bài đánh giá (%)</td>
				<td>Trọng số thành phần (%)</td>
				<td>CĐR học phần</td>
			</tr>
		</thead>
		<tbody>
		<?php $stt = 1; ?>
			@foreach($all_dghp as $value_dghp_parent)
				@if(isset($value_dghp_parent->Level))
					@if($value_dghp_parent->Level == 0)
						<tr>
							<td rowspan="2"><p class="left-bdg">A.<?php echo $stt; ?></p> <p>{{$value_dghp_parent->ten_thanhphandanhgia_parent}}</p></td>
							<td><p class="left-bdg">A.<?php echo $stt; ?>.1</p> <p>{{$value_dghp_parent->ten_thanhphandanhgia}}</p></td>
							<td><p class="left-bdg">P.<?php echo $stt; ?>.1</p> <p>{{$value_dghp_parent->phuongphapdanhgia}}</p></td>
							<td><p class="left-bdg">W.<?php echo $stt; ?>.1</p> <p>{{$value_dghp_parent->trongsobaidanhgia}} %</p></td>
							<td rowspan="2">
								<p class="left-bdg">W.<?php echo $stt; ?></p> 
								<p> 
								@foreach($all_trongso as $value_trongso)
									@if($value_trongso->id_trongso == $value_dghp_parent->id_baidanhgia)
										{{$value_trongso->trongso*100}}
									@endif
								@endforeach
								%
								</p>
							</td>
							<td>
								<p>
									@foreach($value_dghp_parent->cdr_hocphan as $value_list_cdr)
										@if (next($value_dghp_parent->cdr_hocphan)==true)
										CLO {{$value_list_cdr}},
										@else
										CLO {{$value_list_cdr}}
										@endif
									@endforeach
								</p>
							</td>
						</tr>
						<?php $a = $stt; ?>
						<?php $stt++; ?>
					@else
						<tr>
							<td><p class="left-bdg">A.<?php echo $a; ?>.2</p> <p>{{$value_dghp_parent->ten_thanhphandanhgia}}</p></td>
							<td><p class="left-bdg">P.<?php echo $a; ?>.2</p> <p>{{$value_dghp_parent->phuongphapdanhgia}}</p></td>
							<td><p class="left-bdg">W.<?php echo $a; ?>.2 <p></p>{{$value_dghp_parent->trongsobaidanhgia}} %</p></td>
							<td>
								<p>
									@foreach($value_dghp_parent->cdr_hocphan as $value_list_cdr)
										@if (next($value_dghp_parent->cdr_hocphan)==true)
										CLO {{$value_list_cdr}},
										@else
										CLO {{$value_list_cdr}}
										@endif
									@endforeach
								</p>
							</td>
						</tr>
					@endif			
				@else
					<tr>
						<td><p class="left-bdg">A.<?php echo $stt; ?></p>  <p>{{$value_dghp_parent->ten_thanhphandanhgia_parent}}</p> </td>
						<td><p class="left-bdg">A.<?php echo $stt; ?>.1</p> <p>{{$value_dghp_parent->ten_thanhphandanhgia}}</p></td>
						<td><p class="left-bdg">P.<?php echo $stt; ?>.1</p> <p>{{$value_dghp_parent->phuongphapdanhgia}}</p></td>
						<td><p class="left-bdg">W.<?php echo $stt; ?>.1</p> <p>{{$value_dghp_parent->trongsobaidanhgia}} %</p></td>
						<td>
							<p class="left-bdg">W.<?php echo $stt; ?></p> 
							<p> 
							@foreach($all_trongso as $value_trongso)
								@if($value_trongso->id_trongso == $value_dghp_parent->id_baidanhgia)
									{{$value_trongso->trongso*100}}
								@endif
							@endforeach
							%
							</p>
						</td>
						<td>
							<p>
								@foreach($value_dghp_parent->cdr_hocphan as $value_list_cdr)
									@if (next($value_dghp_parent->cdr_hocphan)==true)
									CLO {{$value_list_cdr}},
									@else
									CLO {{$value_list_cdr}}
									@endif
								@endforeach
							</p>
						</td>
					</tr>
					<?php $stt++; ?>
				@endif
			@endforeach
		</tbody>
	</table>

	<form action="{{URL::to('edit-ke-hoach-giang-day/'.$id_decuong)}}" method="post">
		{{ csrf_field() }}
		<div class="namhoc">
			<p>Chọn năm học:</p>
			<select multiple required name="namhoc" id="">
				<option value="1" <?php if($namhoc == 1) echo "selected"; ?> >Năm 1</option>
				<option value="2" <?php if($namhoc == 2) echo "selected"; ?> >Năm 2</option>
				<option value="3" <?php if($namhoc == 3) echo "selected"; ?> >Năm 3</option>
				<option value="4" <?php if($namhoc == 4) echo "selected"; ?> >Năm 4</option>
			</select>
		</div>

		<div class="hocky">
			<p>Chọn học kỳ:</p>
			<select multiple required name="hocky" id="">
				<option value="1" <?php if($hocky == 1) echo "selected"; ?> >Học kỳ I</option>
				<option value="2" <?php if($hocky == 2) echo "selected"; ?> >Học kỳ II</option>
			</select>
		</div>

		<h3>Kế hoạch giảng dạy và học cho phần lý thuyết</h3>

		<table border="1px" cellspacing="0" class="table-ke-hoach-giang-day" style="width: 100%;">
			<thead>
				<tr>
					<td class="align-middle">Tuần/buổi</td>
					<td class="align-middle">Nội dung chi tiết</td>
					<td class="align-middle">Hoạt động dạy và học</td>
					<td class="align-middle">Bài đánh giá</td>
					<td class="align-middle">CĐR học phần</td>
					<td class="align-middle">Action</td>
				</tr>
			</thead>
			<tbody id="list-khgd">
				<?php $stt = 1 ?>
				@foreach($all_edit_khgd as $value_all_edit_khgd)
				<?php $temp++; ?>
				<tr>
					<td class="stt-khgd">
						{{$stt}}
					</td>
					<td>
						<textarea name="ke_hoach_giang_day[]" required="true" rows="7" cols="56">{{$value_all_edit_khgd->noidung}}</textarea>
					</td>
					<td>
						<textarea name="ke_hoach_giang_day[]" required="true" rows="7" cols="50">{{$value_all_edit_khgd->hoatdongdayhoc}}</textarea>
					</td>
					<input type="hidden" value="{{$temp}}" name="ke_hoach_giang_day[]">
					<td>
						@foreach($baidanhgia as $value_bdg)
							<?php $check = 0; ?>
							@foreach($value_all_edit_khgd->baidanhgia as $value_baidanhgia)
								@if($value_bdg == $value_baidanhgia)
								<div class="">
									<input type="checkbox" checked value="{{$temp}}_{{$value_bdg}}" name="bai_danh_gia[]" id="">{{$value_bdg}}
								</div>
								<?php $check = 1; ?>
								@endif
							@endforeach

							@if($check == 0)
							<div class="">
								<input type="checkbox" value="{{$temp}}_{{$value_bdg}}" name="bai_danh_gia[]" id="">{{$value_bdg}}
							</div>
							@endif
						@endforeach
					</td>
					<td>
						<?php $stt_cdr = 1; ?>
						@foreach($all_cdr as $value_cdr_cb)
							<?php $check = 0; ?>
							@foreach($value_all_edit_khgd->cdrhocphan as $value_chuandaura_ip)
								@if($stt_cdr == $value_chuandaura_ip)
								<div class="">
									<input type="checkbox" checked value="{{$temp}}_{{$stt_cdr}}" name="chuan_dau_ra[]" id="">CLO {{$stt_cdr}}
								</div>
								<?php $check = 1; ?>
								@endif
							@endforeach

							@if($check == 0)
							<div class="">
								<input type="checkbox"value="{{$temp}}_{{$stt_cdr}}" name="chuan_dau_ra[]" id="">CLO {{$stt_cdr}}
							</div>
							@endif
							<?php $stt_cdr++; ?>
						@endforeach
					</td>
					<td id="delete-ke-hoach-giang-day">
						<p>Xóa</p>
					</td>
				</tr>
				<?php $stt++; ?>
				@endforeach
			</tbody>
			<tr>
				<td class="align-middle" colspan="6" id="add-ke-hoach-giangday">
					<p>Thêm</p>
				</td>
			</tr>
		</table>


		<h3>Kế hoạch giảng dạy và học cho phần thực hành</h3>

		<table border="1px" cellspacing="0" class="table-ke-hoach-giang-day" style="width: 100%;">
			<thead>
				<tr>
					<td class="align-middle">Tuần/buổi</td>
					<td class="align-middle">Nội dung chi tiết</td>
					<td class="align-middle">Hoạt động dạy và học</td>
					<td class="align-middle">Bài đánh giá</td>
					<td class="align-middle">CĐR học phần</td>
					<td class="align-middle">Action</td>
				</tr>
			</thead>
			<tbody id="list-khgd-thuchanh">
				<?php $stt_th = 1; ?>
				@foreach($all_edit_khgd_thuchanh as $value_all_edit_khgd_thuchanh)
				<?php $temp_thuchanh++; ?>
				<tr>
					<td class="stt-khgd-thuchanh">{{$stt_th}}</td>
					<td>
						<textarea name="ke_hoach_giang_day_thuchanh[]" required="true" rows="7" cols="56">{{$value_all_edit_khgd_thuchanh->noidung}}</textarea>
					</td>
					<td>
						<textarea name="ke_hoach_giang_day_thuchanh[]" required="true" rows="7" cols="50">{{$value_all_edit_khgd_thuchanh->hoatdongdayhoc}}</textarea>	
					</td>
					<input type="hidden" value="{{$temp_thuchanh}}" name="ke_hoach_giang_day_thuchanh[]">
					<td>
						@foreach($baidanhgia as $value_bdg_thuchanh)
							<?php $check = 0; ?>
							@foreach($value_all_edit_khgd_thuchanh->baidanhgia as $value_baidanhgia_thuchanh)
								@if($value_bdg_thuchanh == $value_baidanhgia_thuchanh)
								<div class="">
									<input type="checkbox" checked value="{{$temp_thuchanh}}_{{$value_bdg_thuchanh}}" name="bai_danh_gia_thuchanh[]" id="">{{$value_bdg_thuchanh}}
								</div>
								<?php $check = 1; ?>
								@endif
							@endforeach

							@if($check == 0)
							<div class="">
								<input type="checkbox" value="{{$temp_thuchanh}}_{{$value_bdg_thuchanh}}" name="bai_danh_gia_thuchanh[]" id="">{{$value_bdg_thuchanh}}
							</div>
							@endif
						@endforeach
					</td>
					<td>
						<?php $stt_cdr = 1; ?>
						@foreach($all_cdr as $value_cdr_cb_thuchanh)
							<?php $check = 0; ?>
							@foreach($value_all_edit_khgd_thuchanh->cdrhocphan as $value_chuandaura_ip_thuchanh)
								@if($stt_cdr == $value_chuandaura_ip_thuchanh)
								<div class="">
									<input type="checkbox" checked value="{{$temp_thuchanh}}_{{$stt_cdr}}" name="chuan_dau_ra_thuchanh[]" id="">CLO {{$stt_cdr}}
								</div>
								<?php $check = 1; ?>
								@endif
							@endforeach

							@if($check == 0)
							<div class="">
								<input type="checkbox"value="{{$temp_thuchanh}}_{{$stt_cdr}}" name="chuan_dau_ra_thuchanh[]" id="">CLO {{$stt_cdr}}
							</div>
							@endif
							<?php $stt_cdr++; ?>
						@endforeach 
					</td>
					<td id="delete-ke-hoach-giang-day">
						<p>Xóa</p>
					</td>
				</tr>
				<?php $stt_th++; ?>
				@endforeach
			</tbody>
			<tr>
				<td class="align-middle" colspan="6" id="add-ke-hoach-giangday-thuchanh">
					<p>Thêm</p>
				</td>
			</tr>
		</table>

		<div class="sm-khgd">
			<input type="submit" value="Sửa kế hoạch giảng dạy" class="submit-ke-hoach-giang-day">
		</div>

	</form>

</div>

<script>

	var temp = <?php echo json_encode($temp); ?>;
	var temp_thuchanh = <?php echo json_encode($temp_thuchanh); ?>;

	$('#add-ke-hoach-giangday').live('click', function() {
		
		temp++;
		var temp_ip = document.createElement("input");
		temp_ip.setAttribute("type", "hidden");
		temp_ip.setAttribute("name", "ke_hoach_giang_day[]");
		temp_ip.setAttribute("value", temp);

		var p = document.createElement("tr");

		var p1 = document.createElement("td");
		p1.setAttribute("class", "stt-khgd");
		var node1 = document.createTextNode("1");
		p1.appendChild(node1);
		
		var p2 = document.createElement("td");
		var node2 = document.createElement("textarea");
		node2.setAttribute("name", "ke_hoach_giang_day[]");
		node2.setAttribute('required',true);
		node2.rows = 7;
		node2.cols = 56;
		p2.appendChild(node2);

		var p3 = document.createElement("td");
		var node3 = document.createElement("textarea");
		node3.setAttribute("name", "ke_hoach_giang_day[]");
		node3.setAttribute('required',true);
		node3.rows = 7;
		node3.cols = 50;
		p3.appendChild(node3);

		var p4 = document.createElement("td");
		@foreach($baidanhgia as $value_all_bdg_op)
		var node4 = document.createElement("div");
		var node4_1 = document.createElement("input");
		node4_1.setAttribute("name", "bai_danh_gia[]");
		node4_1.setAttribute("type", "checkbox");
		node4_1.setAttribute("value", temp+"_"+"{{$value_all_bdg_op}}");
		var node4_2 = document.createTextNode("{{$value_all_bdg_op}}");
		node4.appendChild(node4_1);
		node4.appendChild(node4_2);
		p4.appendChild(node4);
		@endforeach

		var p5 = document.createElement("td");
		var vl_clo = 1;
		@foreach($all_cdr as $value_all_cdr_op)
		var node5 = document.createElement("div");
		var node5_1 = document.createElement("input");
		node5_1.setAttribute("name", "chuan_dau_ra[]");
		node5_1.setAttribute("type", "checkbox");
		node5_1.setAttribute("value", temp+"_"+vl_clo);
		var node5_2 = document.createTextNode("CLO "+(vl_clo++));
		node5.appendChild(node5_1);
		node5.appendChild(node5_2);
		p5.appendChild(node5);
		@endforeach

		var p6 = document.createElement("td");
		p6.id = "delete-ke-hoach-giang-day";
		var node6 = document.createElement("p");
		var node6_1 = document.createTextNode("Xóa");
		node6.appendChild(node6_1);
		p6.appendChild(node6);

		p.appendChild(p1);
		p.appendChild(p2);
		p.appendChild(p3);
		p.appendChild(p4);
		p.appendChild(p5);
		p.appendChild(p6);
		p.appendChild(temp_ip);

		var div = document.getElementById("list-khgd");
		div.appendChild(p);

		var x = document.getElementsByClassName('stt-khgd');
		for (var i = 0; i < x.length; i++) {
			x[i].innerHTML = i+1;
		}
	});

	$('#delete-ke-hoach-giang-day').live('click', function() {
		$(this).parent('tr').remove();
		var x = document.getElementsByClassName('stt-khgd');
		for (var i = 0; i < x.length; i++) {
			x[i].innerHTML = i+1;
		}
		var y = document.getElementsByClassName('stt-khgd-thuchanh');
		for (var i = 0; i < x.length; i++) {
			y[i].innerHTML = i+1;
		}
	});

	$('#add-ke-hoach-giangday-thuchanh').live('click', function() {

		temp_thuchanh++;
		var temp_ip_thuchanh = document.createElement("input");
		temp_ip_thuchanh.setAttribute("type", "hidden");
		temp_ip_thuchanh.setAttribute("name", "ke_hoach_giang_day_thuchanh[]");
		temp_ip_thuchanh.setAttribute("value", temp_thuchanh);

		var p = document.createElement("tr");

		var p1 = document.createElement("td");
		p1.setAttribute("class", "stt-khgd-thuchanh");
		var node1 = document.createTextNode("1");
		p1.appendChild(node1);
		
		var p2 = document.createElement("td");
		var node2 = document.createElement("textarea");
		node2.setAttribute("name", "ke_hoach_giang_day_thuchanh[]");
		node2.setAttribute('required',true);
		node2.rows = 7;
		node2.cols = 56;
		p2.appendChild(node2);

		var p3 = document.createElement("td");
		var node3 = document.createElement("textarea");
		node3.setAttribute("name", "ke_hoach_giang_day_thuchanh[]");
		node3.setAttribute('required',true);
		node3.rows = 7;
		node3.cols = 50;
		p3.appendChild(node3);

		var p4 = document.createElement("td");
		@foreach($baidanhgia as $value_all_bdg_op)
		var node4 = document.createElement("div");
		var node4_1 = document.createElement("input");
		node4_1.setAttribute("name", "bai_danh_gia_thuchanh[]");
		node4_1.setAttribute("type", "checkbox");
		node4_1.setAttribute("value", temp_thuchanh+"_"+"{{$value_all_bdg_op}}");
		var node4_2 = document.createTextNode("{{$value_all_bdg_op}}");
		node4.appendChild(node4_1);
		node4.appendChild(node4_2);
		p4.appendChild(node4);
		@endforeach

		var p5 = document.createElement("td");
		var vl_clo = 1;
		@foreach($all_cdr as $value_all_cdr_op)
		var node5 = document.createElement("div");
		var node5_1 = document.createElement("input");
		node5_1.setAttribute("name", "chuan_dau_ra_thuchanh[]");
		node5_1.setAttribute("type", "checkbox");
		node5_1.setAttribute("value", temp_thuchanh+"_"+vl_clo);
		var node5_2 = document.createTextNode("CLO "+(vl_clo++));
		node5.appendChild(node5_1);
		node5.appendChild(node5_2);
		p5.appendChild(node5);
		@endforeach

		var p6 = document.createElement("td");
		p6.id = "delete-ke-hoach-giang-day";
		var node6 = document.createElement("p");
		var node6_1 = document.createTextNode("Xóa");
		node6.appendChild(node6_1);
		p6.appendChild(node6);

		p.appendChild(p1);
		p.appendChild(p2);
		p.appendChild(p3);
		p.appendChild(p4);
		p.appendChild(p5);
		p.appendChild(p6);
		p.appendChild(temp_ip_thuchanh);

		var div = document.getElementById("list-khgd-thuchanh");
		div.appendChild(p);

		var x = document.getElementsByClassName('stt-khgd-thuchanh');
		for (var i = 0; i < x.length; i++) {
			x[i].innerHTML = i+1;
		}
	});


</script>


@endsection