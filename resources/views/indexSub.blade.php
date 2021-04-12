@extends('index')
@section('indexSub')

@yield('contendGioithieu')
@yield('contendBieumau')
@yield('contendChitietbieumau')
@yield('contendThongTinChiTiet')
@yield('contendThontinThongbao')

<div class="footer-sub">
	<div class="block-fts1">
		<div class="img-fts1">
			<img src="{{ asset('./public/Images/home/logofooter.png')}}">
		</div>
		<div class="content-fts1">
			<p>Copyright © 2020 - Viet Han University</p>
		</div>
	</div>
	<div class="block-fts2">
		<ul>
			<li>Địa chỉ: Khu đô thị Đại học Đà Nẵng, 470 Đường Trần Đại Nghĩa, phường Hòa Quý, quận Ngũ Hành Sơn, Đà Nẵng</li>
			<li>Sđt:</li>
			<li>Email: info@vku.udn.vn</li>
		</ul>
	</div>
</div>
@endsection