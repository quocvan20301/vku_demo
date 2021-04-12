<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('./public/Css/home.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('./public/Css/chuandaura/matrancdr.css')}}">
</head>
<body>
	<div class="chuan-dau-ra">
		<h3>Bảng ma trận về mức độ cống hiến của CĐR các học phần cho CĐR của chương trình đào tạo ngành công nghệ thông tin</h3>
		<table border="1px">
			<thead>
				<tr>
					<td rowspan="2">STT</td>
					<td rowspan="2">Mã MH</td>
					<td rowspan="2">Tên môn học</td>
					<td colspan="11">PLOs (Programme Learning outcomes)</td>
				</tr>
				<tr>
					<td>PL01</td>
					<td>PL02</td>
					<td>PL03</td>
					<td>PL04</td>
					<td>PL05</td>
					<td>PL06</td>
					<td>PL07</td>
					<td>PL08</td>
					<td>PL09</td>
					<td>PL10</td>
					<td>PL11</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="14" style="font-size: 16px;">1. Khối kiến thức cơ bản</td>
				</tr>
				<tr>
					<td colspan="14">1.1 Nhóm học phần bắt buộc</td>
				</tr>
				<?php $stt_mtcdr = 1;?>
				@foreach($all_hp as $value_hp)
				<tr>
					<td class="stt_cdr">{{$stt_mtcdr}}</td>
					<td>{{$value_hp->mahocphan}}</td>
					<td>{{$value_hp->tenhocphan}}</td>
					@foreach($all_hoc_phan as $vl_ahp)
					@if($vl_ahp->mahocphan == $value_hp->mahocphan)
					<td>{{$vl_ahp->id_cdr_chung}}</td>
					@endif
					@endforeach

				</tr>
				<?php $stt_mtcdr++; ?>
				@endforeach
			</tbody>
		</table>
	</div>
</body>
</html>