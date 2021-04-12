@extends('indexHome')
@section('contendHome')

<div class="top-theme-1">
	<ul id="ticker">
		@foreach($all_top_news as $value_tttbao)
		<li>
			<span>
				<div class="title-breaking-news">
					<p style="background: {{$value_tttbao->Color_bl}}">{{$value_tttbao->Name_l0}}</p>
				</div>
				<span class="content-breaking-news">
					<a href="{{URL::to('thong-tin-chi-tiet/'.$value_tttbao->Slug)}}">{{$value_tttbao->Title_l0}}</a>
				</span>
			</span>
		</li>
		@endforeach
	</ul> 
	<script type="text/javascript">
		$(document).ready(function(){
			function tick(timeout){
				var first = $('#ticker li:first');
				var next = first.next();

				first.children('span').fadeOut(timeout);
				first.slideUp(timeout, function () {      
					first.appendTo($('#ticker'));                
				});

				next.slideDown(timeout);
				next.children('span').hide().fadeIn(timeout);
			}
			setInterval(function(){tick(1000)}, 7000);
		});
	</script>

</div>

<div class="top-theme-2">
	<div class="top-main">
		<div class="top-main-left">
			<div class="top-news">
				<div class="top-news-img">
					<a href="{{URL::to('thong-tin-chi-tiet/'.$all_tttbao_hot->Slug)}}"><img src="{{ asset('./public/uploads/Cms_img/'.$all_tttbao_hot->Avatar)}}"></a>
				</div>
				<div class="top-news-content">
					<a href="{{URL::to('thong-tin-chi-tiet/'.$all_tttbao_hot->Slug)}}"><p class="title">{{$all_tttbao_hot->Title_l0}}</p></a>
					<p>{{$all_tttbao_hot->SimpleContent_l0}}</p>
				</div>
			</div>
			<div class="bottom-news">
				@foreach($all_tttbao as $value_tttbao)
				<div class="block-news">
					<a href="{{URL::to('thong-tin-chi-tiet/'.$value_tttbao->Slug)}}"><p class="title">{{$value_tttbao->Title_l0}}</p></a>
					<p>{{$value_tttbao->SimpleContent_l0}}</p>
				</div>
				@endforeach
			</div>
		</div>
		<div class="top-main-right">
			<img src="{{ asset('./public/Images/vku.png')}}">
		</div>
	</div>
</div>

