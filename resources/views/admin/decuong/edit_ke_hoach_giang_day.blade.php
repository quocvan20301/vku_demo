@extends('admin_layout')
@section('admin_content') 

<div class="top-dang-bai-viet">
	<p>Sửa Đánh giá học phần </p>
</div>
 
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
							<td rowspan="2"><p class="left-bdg">W.<?php echo $stt; ?></p> <p>{{$value_dghp_parent->trongsothanhphan}} %</p></td>
							<td><p>{{$value_dghp_parent->cdr_hocphan}}</p></td>
						</tr>
						<?php $a = $stt; ?>
						<?php $stt++; ?>
					@else
						<tr>
							<td><p class="left-bdg">A.<?php echo $a; ?>.2</p> <p>{{$value_dghp_parent->ten_thanhphandanhgia}}</p></td>
							<td><p class="left-bdg">P.<?php echo $a; ?>.2</p> <p>{{$value_dghp_parent->phuongphapdanhgia}}</p></td>
							<td><p class="left-bdg">W.<?php echo $a; ?>.2 <p></p>{{$value_dghp_parent->trongsobaidanhgia}} %</p></td>
							<td><p>{{$value_dghp_parent->cdr_hocphan}}</p></td>
						</tr>
					@endif			
				@else
					<tr>
						<td><p class="left-bdg">A.<?php echo $stt; ?></p>  <p>{{$value_dghp_parent->ten_thanhphandanhgia_parent}}</p> </td>
						<td><p class="left-bdg">A.<?php echo $stt; ?>.1</p> <p>{{$value_dghp_parent->ten_thanhphandanhgia}}</p></td>
						<td><p class="left-bdg">P.<?php echo $stt; ?>.1</p> <p>{{$value_dghp_parent->phuongphapdanhgia}}</p></td>
						<td><p class="left-bdg">W.<?php echo $stt; ?>.1</p> <p>{{$value_dghp_parent->trongsobaidanhgia}} %</p></td>
						<td><p class="left-bdg">W.<?php echo $stt; ?></p> <p>{{$value_dghp_parent->trongsothanhphan}} %</p></td>
						<td><p>{{$value_dghp_parent->cdr_hocphan}}</p></td>
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
		<div class="table-khgd">
			<div class="line-khgd">
				<span class="tuan-buoi">Tuần/buổi</span>
				<span class="noi-dung">Nội dung chi tiết</span>
				<span class="hoat-dong-day-va-hoc">Hoạt động dạy và học</span>
				<span class="bai-danh-gia">Bài đánh giá</span>
				<span class="chuan-dau-ra">Chuẩn đầu ra học phần</span>
			</div>

			<div class="line-khgd">
				<div id="list-khgd">
					
					<?php $stt = 1 ?>
					@foreach($all_edit_khgd as $value_all_edit_khgd)
					<div class="line-khgd-center">
						<span class="tuan-buoi">
							<p class="stt-khgd">{{$stt}}</p>
						</span>
						<span class="noi-dung">
							<textarea name="ke_hoach_giang_day[]" required="true" rows="7" cols="58">{{$value_all_edit_khgd->noidung}}</textarea>
						</span>
						<span class="hoat-dong-day-va-hoc">
							<textarea name="ke_hoach_giang_day[]" required="true" rows="7" cols="36">{{$value_all_edit_khgd->hoatdongdayhoc}}</textarea>
						</span>
						<span class="bai-danh-gia">
							<textarea name="ke_hoach_giang_day[]" required="true" rows="7" cols="20">{{$value_all_edit_khgd->baidanhgia}}</textarea>
						</span>
						<span class="chuan-dau-ra">
							<textarea name="ke_hoach_giang_day[]" required="true" rows="7" cols="18">{{$value_all_edit_khgd->cdrhocphan}}</textarea>
						</span>
						<div class="delete-khgd" id="delete-ke-hoach-giang-day">
							<p>Xoá</p>
						</div>
					</div>
					<?php $stt++; ?>
					@endforeach

				</div>
				
				<div class="add-khgd" id="add-ke-hoach-giangday">
					<p>Thêm</p>
				</div>
			</div>
			
		</div>

		<h3>Kế hoạch giảng dạy và học cho phần thực hành</h3>
		<div class="table-khgd">
			<div class="line-khgd">
				<span class="tuan-buoi">Tuần/buổi</span>
				<span class="noi-dung">Nội dung chi tiết</span>
				<span class="hoat-dong-day-va-hoc">Hoạt động dạy và học</span>
				<span class="bai-danh-gia">Bài đánh giá</span>
				<span class="chuan-dau-ra">Chuẩn đầu ra học phần</span>
			</div>

			<div class="line-khgd">
				<div id="list-khgd-thuchanh">
					<?php $stt = 1 ?>
					@foreach($all_edit_khgd_thuchanh as $value_all_edit_khgd_thuchanh)
					<div class="line-khgd-center">
						<span class="tuan-buoi">
							<p class="stt-khgd">1</p>
						</span>
						<span class="noi-dung">
							<textarea name="ke_hoach_giang_day_thuchanh[]" required="true" rows="7" cols="58">{{$value_all_edit_khgd_thuchanh->noidung}}</textarea>
						</span>
						<span class="hoat-dong-day-va-hoc">
							<textarea name="ke_hoach_giang_day_thuchanh[]" required="true" rows="7" cols="36">{{$value_all_edit_khgd_thuchanh->hoatdongdayhoc}}</textarea>
						</span>
						<span class="bai-danh-gia">
							<textarea name="ke_hoach_giang_day_thuchanh[]" required="true" rows="7" cols="20">{{$value_all_edit_khgd_thuchanh->baidanhgia}}</textarea>
						</span>
						<span class="chuan-dau-ra">
							<textarea name="ke_hoach_giang_day_thuchanh[]" required="true" rows="7" cols="18">{{$value_all_edit_khgd_thuchanh->cdrhocphan}}</textarea>
						</span>
						<div class="delete-khgd" id="delete-ke-hoach-giang-day">
							<p>Xoá</p>
						</div>
					</div>
					<?php $stt++; ?>
					@endforeach
				</div>
				<div class="add-khgd" id="add-ke-hoach-giangday-thuchanh">
					<p>Thêm</p>
				</div>
			</div>

		</div>

		<div class="sm-khgd">
			<input type="submit" value="Sửa kế hoạch giảng dạy" class="submit-ke-hoach-giang-day">
		</div>

	</form>

