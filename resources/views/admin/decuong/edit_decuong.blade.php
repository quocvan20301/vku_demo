@extends('admin_layout')
@section('admin_content') 

<div class="top-dang-bai-viet">
	<p>Edit đề cương</p>
</div>

<div class="de-cuong">
	<form action="{{URL::to('sua-de-cuong/'.$all_decuong->id_decuong)}}" method="post">
		{{ csrf_field() }}
		<table>
			<tr>
				<td class="c1">
					<p class="ten-hoc-phan">1. Tên học phần</p>
				</td>
				<td>
					<div class="tlhp">
						<input type="text" name="ten_hoc_phan" id="ip-ten-hoc-phan" placeholder="Nhập tên học phần" required="" value="{{$all_decuong->tenhocphan}}">
						<input type="hidden" name="id_ten_hoc_phan" id="id-ten-hoc-phan" value="{{$all_decuong->id_hocphan}}">
						<div id="tenhocphanaj">

						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td  class="c1">
					<p class="">2. Số tiết lý thuyết</p>
				</td>
				<td>
					<input type="number" name="so_tiet_ly_thuyet" id="ip-so-tiet-lt" placeholder="Số tiết lí thuyết" required="" class="ip2row" value="{{$all_decuong->phanbo_lythuyet}}">
					<p class="row2r">3. Số tiết bài tập</p>
					<input type="number" name="so_tiet_bai_tap" class="ip2row" placeholder="Số tiết bài tập" required="" value="{{$all_decuong->phanbo_baitap}}">

				</td>
			</tr>
			<tr>
				<td  class="c1">
					<p class="">4. Số tiết thực hành</p>
				</td>
				<td>
					<input type="number" name="so_tiet_thuc_hanh" class="ip2row" placeholder="Số tiết thực hành" required="" value="{{$all_decuong->phanbo_thuchanh}}">
					<p class="row2r stth">5. Số tiết tự học</p>
					<input type="number" name="so_tiet_tu_hoc" class="ip2row" placeholder="Số tiết tự học" required="" value="{{$all_decuong->phanbo_tuhoc}}">
				</td>
			</tr>
			<tr>
				<td  class="c1">
					<p class="">6. Giảng viên phụ trách</p>
				</td>
				<td>
					<div class="gvpt">
						<input type="text" name="giang_vien_phu_trach" id="giang-vien-phu-trach" placeholder="Nhập tên Giảng viên phụ trách" required="" value="{{$all_decuong->hodem}} {{$all_decuong->ten}}">
						<input type="hidden" name="id_giang_vien_phu_trach" id="id-giang-vien-phu-trach" value="{{$all_decuong->giangvienphutrach_id}}">
						<div id="giangvienphutrachaj">

						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td  class="c1">7. Giảng viên dạy cùng</td>
				<td class="c2-dsgvdc">
					<div class="gvdc">
						<input type="text" name="giang_vien_day_cung" id="giang-vien-day-cung" placeholder="Nhập tên Giảng viên dạy cùng">
						<div id="giangviendaycungaj">

						</div>
					</div>
					<div class="dsgvdc">
						<h4>Danh sách các giảng viên cùng giảng dạy: </h4>
						<ul id="list-gvdc">
							@foreach($list_gvdc as $val_gvdc)
							<li>
								<p>{{$val_gvdc["ten_gv"]}}</p>
								<p id="delete-gvdc">Xoá</p>
								<input type="hidden" name="list_id_gvdc[]" value="{{$val_gvdc["id_gv"]}}">
							</li>
							@endforeach
						</ul>
					</div>
				</td>
			</tr>
			<tr>
				<td  class="c1">9. Khoa phụ trách</td>
				<td>
					<select multiple name="khoa_phu_trach" class="khoa-phu-trach">
						<option value="1" <?php if($all_decuong->khoaphutrach == 1) echo "selected"; ?> >Khoa học máy tính</option>
						<option value="2" <?php if($all_decuong->khoaphutrach == 2) echo "selected"; ?> >Khoa kỹ thuật máy tính & điện tử</option>
						<option value="3" <?php if($all_decuong->khoaphutrach == 3) echo "selected"; ?> >Khoa kinh tế số & thương mại điện tử</option>
					</select>
				</td>
			</tr>
			<tr>
				<td  class="c1">10. Loại học phần</td>
				<td>
					<select multiple name="loai_hoc_phan" class="loai-hoc-phan">
						<option value="1" <?php if($all_decuong->loaihocphan == 1) echo "selected"; ?> >Bắt buộc</option>
						<option value="2" <?php if($all_decuong->loaihocphan == 2) echo "selected"; ?> >Tự chọn bắt buộc</option>
						<option value="3" <?php if($all_decuong->loaihocphan == 3) echo "selected"; ?> >Tự chọn tự do</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="c1">11. Thuộc khối kiến thức</td>
				<td>
					<select multiple name="khoi_kien_thuc" class="khoi-kien-thuc">
						<option value="1" <?php if($all_decuong->khoikienthuc == 1) echo "selected"; ?> >Toán và Khoa học tự nhiên</option>
						<option value="2" <?php if($all_decuong->khoikienthuc == 2) echo "selected"; ?> >Kiến thức chung</option>
						<option value="3" <?php if($all_decuong->khoikienthuc == 3) echo "selected"; ?> >Kiến thức cơ sở ngành</option>
						<option value="4" <?php if($all_decuong->khoikienthuc == 4) echo "selected"; ?> >Kiến thức chuyên ngành</option>
						<option value="5" <?php if($all_decuong->khoikienthuc == 5) echo "selected"; ?> >Thực tập</option>
						<option value="6" <?php if($all_decuong->khoikienthuc == 6) echo "selected"; ?> >Đồ án tốt nghiệp</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="c1">12. Mô tả tóm tắt học phần</td>
				<td>
					<textarea name="mota_tomtat" required="" placeholder="Mô tả tóm tắt học phần">{{$all_decuong->mota_tomtat}}</textarea>
				</td>
			</tr>
			<tr>
				<td class="c1">13. Mục tiêu kiến thức của học phần</td>
				<td>
					<textarea name="muctieu_kienthuc" required="" placeholder="Mục tiêu kiến thức của học phần">{{$all_decuong->muctieu_kienthuc}}</textarea>
				</td>
			</tr>
			<tr>
				<td class="c1">14. Mục tiêu kỹ năng của học phần</td>
				<td>
					<textarea name="muctiey_kynang" required="" placeholder="Mục tiêu kỹ năng của học phần">{{$all_decuong->muctieu_kynang}}</textarea>
				</td>
			</tr>
			<tr>
				<td class="c1">15. Mục tiêu thái độ của học phần</td>
				<td>
					<textarea name="muctieu_thaido" required="" placeholder="Mục tiêu thái độ của học phần">{{$all_decuong->muctieu_thaido}}</textarea>
				</td>
			</tr>
			<tr>
				<td class="c1">16.Chọn ngành</td>
				<td>
					<select multiple name="nganh" id="select-nganh" class="chon-nganh">
						@foreach($all_nganh as $value_nganh)
						<option value="{{$value_nganh->id}}" <?php if($value_nganh->id == $all_decuong->id_nganh) echo "selected"; ?>>{{$value_nganh->tennganh}}</option>
						@endforeach
					</select>
				</td>
			</tr>
			<tr>
				<td class="c1">16. Chuẩn đầu ra của học phần</td>
				<td class="cdr">
					<ul id="chuan-dau-ra">
						<li>
							<p class="stt-1">STT</p>
							<h4>Chuẩn đầu ra học phần (CLO)</h4>
						</li>
						<?php $stt_cdr_chung = 1; ?>
						@foreach($all_cdr_nganh as $value_cdr_chung)
						<li>
							<div class="cdr-left">
								<p class="stt-cdr">{{$stt_cdr_chung}}</p>
								<h3 class="name-cdr11">{{$value_cdr_chung->noidung_cdr_chung}}</h3>
							</div>
							
							<div class="cdr-right" id="add-parent-cdr-{{$value_cdr_chung->id_cdr_chung}}">
							@foreach($all_chuandaura as $value_chuandaura)
							@if($value_chuandaura->id_cdr_chung == $value_cdr_chung->id_cdr_chung)
								<div class="line-add-cdr">
									<input type="hidden" name="list_cdr[]" value="{{$value_cdr_chung->id_cdr_chung}}">
									<textarea name="list_cdr[]">{{$value_chuandaura->noi_dung}}</textarea>
									<h5 id="delete-cdr">Xoá</h5>
								</div>
								@endif
							@endforeach
							</div>
							
							<p id="add-cdr" data-value="{{$value_cdr_chung->id_cdr_chung}}">Thêm</p>
							<?php $stt_cdr_chung++; ?>
						</li>
						@endforeach
					</ul>
				</td>
			</tr>
			<!-- <tr>
				<td class="c1">16. Chuẩn đầu ra của học phần</td>
				<td class="cdr">
					<ul id="chuan-dau-ra">
						<li>
							<p>STT</p>
							<h4>Chuẩn đầu ra học phần (CLO)</h4>
						</li>
						
						
					</ul>
					<p id="add-cdr">Thêm</p>
				</td>
			</tr> -->
			<tr>
				<td class="c1">17. Nhiệm vụ của học viên</td>
				<td>
					<textarea name="nhiemvu" required="" placeholder="Nhiệm vụ của học viên">{{$all_decuong->nhiemvu}}</textarea>
				</td>
			</tr>
			<tr>
				<td class="c1">18. Kế hoạch giảng dạy và học cho phần lý thuyết</td>
				<td class="khgd">
					<!-- <table border="1px">
						<thead>
							<tr>
								<td>Tuần/Buổi</td>
								<td>Nội dung chi tiết</td>
								<td>Hoạt động dạy và học</td>
								<td>Bài đánh giá</td>
								<td>CĐR học phần</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>
									<textarea id="content">
										Welcome to TinyMCE!
									</textarea>
								</td>
								<td>3</td>
								<td>4</td>
								<td>5</td>
							</tr>
							<script>
								tinymce.init({
									selector: '#content',
									menubar: false,
									toolbar: false,
								});
							</script>
						</tbody>
					</table> -->
				</td>
			</tr>
			<tr>
				<td class="c1">19. Tài liệu tham khảo - Giáo trình</td>
				<td>
					<textarea name="tltk_giaotrinh" required="" placeholder="Tài liệu tham khảo - Giáo trình">{{$all_decuong->tailieuthamkhao_giaotrinh}}</textarea>
				</td>
			</tr>
			<tr>
				<td class="c1">20. Tài liệu tham khảo - Sách</td>
				<td>
					<textarea name="tltk_sach" required="" placeholder="Tài liệu tham khảo - Sách">{{$all_decuong->tailieuthamkhao_sach}}</textarea>
				</td>
			</tr>
			<tr>
				<td class="c1">Ngày phê duyệt</td>
				<td>
					<input type="date" name="ngay_phe_duyet" required="" value="{{gmdate("Y-m-d", $all_decuong->ngaypheduyet)}}">
				</td>
			</tr> 
			<tr>
				<td></td>
				<td>
					<input type="submit" name="sm_decuong" id="sm-decuong" value="Cập nhật đề cương">
				</td>
			</tr>
		</table>
	</form>