<div class="main-theme-2">
	<div class="theme-2-left">

		<div class="block-theme-2">
			<div class="top-block-theme-2">
				<p>Tin tức ngành</p>
			</div>
			<div class="bottom-block-theme-2">
				<div class="bottom-left-theme-2">
					<p><a href="{{URL::to('thong-tin-chi-tiet/'.$all_ttnganh_hot->Slug)}}">{{$all_ttnganh_hot->Title_l0}}</a></p>
					<div class="img-block-theme-2">
						<a href="{{URL::to('thong-tin-chi-tiet/'.$all_ttnganh_hot->Slug)}}"><img src="{{ asset('./public/uploads/Cms_img/'.$all_ttnganh_hot->Avatar)}}"></a>
					</div>
					<div class="content-block-theme-2">
						<p>{{$all_ttnganh_hot->SimpleContent_l0}}</p>
						<p class="read-more-cbt2"><a href="{{URL::to('thong-tin-chi-tiet/'.$all_ttnganh_hot->Slug)}}">[Xem thêm]</a></p>
					</div>
				</div>
				<div class="bottom-right-theme-2">
					<ul>
						<li>
							@foreach($all_ttnganh as $value_ttnganh)
							<p>
								<i class="fas fa-caret-right"></i>
								<a href="{{URL::to('thong-tin-chi-tiet/'.$value_ttnganh->Slug)}}">{{$value_ttnganh->Title_l0}}</a>
							</p>
							@endforeach							
						</li>
					</ul>
					<p><a href="{{URL::to('tin-tuc-nganh')}}">[Xem tất cả]</a></p>
				</div>
			</div>
		</div>

		<div class="block-theme-2">
			<div class="top-block-theme-2">
				<p>Nghiên cứu khoa học</p>
			</div>
			<div class="bottom-block-theme-2">
				<div class="bottom-left-theme-2">
					<p><a href="{{URL::to('thong-tin-chi-tiet/'.$all_nckhoc_hot->Slug)}}">{{$all_nckhoc_hot->Title_l0}}</a></p>
					<div class="img-block-theme-2">
						<a href="{{URL::to('thong-tin-chi-tiet/'.$all_nckhoc_hot->Slug)}}"><img src="{{ asset('./public/uploads/Cms_img/'.$all_nckhoc_hot->Avatar)}}"></a>
					</div>
					<div class="content-block-theme-2">
						<p>{{$all_nckhoc_hot->SimpleContent_l0}}</p>
						<p class="read-more-cbt2"><a href="{{URL::to('thong-tin-chi-tiet/'.$all_nckhoc_hot->Slug)}}">[Xem thêm]</a></p>
					</div>
				</div>
				<div class="bottom-right-theme-2">
					<ul>
						<li>
							@foreach($all_nckhoc as $value_nckhoc)
							<p>
								<i class="fas fa-caret-right"></i>
								<a href="{{URL::to('thong-tin-chi-tiet/'.$value_nckhoc->Slug)}}">{{$value_nckhoc->Title_l0}}</a>
							</p>
							@endforeach							
						</li>
					</ul>
					<p><a href="{{URL::to('nghien-cuu-khoa-hoc')}}">[Xem tất cả]</a></p>
				</div>
			</div>
		</div>

		
	</div>
	<div class="theme-2-right">

		<div class="block-theme-2-right">
			<div class="top-theme-2-right">
				<p>Đối tác hợp tác</p>
			</div>

			<script type="text/javascript" src="{{ asset('./public/Js/jquery.marquee.js')}}"></script>

			<div class="bottom-theme-2-right-doitac">
				<ul id="marquee-vertical">
					<li>
						<img src="{{ asset('./public/Images/home/ajou.jpg')}}">
						<img src="{{ asset('./public/Images/home/ajou.jpg')}}">
					</li>
					<li>
						<img src="{{ asset('./public/Images/home/ajou.jpg')}}">
						<img src="{{ asset('./public/Images/home/ajou.jpg')}}">
					</li>
					<li>
						<img src="{{ asset('./public/Images/home/ajou.jpg')}}">
						<img src="{{ asset('./public/Images/home/ajou.jpg')}}">
					</li>
					<li>
						<img src="{{ asset('./public/Images/home/ajou.jpg')}}">
						<img src="{{ asset('./public/Images/home/ajou.jpg')}}">
					</li>
					<li>
						<img src="{{ asset('./public/Images/home/ajou.jpg')}}">
						<img src="{{ asset('./public/Images/home/ajou.jpg')}}">
					</li>
				</ul>
			</div>

			<script type="text/javascript">

				$(function(){


					$('#marquee-vertical').marquee();  
					$('#marquee-horizontal').marquee({direction:'horizontal', delay:0, timing:50});  

				});

			</script>
			<script type="text/javascript">

				var _gaq = _gaq || [];
				_gaq.push(['_setAccount', 'UA-36251023-1']);
				_gaq.push(['_setDomainName', 'jqueryscript.net']);
				_gaq.push(['_trackPageview']);

				(function() {
					var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;

					var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
				})();

			</script>

		</div>

		<div class="block-theme-2-right">
			<img src="{{ asset('./public/Images/home/bwd.jpg')}}">
		</div>

		<div class="block-theme-2-right">
			<div class="top-theme-2-right">
				<p>Tin mới</p>
			</div>
			<div class="bottom-theme-2-right">
				<ul>
					@foreach($all_tttbao as $vl_tttbao)
					<li>
						<p><i class="fas fa-caret-right"></i><a href="{{URL::to('thong-tin-chi-tiet/'.$vl_tttbao->Slug)}}">{{$vl_tttbao->Title_l0}}</a></p>
					</li>
					@endforeach
				</ul>
			</div> 	
		</div>

	</div>
</div>

