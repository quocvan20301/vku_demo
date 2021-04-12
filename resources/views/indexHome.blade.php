@extends('index')
@section('indexHome')

@yield('contendHome')

<div class="footer">
	<div class="footer-block ft-bl-1">
		<div class="title-ft-bl">
			<h3>{{__('lien_he_voi_truong')}}</h3>
		</div>
		<ul>
			<li>
				<p class="ten-truong-ft-bl">{{__('footer_1_1')}}</p>
			</li>
			<li>
				<p>{{__('footer_1_2')}}</p>
			</li>
			<li>
	 			<p>{{__('footer_1_3')}}:</p>
			</li>
			<li>
				<p>{{__('footer_1_4')}}: http://vku.udn.vn</p>
			</li>
			<li>
				<p>{{__('footer_1_5')}}: info@vku.udn.vn</p>
			</li>
		</ul>
	</div>
	<div class="footer-block ft-bl-2">
		<div class="title-ft-bl">
			<h3>{{__('lien_he_voi_khoa')}}</h3>
		</div>
		<ul>
			<li>
				<p>{{__('footer_2_1')}}</p>
			</li>
			<li>
				<p>{{__('footer_2_2')}}: </p>
			</li>
		</ul>
	</div>
	<div class="footer-block ft-bl-3">
		<div class="title-ft-bl">
			<h3>{{__('ket_noi_mang_xa_hoi')}}</h3>
		</div>
		<div class="list-icon">
			<ul>
				<li>
					<a href="#"><i class="fab fa-facebook-f icon"></i></a>
				</li>
				<li>
					<a href="#"><i class="fab fa-twitter icon"></i></a>
				</li>
				<li>
					<a href="#"><i class="fab fa-linkedin-in icon"></i></a>
				</li>
				<li>
					<a href="#"><i class="fab fa-google-plus-g icon"></i></a>
				</li>
			</ul>
		</div>
	</div>
</div>
@endsection