</div>

<script type="text/javascript">
	$(document).ready(function() {

		$('#ip-ten-hoc-phan').keyup(function() {
			var query = $(this).val();

			if (query != '') {
				var _token = $('input[name="_token"]').val();
				$.ajax({
					url: "{{URL::to('de-cuong/dc-ten-hoc-phan')}}",
					method: 'post',
					data:{query:query, _token:_token},
					success: function(data) {
						if (data != null) {
							$('#tenhocphanaj').fadeIn();  
       						$('#tenhocphanaj').html(data);
						}   
					}
				});
			} else {
				$('#tenhocphanaj').fadeOut();   
			}

		});


		$('#tenhocphanaj ul li').live('click', function() {
			$('#ip-ten-hoc-phan').val($(this).text()); 
			$('#tenhocphanaj').fadeOut();  
			var idtenhocphan = this.dataset.value;
			document.getElementById("id-ten-hoc-phan").value = idtenhocphan;
		});

		$('#giang-vien-phu-trach').keyup(function() {
			var query = $(this).val();

			if (query != '') {
				var _token = $('input[name="_token"]').val();
				$.ajax({
					url: "{{URL::to('de-cuong/dc-giang-vien-phu-trach')}}",
					method: 'post',
					data:{query:query, _token:_token},
					success: function(data) {
						if (data != null) {
							$('#giangvienphutrachaj').fadeIn();  
       						$('#giangvienphutrachaj').html(data);
						}   
					}
				});
			} else {
				$('#giangvienphutrachaj').fadeOut();   
			}

		});


		$('#giangvienphutrachaj ul li').live('click', function() {
			$('#giang-vien-phu-trach').val($(this).text()); 
			$('#giangvienphutrachaj').fadeOut();  
			var idgvpt = this.dataset.value;
			document.getElementById("id-giang-vien-phu-trach").value = idgvpt;
		});

		$('#giang-vien-day-cung').keyup(function() {
			var query = $(this).val();

			if (query != '') {
				var _token = $('input[name="_token"]').val();
				$.ajax({
					url: "{{URL::to('de-cuong/dc-giang-vien-day-cung')}}",
					method: 'post',
					data:{query:query, _token:_token},
					success: function(data) {
						if (data != null) {
							$('#giangviendaycungaj').fadeIn();  
       						$('#giangviendaycungaj').html(data);
						}   
					}
				});
			} else {
				$('#giangviendaycungaj').fadeOut();   
			}

		});


		$('#giangviendaycungaj ul li').live('click', function() {
			$('#giang-vien-day-cung').val(""); 
			$('#giangviendaycungaj').fadeOut(); 

			var id_gvcgd = this.dataset.value;


			var p = document.createElement("li");

			var p1 = document.createElement("p");
			var node = document.createTextNode($(this).text());
			p1.appendChild(node);

			p2 = document.createElement("input");
			p2.setAttribute("type", "hidden");
			p2.setAttribute("name", "list_id_gvdc[]");
			p2.setAttribute("value", id_gvcgd);

			var p3 = document.createElement("p")
			var node1 = document.createTextNode("Xoá");
			p3.appendChild(node1);
			p3.id = "delete-gvdc";

			p.appendChild(p1);
			p.appendChild(p3);
			p.appendChild(p2);

			var div = document.getElementById("list-gvdc");
			div.appendChild(p);

		});

		$(document).on('click', function(){  
	    	$('#tenhocphanaj').fadeOut(); 
	    	$('#giangvienphutrachaj').fadeOut();  
	    	$('#giangviendaycungaj').fadeOut();    
		}); 

		$('#delete-gvdc').live('click', function() {
			$(this).parent('li').remove();
		});

		$('#select-nganh').on('change', function() {
			var id_nganh = this.value;

			select_nganh(id_nganh);

		});

		function select_nganh(id_nganh) {
			var _token = $('input[name="_token"]').val();
			$.ajax({
				url: "{{URL::to('de-cuong/select-nganh-aj')}}",
				method: 'post',
				data:{id_nganh:id_nganh, _token:_token},
				success: function(data) {
					if (data != null) { 
       					$('#chuan-dau-ra').html(data);
					}   
				}
			});
		}


		//chuan dau ra
		$('#add-cdr').live('click', function() {

		p2 = document.createElement("input");

		//var b = $(this).closest('div').attr('id');

		var b = $(this).attr('data-value');

		p = document.createElement("div");
		p.setAttribute("class", "line-add-cdr");

		p4 = document.createElement("input");
		p4.setAttribute("type", "hidden");
		p4.setAttribute("name", "list_cdr[]");
		p4.setAttribute("value", b);
		p.appendChild(p4);

		p2 = document.createElement("textarea");
		p2.setAttribute("name", "list_cdr[]");
		p.appendChild(p2);

		p3 = document.createElement("h5");
		var nodexoa = document.createTextNode("Xoá");
		p3.appendChild(nodexoa);
		p3.id = "delete-cdr";
		p.appendChild(p3);

		var div = document.getElementById("add-parent-cdr-"+b);
		div.appendChild(p);

		// var x = document.getElementsByClassName('stt-cdr');
		// for (var i = 0; i < x.length; i++) {
		//     x[i].innerHTML = i+1;
		// } 

		});

		$('#delete-cdr').live('click', function() {
			$(this).parent('div').remove();
			var x = document.getElementsByClassName('stt-cdr');
			for (var i = 0; i < x.length; i++) {
			    x[i].innerHTML = i+1;
			}
		});

	});
</script>

@endsection