<div class="bottom-theme-2">
	<div class="bottom-theme-left">
		<div class="top-theme-left">
			<p>Top Theme 1</p>
		</div>
		<div class="row-1">
			<div class="row-1-top">
				<a href="#">
					<img src="{{ asset('./public/Images/image1.jpg')}}">
					<div class="shadown"></div>
					<div class="content">
						<div class="title">VKU: Trường Đại học vươn tầm quốc tế</div>
						<span class="sub-ct">Hiện nay, trên toàn thế giới nói chung và tại Việt Nam nói riêng, một trường Đại học được xem là hiện đại, chất lượng cao phải đáp ứng đồng thời ba chức năng cơ bản</span>
						<div class="date">
							<i class="fas fa-calendar-alt"></i>
							<span>05 - 02 - 2021</span>
						</div>
					</div>
				</a>
			</div>
			<div class="row-1-bottom">
				<div class="row-1-img">
					<a href="#">
						<img src="{{ asset('./public/Images/image1.jpg')}}">
						<div class="shadown"></div>
						<div class="content">
							<p class="title">VKU: Trường Đại học vươn tầm quốc tế</p>
							<div class="date">
								<i class="fas fa-calendar-alt"></i>
								<span>05 - 02 - 2021</span>
							</div>
						</div>
					</a>
				</div>
				<div class="row-1-img">
					<a href="#">
						<img src="{{ asset('./public/Images/image1.jpg')}}">
						<div class="shadown"></div>
						<div class="content">
							<div class="title">VKU: Trường Đại học vươn tầm quốc tế</div>
							<div class="date">
								<i class="fas fa-calendar-alt"></i>
								<span>05 - 02 - 2021</span>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
		<div class="row-2">
			<div class="list-row-2">
				<a href="#">
					<img src="{{ asset('./public/Images/image1.jpg')}}">
					<div class="shadown"></div>
					<div class="content">
						<div class="title">VKU: Trường Đại học vươn tầm quốc tế</div>
						<div class="date">
							<i class="fas fa-calendar-alt"></i>
							<span>05 - 02 - 2021</span>
						</div>
					</div>
				</a>
			</div>
			<div class="list-row-2">
				<a href="#">
					<img src="{{ asset('./public/Images/image1.jpg')}}">
					<div class="shadown"></div>
					<div class="content">
						<div class="title">VKU: Trường Đại học vươn tầm quốc tế</div>
						<div class="date">
							<i class="fas fa-calendar-alt"></i>
							<span>05 - 02 - 2021</span>
						</div>
					</div>
				</a>
			</div>
			<div class="list-row-2">
				<a href="#">
					<img src="{{ asset('./public/Images/image1.jpg')}}">
					<div class="shadown"></div>
					<div class="content">
						<div class="title">VKU: Trường Đại học vươn tầm quốc tế</div>
						<div class="date">
							<i class="fas fa-calendar-alt"></i>
							<span>05 - 02 - 2021</span>
						</div>
					</div>
				</a>
			</div>
		</div>
	</div>
	<div class="bottom-theme-right">
		<div class="top-theme-right">
			<p>Top Theme 1</p>
		</div>
		<div class="bottom-theme-right">
			<ul>
				<li>
					<div class="date">
						<div class="day">05</div>
						<div class="thang">TH01, 2021</div>
					</div>
					<div class="content">
						<p class="title">VKU: Trường Đại học vươn tầm quốc tế về nghiên cứu khoa học và hợp tác quốc tế</p>
					</div>
				</li>
				<li>
					<div class="date">
						<div class="day">05</div>
						<div class="thang">TH01, 2021</div>
					</div>
					<div class="content">
						<p class="title">VKU: Trường Đại học vươn tầm quốc tế về nghiên cứu khoa học và hợp tác quốc tế</p>
					</div>
				</li>
				<li>
					<div class="date">
						<div class="day">05</div>
						<div class="thang">TH01, 2021</div>
					</div>
					<div class="content">
						<p class="title">VKU: Trường Đại học vươn tầm quốc tế về nghiên cứu khoa học và hợp tác quốc tế</p>
					</div>
				</li>
				<li>
					<div class="date">
						<div class="day">05</div>
						<div class="thang">TH01, 2021</div>
					</div>
					<div class="content">
						<p class="title">VKU: Trường Đại học vươn tầm quốc tế về nghiên cứu khoa học và hợp tác quốc tế</p>
					</div>
				</li>
				<li>
					<div class="date">
						<div class="day">05</div>
						<div class="thang">TH01, 2021</div>
					</div>
					<div class="content">
						<p class="title">VKU: Trường Đại học vươn tầm quốc tế về nghiên cứu khoa học và hợp tác quốc tế</p>
					</div>
				</li>
				<li>
					<div class="date">
						<div class="day">05</div>
						<div class="thang">TH01, 2021</div>
					</div>
					<div class="content">
						<p class="title">VKU: Trường Đại học vươn tầm quốc tế về nghiên cứu khoa học và hợp tác quốc tế</p>
					</div>
				</li>
			</ul>
		</div>
	</div>
</div>

@endsection