</div>

<script>
	$('#add-ke-hoach-giangday').live('click', function() {
		
		var p = document.createElement("div");
		p.setAttribute("class", "line-khgd-center");

		var p1 = document.createElement("span");
		p1.setAttribute("class", "tuan-buoi");
		var node1 = document.createElement("p");
		node1.setAttribute("class", "stt-khgd");
		var node1_1 = document.createTextNode("1");
		node1.appendChild(node1_1);
		p1.appendChild(node1);

		var p2 = document.createElement("span");
		p2.setAttribute("class", "noi-dung");
		var node2 = document.createElement("textarea");
		node2.setAttribute("name", "ke_hoach_giang_day[]");
		node2.setAttribute('required',true);
		node2.rows = 7;
		node2.cols = 58;
		p2.appendChild(node2);

		var p3 = document.createElement("span");
		p3.setAttribute("class", "hoat-dong-day-va-hoc");
		var node3 = document.createElement("textarea");
		node3.setAttribute("name", "ke_hoach_giang_day[]");
		node3.setAttribute('required',true);
		node3.rows = 7;
		node3.cols = 36;
		p3.appendChild(node3);

		// var p4 = document.createElement("span");
		// p4.setAttribute("class", "bai-danh-gia");
		// var node4 = document.createElement("select");
		// node4.setAttribute("name", "bai_danh_gia[]");
		// node4.setAttribute('multiple',true);

		// @for($k = 0; $k < count($baidanhgia); $k ++)
		// var node4_1 = document.createElement("option");
		// var text_node_41 = <?php //echo json_encode($baidanhgia[$k]); ?>;
		// node4_1.text = text_node_41;
		// node4_1.setAttribute("value", text_node_41);
		// node4.appendChild(node4_1);
		// @endfor

		// p4.appendChild(node4);
		var p4 = document.createElement("span");
		p4.setAttribute("class", "bai-danh-gia");
		var node4 = document.createElement("textarea");
		node4.setAttribute("name", "ke_hoach_giang_day[]");
		node4.setAttribute('required',true);
		node4.rows = 7;
		node4.cols = 20;
		p4.appendChild(node4);

		var p5 = document.createElement("span");
		p5.setAttribute("class", "chuan-dau-ra");
		var node5 = document.createElement("textarea");
		node5.setAttribute("name", "ke_hoach_giang_day[]");
		node5.setAttribute('required',true);
		node5.rows = 7;
		node5.cols = 18.5;
		p5.appendChild(node5);

		var p6 = document.createElement("div");
		p6.setAttribute("class", "delete-khgd");
		p6.id = "delete-ke-hoach-giang-day";
		var node6 = document.createElement("p")
		var node6_1 = document.createTextNode("Xoá");
		node6.appendChild(node6_1);
		p6.appendChild(node6);

		p.appendChild(p1);
		p.appendChild(p2);
		p.appendChild(p3);
		p.appendChild(p4);
		p.appendChild(p5);
		p.appendChild(p6);

		var div = document.getElementById("list-khgd");
		div.appendChild(p);

		var x = document.getElementsByClassName('stt-khgd');
		for (var i = 0; i < x.length; i++) {
			x[i].innerHTML = i+1;
		}
	});

	$('#delete-ke-hoach-giang-day').live('click', function() {
		$(this).parent('div').remove();
		var x = document.getElementsByClassName('stt-khgd');
		for (var i = 0; i < x.length; i++) {
			x[i].innerHTML = i+1;
		}
	});

	$('#add-ke-hoach-giangday-thuchanh').live('click', function() {
		
		var p = document.createElement("div");
		p.setAttribute("class", "line-khgd-center");

		var p1 = document.createElement("span");
		p1.setAttribute("class", "tuan-buoi");
		var node1 = document.createElement("p");
		node1.setAttribute("class", "stt-khgd-thuchanh");
		var node1_1 = document.createTextNode("1");
		node1.appendChild(node1_1);
		p1.appendChild(node1);

		var p2 = document.createElement("span");
		p2.setAttribute("class", "noi-dung");
		var node2 = document.createElement("textarea");
		node2.setAttribute("name", "ke_hoach_giang_day_thuchanh[]");
		node2.setAttribute('required',true);
		node2.rows = 7;
		node2.cols = 58;
		p2.appendChild(node2);

		var p3 = document.createElement("span");
		p3.setAttribute("class", "hoat-dong-day-va-hoc");
		var node3 = document.createElement("textarea");
		node3.setAttribute("name", "ke_hoach_giang_day_thuchanh[]");
		node3.setAttribute('required',true);
		node3.rows = 7;
		node3.cols = 36;
		p3.appendChild(node3);

		var p4 = document.createElement("span");
		p4.setAttribute("class", "bai-danh-gia");
		var node4 = document.createElement("textarea");
		node4.setAttribute("name", "ke_hoach_giang_day_thuchanh[]");
		node4.setAttribute('required',true);
		node4.rows = 7;
		node4.cols = 20;
		p4.appendChild(node4);

		var p5 = document.createElement("span");
		p5.setAttribute("class", "chuan-dau-ra");
		var node5 = document.createElement("textarea");
		node5.setAttribute("name", "ke_hoach_giang_day_thuchanh[]");
		node5.setAttribute('required',true);
		node5.rows = 7;
		node5.cols = 18.5;
		p5.appendChild(node5);

		var p6 = document.createElement("div");
		p6.setAttribute("class", "delete-khgd");
		p6.id = "delete-ke-hoach-giang-day";
		var node6 = document.createElement("p")
		var node6_1 = document.createTextNode("Xoá");
		node6.appendChild(node6_1);
		p6.appendChild(node6);

		p.appendChild(p1);
		p.appendChild(p2);
		p.appendChild(p3);
		p.appendChild(p4);
		p.appendChild(p5);
		p.appendChild(p6);

		var div = document.getElementById("list-khgd-thuchanh");
		div.appendChild(p);

		var x = document.getElementsByClassName('stt-khgd-thuchanh');
		for (var i = 0; i < x.length; i++) {
			x[i].innerHTML = i+1;
		}
	});


</script>


@endsection