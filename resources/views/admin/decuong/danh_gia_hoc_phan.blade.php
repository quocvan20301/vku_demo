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
		<div class="table-dghp">
			<div class="line-dghp">
				<span class="thanh-phan-danh-gia">Thành phần ĐG</span>
				<div class="line-dghp-center">
					<div class="line-phuong-phap-danh-gia">
						<span class="bai-danh-gia">Bài đánh giá</span>
						<span class="line-ppdg-center">
							<span class="phuong-phap-danh-gia">Phương pháp đánh giá</span>
							<span class="trong-so-bai-danh-gia">Trọng số bài đánh giá(%)</span>
							<span class="cdr-hoc-phan">CĐR học phần</span>
						</span>
					</div>
				</div>
				<span class="trong-so-thanh-phan">Trọng số thành phần(%)</span>
			</div>

			@foreach($all_tpdg as $value_tpdg)
			<div class="line-dghp">
				<span class="thanh-phan-danh-gia">{{$value_tpdg->ten_thanhphandanhgia}}</span>
				<div class="line-dghp-center">
					@foreach($all_tpdg_child as $value_tpdg_child)
					@if($value_tpdg_child->id_baidanhgia == $value_tpdg->id)
					<div class="line-phuong-phap-danh-gia" id="list-danh-gia-hoc-phan-{{$value_tpdg_child->id}}" data-value="{{$value_tpdg->id}}">
						<span class="bai-danh-gia">{{$value_tpdg_child->ten_thanhphandanhgia}}</span>
						<!-- <span class="line-ppdg-center">
							<span class="phuong-phap-danh-gia">
								<textarea name="" id="" cols="20" rows="5"></textarea>
							</span>
							<span>
								<textarea name="" id="" cols="20" rows="5"></textarea>
							</span>
							<span>CLO 1, 2</span>
						</span> -->
					</div>
					<div class="action-line-dghp">
						<div id="add-line-ppdg-{{$value_tpdg_child->id}}">
							<p class="action" id="add-phuong-phap-danh-gia" data-value="{{$value_tpdg_child->id}}">Thêm</p>
						</div>
						<div id="delete-line-ppdg-{{$value_tpdg_child->id}}" style="display:none;">
							<p class="action" id="delete-phuong-phap-danh-gia" data-value="{{$value_tpdg_child->id}}">Xóa</p>
						</div>
					</div>
					@endif
					@endforeach
				</div>
				<span class="trong-so-thanh-phan">
					<textarea name="trong_so_thanh_phan[]" id="" cols="20" rows="3" required></textarea>
				</span>
			</div>
			@endforeach
		</div>

		<div class="sm-dghp">
			<input type="submit" value="Thêm đánh giá học phần" class="submit-danh-gia-hoc-phan">
		</div>
		

	</form>

</div>

<script>
	$('#add-phuong-phap-danh-gia').live('click', function() {

		var id_ppdg = $(this).attr('data-value');

		var dtpr = $("#list-danh-gia-hoc-phan-"+id_ppdg).attr('data-value');

		var ptpdg = document.createElement("input");
		ptpdg.setAttribute("type", "hidden");
		ptpdg.setAttribute("name", "bai_danh_gia[]");
		ptpdg.setAttribute("value", dtpr);

		var phidden = document.createElement("input");
		phidden.setAttribute("type", "hidden");
		phidden.setAttribute("name", "bai_danh_gia[]");
		phidden.setAttribute("value", id_ppdg);

		var p = document.createElement("span");
		p.setAttribute("class", "line-ppdg-center");
		p.id = "id-line-ppdg-center-"+id_ppdg;


		var p1 = document.createElement("span");
		p1.setAttribute("class", "phuong-phap-danh-gia");
		var node1 = document.createElement("textarea");
		node1.setAttribute("name", "bai_danh_gia[]");
		node1.setAttribute('required',true);
		node1.rows = 5;
		node1.cols = 20;
		p1.appendChild(node1);

		var p2 = document.createElement("span");
		var node2 = document.createElement("textarea");
		node2.setAttribute("name", "bai_danh_gia[]");
		node2.setAttribute('required',true);
		node2.rows = 5;
		node2.cols = 20;
		p2.appendChild(node2);

		var p3 = document.createElement("span");
		var node3 = document.createElement("textarea");
		node3.setAttribute("name", "bai_danh_gia[]");
		node3.setAttribute('required',true);
		node3.rows = 5;
		node3.cols = 20;
		p3.appendChild(node3);

		p.appendChild(phidden);
		p.appendChild(p1);
		p.appendChild(p2);
		p.appendChild(p3);
		p.appendChild(ptpdg);

		var div = document.getElementById("list-danh-gia-hoc-phan-"+id_ppdg);
		div.appendChild(p);

		document.getElementById("add-line-ppdg-"+id_ppdg).style.display = "none";
		document.getElementById("delete-line-ppdg-"+id_ppdg).style.display = "block";

	});

	$('#delete-phuong-phap-danh-gia').live('click', function() {

		var id_ppdg = $(this).attr('data-value');

		document.getElementById("id-line-ppdg-center-"+id_ppdg).remove();

		document.getElementById("add-line-ppdg-"+id_ppdg).style.display = "block";
		document.getElementById("delete-line-ppdg-"+id_ppdg).style.display = "none";

	});

</script>


@endsection