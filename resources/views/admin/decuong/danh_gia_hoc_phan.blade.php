@extends('admin_layout')
@section('admin_content') 

<div class="top-dang-bai-viet">
	<p>Thêm Đánh giá học phần</p>
</div>
 
<div class="danh-gia-hoc-phan">
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

	<form action="{{URL::to('danh-gia-hoc-phan/'.$id_decuong)}}" method="post">
	{{ csrf_field() }}
		<table border="1px" cellspacing="0" class="table-danh-gia-hoc-phan">
			<thead>
				<tr>
					<td>Thành phần ĐG</td>
					<td>Bài đánh giá</td>
					<td>Phương pháp đánh giá</td>
					<td>Trọng số bài đánh giá(%)</td>
					<td>CĐR học phần</td>
					<td>Action</td>
					<td>Trọng số thành phần(%)</td>
				</tr>
			</thead>
			<tbody>
				@foreach($all_tpdg_child as $value_tpdg)
				@if(isset($value_tpdg->has_child))
				<tr>
					<td class="align-middle" rowspan="2">{{$value_tpdg->parent}}</td>
					<td class="align-middle">{{$value_tpdg->ten_thanhphandanhgia}}</td>
					<td class="align-middle" id="p-p-d-g-{{$value_tpdg->id}}" data-value="{{$value_tpdg->id_baidanhgia}}"></td>
					<td class="align-middle" id="t-s-d-g-{{$value_tpdg->id}}"></td>
					<td class="align-middle" id="c-d-r-{{$value_tpdg->id}}"></td>
					<td>
						<div id="add-line-ppdg-{{$value_tpdg->id}}">
							<p class="action" id="add-phuong-phap-danh-gia" data-value="{{$value_tpdg->id}}">Thêm</p>
						</div>
						<div id="delete-line-ppdg-{{$value_tpdg->id}}" style="display:none;">
							<p class="action-delete" id="delete-phuong-phap-danh-gia" data-value="{{$value_tpdg->id}}">Xóa</p>
						</div>
					</td>
					<td class="align-middle" rowspan="2">
						<input type="number" name="trong_so_thanh_phan_{{$value_tpdg->id_baidanhgia}}" id="" ></input>
					</td>
				</tr>
				@elseif(isset($value_tpdg->child))
				<tr>
					<td class="align-middle">{{$value_tpdg->ten_thanhphandanhgia}}</td>
					<td class="align-middle" id="p-p-d-g-{{$value_tpdg->id}}" data-value="{{$value_tpdg->id_baidanhgia}}"></td>
					<td class="align-middle" id="t-s-d-g-{{$value_tpdg->id}}"></td>
					<td class="align-middle" id="c-d-r-{{$value_tpdg->id}}"></td>
					<td>
						<div id="add-line-ppdg-{{$value_tpdg->id}}">
							<p class="action" id="add-phuong-phap-danh-gia" data-value="{{$value_tpdg->id}}">Thêm</p>
						</div>
						<div id="delete-line-ppdg-{{$value_tpdg->id}}" style="display:none;">
							<p class="action-delete" id="delete-phuong-phap-danh-gia" data-value="{{$value_tpdg->id}}">Xóa</p>
						</div>
					</td>
				</tr>
				@else
				<tr>
					<td class="align-middle">{{$value_tpdg->parent}}</td>
					<td class="align-middle">{{$value_tpdg->ten_thanhphandanhgia}}</td>
					<td class="align-middle" id="p-p-d-g-{{$value_tpdg->id}}" data-value="{{$value_tpdg->id_baidanhgia}}"></td>
					<td class="align-middle" id="t-s-d-g-{{$value_tpdg->id}}"></td>
					<td class="align-middle" id="c-d-r-{{$value_tpdg->id}}"></td>
					<td>
						<div id="add-line-ppdg-{{$value_tpdg->id}}">
							<p class="action" id="add-phuong-phap-danh-gia" data-value="{{$value_tpdg->id}}">Thêm</p>
						</div>
						<div id="delete-line-ppdg-{{$value_tpdg->id}}" style="display:none;">
							<p class="action-delete" id="delete-phuong-phap-danh-gia" data-value="{{$value_tpdg->id}}">Xóa</p>
						</div>
					</td>
					<td class="align-middle">
						<input type="number" name="trong_so_thanh_phan_{{$value_tpdg->id_baidanhgia}}" id="" ></input>
					</td>
				</tr>
				@endif
				@endforeach
			</tbody>
		</table>

		<div class="sm-dghp">
			<input type="submit" value="Thêm đánh giá học phần" class="submit-danh-gia-hoc-phan">
		</div>

	</form>
 
</div>

<script>
	
	$('#add-phuong-phap-danh-gia').live('click', function() {

		var id_ppdg = $(this).attr('data-value');

		var node1 = document.createElement("textarea");
		node1.setAttribute("name", "bai_danh_gia[]");
		node1.setAttribute('required',true);
		node1.rows = 5;
		node1.cols = 30;
		var ppdg = document.getElementById("p-p-d-g-"+id_ppdg);
		ppdg.appendChild(node1);

		var node2 = document.createElement("input");
		node2.setAttribute("name", "bai_danh_gia[]");
		node2.setAttribute('required',true);
		node2.setAttribute("type", "number");
		var tsdg = document.getElementById("t-s-d-g-"+id_ppdg);
		tsdg.appendChild(node2);

		var cdr = document.getElementById("c-d-r-"+id_ppdg);
		var vl_clo = 1;
		@foreach($all_cdr as $value_all_cdr_op)
		var node3 = document.createElement("div");
		var node3_1 = document.createElement("input");
		node3_1.setAttribute("name", "chuan_dau_ra[]");
		node3_1.setAttribute("class", "checkbox-cdr");
		node3_1.setAttribute("type", "checkbox");
		node3_1.setAttribute("value", id_ppdg+"_"+vl_clo);
		var node3_2 = document.createTextNode("CLO "+(vl_clo++));
		node3.appendChild(node3_1);
		node3.appendChild(node3_2);
		cdr.appendChild(node3);
		@endforeach
		
		var dtpr = $("#p-p-d-g-"+id_ppdg).attr('data-value');

		var ptpdg = document.createElement("input");
		ptpdg.setAttribute("type", "hidden");
		ptpdg.setAttribute("name", "bai_danh_gia[]");
		ptpdg.setAttribute("value", dtpr);

		var phidden = document.createElement("input");
		phidden.setAttribute("type", "hidden");
		phidden.setAttribute("name", "bai_danh_gia[]");
		phidden.setAttribute("value", id_ppdg);

		cdr.appendChild(ptpdg);
		cdr.appendChild(phidden);

		document.getElementById("add-line-ppdg-"+id_ppdg).style.display = "none";
		document.getElementById("delete-line-ppdg-"+id_ppdg).style.display = "block";

	});

	$('#delete-phuong-phap-danh-gia').live('click', function() {

		var id_ppdg = $(this).attr('data-value');

		var remove_ppdg = document.getElementById("p-p-d-g-"+id_ppdg);
		remove_ppdg.innerHTML = '';
		var remove_tsdg = document.getElementById("t-s-d-g-"+id_ppdg);
		remove_tsdg.innerHTML = '';
		var remove_cdr = document.getElementById("c-d-r-"+id_ppdg);
		remove_cdr.innerHTML = '';

		document.getElementById("add-line-ppdg-"+id_ppdg).style.display = "block";
		document.getElementById("delete-line-ppdg-"+id_ppdg).style.display = "none";

	});

</script>


@endsection