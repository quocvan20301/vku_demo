<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('./public/Css/xem-de-cuong.css')}}">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
</head>
<body>
	<div class="xem-de-cuong">
		<div class="container"> 
			<div class="row">
				<div class="col-md-9" style="margin: auto;">
					<div class="line-top">
						<div class="line-top-left">
							<p>ĐẠI HỌC ĐÀ NẴNG </br> Trường ĐH CNTT & TT VIỆT-HÀN </br> {{$all_decuong->tenKhoa}}</p>
						</div>
						<div class="line-top-right">
							<p>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM </br> Độc Lập - Tự Do - Hạnh Phúc</p>
							<hr>
						</div>
					</div>
					<p class="ctdt">Chương trình đào tạo</p>
					<div class="line-ngang">
						<p class="bl-line-1">Trình độ đào tạo:</p>
						<p>Đại học</p>
					</div>
					<div class="line-ngang">
						<p class="bl-line-1">Ngành/Chuyên ngành:</p>
						<p>{{$all_decuong->tennganh}}</p>
						<p class="ms">Mã số: {{$all_decuong->manganh}}</p>
					</div>
					<h3 class="tieu-de">Đề cương chi tiết học phần</h3>
					<p class="ten-hoc-phan">Tên học phần: {{$all_decuong->tenhocphan}}</p>
					<table border="1px" cellspacing="0" class="table-top">
						<tr>
							<td class="row-1">1. Mã học phần</td>
							<td class="row-2">{{$all_decuong->mahocphan}}</td>
						</tr>
						<tr>
							<td class="row-1">2. Số tín chỉ</td>
							<td class="row-2">{{$all_decuong->soTC}}</td>
						</tr>
						<tr>
							<td class="row-1">3. Phân bố thời gian</td>
							<td class="row-2">2</td>
						</tr>
						<tr>
							<td class="row-2">- Lý thuyết</td>
							<td class="row-2">{{$all_decuong->phanbo_lythuyet}}</td>
						</tr>
						<tr>
							<td class="row-2">- Bài tập/Thảo luận</td>
							<td class="row-2">{{$all_decuong->phanbo_baitap}}</td>
						</tr>
						<tr>
							<td class="row-2">- Thực hành/Thí nghiệm</td>
							<td class="row-2">{{$all_decuong->phanbo_thuchanh}}</td>
						</tr>
						<tr>
							<td class="row-2">- Tự học</td>
							<td class="row-2">{{$all_decuong->phanbo_tuhoc}}</td>
						</tr>
						<tr>
							<td class="row-1">4. Các giảng viên phụ trách học phần</td>
							<td class="row-2">{{$all_decuong->hodem}} {{$all_decuong->ten}}</td>
						</tr>
						<tr>
							<td class="row-2">- Giảng viên phụ trách chính:  </td>
							<td class="row-2">{{$all_decuong->hodem}} {{$all_decuong->ten}}</td>
						</tr>
						<tr>
							<td class="row-2">- Danh sách giảng viên cùng giảng dạy:</td>
							<td class="row-2">
								<ul>
									@foreach($list_gvdc as $val_lgvdc)
									<li>
										<p>{{$val_lgvdc}}</p>
									</li>
									@endforeach
								</ul>
							</td>
						</tr>
						<tr>
							<td class="row-2">- Bộ môn phụ trách giảng dạy:</td>
							<td class="row-2">{{$all_decuong->tenKhoa}}</td>
						</tr>
						<tr>
							<td class="row-1">5. Điều kiện tham gia học phần</td>
							<td class="row-2">2</td>
						</tr>
						<tr>
							<td class="row-2">- Học phần tiên quyết:</td>
							<td class="row-2">2</td>
						</tr>
						<tr>
							<td class="row-2">- Học phần học trước:</td>
							<td class="row-2">2</td>
						</tr>
						<tr>
							<td class="row-2">- Học phần song hành:</td>
							<td class="row-2">2</td>
						</tr>
						<tr>
							<td class="row-1">6. Loại học phần</td>
							<td class="row-2">
								<ul>
									<li>
										<input id="av" type="checkbox" name="" disabled class="check-box" <?php if($all_decuong->loaihocphan == 1) echo "checked"; ?> >
										<p class="right-check-box">Bắt buộc</p>
									</li>
									<li>
										<input type="checkbox" name="" disabled class="check-box" <?php if($all_decuong->loaihocphan == 2) echo "checked"; ?> >
										<p class="right-check-box">Tự chọn bắt buộc </p>
									</li>
									<li>
										<input type="checkbox" name="" disabled class="check-box" <?php if($all_decuong->loaihocphan == 3) echo "checked"; ?> >
										<p class="right-check-box">Tự chọn tự do</p>
									</li>
								</ul>
							</td>
						</tr>
						<tr>
							<td class="row-1">7. Thuộc khối kiến thức</td>
							<td class="row-2">
								<ul>
									<li>
										<input type="checkbox" name="" disabled class="check-box" <?php if($all_decuong->khoikienthuc == 1) echo "checked"; ?> >
										<p class="right-check-box">Toán và Khoa học tự nhiên</p>
									</li>
									<li>
										<input type="checkbox" name="" disabled class="check-box" <?php if($all_decuong->khoikienthuc == 2) echo "checked"; ?> >
										<p class="right-check-box">Kiến thức chung</p>
									</li>
									<li>
										<input type="checkbox" name="" disabled class="check-box" <?php if($all_decuong->khoikienthuc == 3) echo "checked"; ?> >
										<p class="right-check-box">Kiến thức Cơ sở ngành</p>
									</li>
									<li>
										<input type="checkbox" name="" disabled class="check-box" <?php if($all_decuong->khoikienthuc == 4) echo "checked"; ?> >
										<p class="right-check-box">Kiến thức Chuyên ngành</p>
									</li>
									<li>
										<input type="checkbox" name="" disabled class="check-box" <?php if($all_decuong->khoikienthuc == 5) echo "checked"; ?> >
										<p class="right-check-box">Thực tập</p>
									</li>
									<li>
										<input type="checkbox" name="" disabled class="check-box" <?php if($all_decuong->khoikienthuc == 6) echo "checked"; ?> >
										<p class="right-check-box">Đồ án tốt nghiệp</p>
									</li>
								</ul>		
							</td>
						</tr>
					</table>
					<p class="cate block-2">8. Mô tả tóm tắt học phần</p>
					<p class="content">{{$all_decuong->mota_tomtat}}</p>
					<p class="cate">9. Mục tiêu của học phần: </p>
					<p class="cate">a. Kiến thức</p>
					<p class="content">Trang bị cho sinh viên những kiến thức như sau:</p>
					<p class="content" id="muctieu-kienthuc">
						
					</p>
					<p class="cate">b. Kỹ năng</p>
					<p class="content">Rèn luyện cho sinh viên kỹ năng cá nhân, kỹ năng giao tiếp thiết yếu cùng với các kỹ năng thực hành thực tế. cụ thể như sau:</p>
					<p class="content" id="muctieu-kynang">
						
					</p>
					<p class="cate">c. Thái độ</p>
					<p class="content" id="muctieu-thaido">
						
					</p>
					<p class="cate">10. Chuẩn đầu ra của học phần: </p>
					<p>Sau khi kết thúc học phần sinh viên có khả năng</p>

					<table border="1px" cellspacing="0" class="table-cdr">
					<thead>
						<tr>
							<td class="row-stt">STT</td>
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

					<p class="cate">11. Nhiệm vụ của học viên: </p>
					<p class="content">Sinh viên phải thực hiện các nhiệm vụ sau đây:</p>
					<p class="content" id="nhiemvu-hocvien">

					</p>

					@if(isset($all_dghp) && $all_dghp != null)
					<p class="cate">12.	Đánh giá học phần: </p>
					<p class="content">Kết quả học tập của sinh viên được đánh giá bằng các thành phần: đánh giá quá trình, đánh giá giữa kỳ, đánh giá cuối kỳ, các hoạt động đánh giá khác. </p>
					<table border="1px" cellspacing="0" class="table-danh-gia-hoc-phan">
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
											<td rowspan="2"><p class="left-bdg">W.<?php echo $stt; ?></p> <p> %</p></td>
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
										<td><p class="left-bdg">W.<?php echo $stt; ?></p> <p> %</p></td>
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
					@endif

					@if(isset($all_kehoachgiangday_lt) && $all_kehoachgiangday_lt != null)
					<p class="cate">13. Kế hoạch giảng dạy và học: </p>
					<p class="cate">13.1 Kế hoạch giảng dạy và học cho phần lý thuyết: </p>
					<table border="1px" cellspacing="0" class="table-ke-hoach-giang-day">
						<thead>
							<tr>
								<td class="row-stt-khgd">Tuần / Buổi</td>
								<td>Nội dung chi tiết</td>
								<td>Hoạt động dạy và học</td>
								<td>Bài đánh giá</td>
								<td>CĐR học phần</td>
							</tr>
						</thead>
						<tbody>
							<?php $stt_lt=1; ?>
							@foreach($all_kehoachgiangday_lt as $value_all_khgd_lt)
							<tr>
								<td class="row-stt-khgd">{{$stt_lt++}}</td>
								<td>
									<ul>
										@for($i = 0; $i < count($value_all_khgd_lt->noidung); $i++ )
										<li>{{$value_all_khgd_lt->noidung[$i]}}</li>
										@endfor
									</ul>
								</td>
								<td>
									<ul>
										@for($i = 0; $i < count($value_all_khgd_lt->hoatdongdayhoc); $i++ )
										<li>{{$value_all_khgd_lt->hoatdongdayhoc[$i]}}</li>
										@endfor
									</ul>
								</td>
								<td>{{$value_all_khgd_lt->baidanhgia}}</td>
								<td>
									@foreach($value_all_khgd_lt->cdrhocphan as $value_list_cdr)
										@if (next($value_all_khgd_lt->cdrhocphan)==true)
										CLO {{$value_list_cdr}},
										@else
										CLO {{$value_list_cdr}}
										@endif
									@endforeach
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					@endif

					@if(isset($all_kehoachgiangday_th) && $all_kehoachgiangday_th != null)
					<p class="cate">13.1 Kế hoạch giảng dạy và học cho phần thực hành: </p>
					<table border="1px" cellspacing="0" class="table-ke-hoach-giang-day">
						<thead>
							<tr>
								<td>Tuần / Buổi</td>
								<td>Nội dung chi tiết</td>
								<td>Hoạt động dạy và học</td>
								<td>Bài đánh giá</td>
								<td>CĐR học phần</td>
							</tr>
						</thead>
						<tbody>
							<?php $stt_lt=1; ?>
							@foreach($all_kehoachgiangday_th as $value_all_khgd_th)
							<tr>
								<td class="row-stt-khgd">{{$stt_lt++}}</td>
								<td>
									<ul>
										@for($i = 0; $i < count($value_all_khgd_th->noidung); $i++ )
										<li>{{$value_all_khgd_th->noidung[$i]}}</li>
										@endfor
									</ul>
								</td>
								<td>
									<ul>
										@for($i = 0; $i < count($value_all_khgd_th->hoatdongdayhoc); $i++ )
										<li>{{$value_all_khgd_th->hoatdongdayhoc[$i]}}</li>
										@endfor
									</ul>
								</td>
								<td>{{$value_all_khgd_th->baidanhgia}}</td>
								<td>
									@foreach($value_all_khgd_th->cdrhocphan as $value_list_cdr)
										@if (next($value_all_khgd_th->cdrhocphan)==true)
										CLO {{$value_list_cdr}},
										@else
										CLO {{$value_list_cdr}}
										@endif
									@endforeach
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					@endif

					<p class="cate">14. Tài liệu học tập: </p>
					<p class="cate">14.1 Sách, bài giảng, giáo trình chính: </p>
					<p class="content" id="tailieuthamkhao-gt">

					</p>
					<p class="cate">14.2 Sách, tài liệu tham khảo: </p>
					<p class="content" id="tailieuthamkhao-sach">

					</p>
					<p class="cate">15. Ngày phê duyệt: {{gmdate("d-m-Y", $all_decuong->ngaypheduyet)}}</p>
				</div>
			</div>
		</div>
	</div>

	<script>

		function list_content(content_li, id_li) {
			var a = content_li;
			var b = a.split('\n');

			var p = document.createElement("ul");

				for (var i = 0; i < b.length; i++) {

				var p1 = document.createElement("li");
				var node = document.createTextNode("- "+b[i]);
				p1.appendChild(node);
				p.appendChild(p1);
			}

			var div = document.getElementById(id_li);
			div.appendChild(p);

		}

		function list_content_gt(content_li, id_li) {
			var a = content_li;
			var b = a.split('\n');

			var p = document.createElement("ul");

				for (var i = 0; i < b.length; i++) {

				var p1 = document.createElement("li");
				var node = document.createTextNode("["+(i+1)+"] "+b[i]);
				p1.appendChild(node);
				p.appendChild(p1);
			}

			var div = document.getElementById(id_li);
			div.appendChild(p);

		}

		var ct = <?php echo json_encode($all_decuong->muctieu_kienthuc, JSON_HEX_TAG); ?>;
		var id_p = "muctieu-kienthuc";
		list_content(ct, id_p);

		var ct_kn = <?php echo json_encode($all_decuong->muctieu_kynang, JSON_HEX_TAG); ?>;
		var id_kn = "muctieu-kynang";
		list_content(ct_kn, id_kn);

		var ct_td = <?php echo json_encode($all_decuong->muctieu_thaido, JSON_HEX_TAG); ?>;
		var id_td = "muctieu-thaido";
		list_content(ct_td, id_td);
		

		var ct_nv = <?php echo json_encode($all_decuong->nhiemvu, JSON_HEX_TAG); ?>;
		var id_nv = "nhiemvu-hocvien";
		list_content(ct_nv, id_nv);

		var ct_gt = <?php echo json_encode($all_decuong->tailieuthamkhao_giaotrinh, JSON_HEX_TAG); ?>;
		var id_gt = "tailieuthamkhao-gt";
		list_content_gt(ct_gt, id_gt);

		var ct_sach = <?php echo json_encode($all_decuong->tailieuthamkhao_sach, JSON_HEX_TAG); ?>;
		var id_sach = "tailieuthamkhao-sach";
		list_content_gt(ct_sach, id_sach);

		

	</script>

</body>
</html>

