@extends('indexHome')
@section('contendHome') 

<!-- <div class="top-jssor-bl">
	<script>

        jQuery(document).ready(function ($) {
            var options = {
                $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlaySteps: 1,                                  //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
                $AutoPlayInterval: 4000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $PauseOnHover: 1,                               //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1
                $Loop: 1,                                       //[Optional] Enable loop(circular) of carousel or not, 0: stop, 1: loop, 2 rewind, default value is 1

                $ArrowKeyNavigation: true,                          //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                $SlideDuration: 500,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
                $MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
                //$SlideWidth: 600,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
                //$SlideHeight: 300,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
                $SlideSpacing: 5,                                   //[Optional] Space between each slide in pixels, default value is 0
                $DisplayPieces: 1,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
                $ParkingPosition: 0,                                //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
                $UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
                $PlayOrientation: 2,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
                $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

                $ThumbnailNavigatorOptions: {
                    $Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always

                    $Loop: 2,                                       //[Optional] Enable loop(circular) of carousel or not, 0: stop, 1: loop, 2 rewind, default value is 1
                    $AutoCenter: 3,                                 //[Optional] Auto center thumbnail items in the thumbnail navigator container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 3
                    $Lanes: 1,                                      //[Optional] Specify lanes to arrange thumbnails, default value is 1
                    $SpacingX: 4,                                   //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
                    $SpacingY: 4,                                   //[Optional] Vertical space between each thumbnail in pixel, default value is 0
                    $DisplayPieces: 4,                              //[Optional] Number of pieces to display, default value is 1
                    $ParkingPosition: 0,                            //[Optional] The offset position to park thumbnail
                    $Orientation: 2,                                //[Optional] Orientation to arrange thumbnails, 1 horizental, 2 vertical, default value is 1
                    $DisableDrag: false                             //[Optional] Disable drag or not, default value is false
                }
            };

            var jssor_slider1 = new $JssorSlider$("slider1_container", options);
        });
    </script>
    <div id="slider1_container">
        <div u="slides" class="ctn-slides">

            <div>
                <img u="image" src="{{ asset('./public/images/bwd2020.jpg')}}" />
                <div class="shadown-t1"></div>
                <div class="content-t1">
                	<div class="title-t1">VKU: Trường Đại học vươn tầm quốc tế VKU: Trường Đại học vươn tầm quốc tếVKU: Trường Đại học vươn tầm quốc tế</div>
                	<div class="date-t1">
                		<i class="fas fa-calendar-alt"></i>
                		<span>05 - 02 - 2021</span>
                	</div>
                </div>
                <div u="thumb">
                    <img class="i" src="{{ asset('./public/images/bwd2020.jpg')}}" />
                    <div class="t">Carousel VKU: Trường Đại học vươn tầm quốc tế VKU: Trường Đại học vươn tầm quốc tế</div>
                </div>
            </div>
            <div>
                <img u="image" src="{{ asset('./public/images/bwd2020.jpg')}}" />
                <div class="shadown-t1"></div>
                <div class="content-t1">
                	<div class="title-t1">VKU: Trường Đại học vươn tầm quốc tế</div>
                	<div class="date-t1">
                		<i class="fas fa-calendar-alt"></i>
                		<span>05 - 02 - 2021</span>
                	</div>
                </div>
                <div u="thumb">
                    <img class="i" src="{{ asset('./public/images/bwd2020.jpg')}}" />
                    <div class="t">Carousel VKU: Trường Đại học vươn tầm quốc tế VKU: Trường Đại học vươn tầm quốc tế</div>
                </div>
            </div>
            <div>
                <img u="image" src="{{ asset('./public/images/bwd2020.jpg')}}" />
                <div class="shadown-t1"></div>
                <div class="content-t1">
                	<div class="title-t1">VKU: Trường Đại học vươn tầm quốc tế</div>
                	<div class="date-t1">
                		<i class="fas fa-calendar-alt"></i>
                		<span>05 - 02 - 2021</span>
                	</div>
                </div>
                <div u="thumb">
                    <img class="i" src="{{ asset('./public/images/bwd2020.jpg')}}" />
                    <div class="t">Carousel VKU: Trường Đại học vươn tầm quốc tế VKU: Trường Đại học vươn tầm quốc tế</div>
                </div>
            </div>
            <div>
                <img u="image" src="{{ asset('./public/images/bwd2020.jpg')}}" />
                <div class="shadown-t1"></div>
                <div class="content-t1">
                	<div class="title-t1">VKU: Trường Đại học vươn tầm quốc tế</div>
                	<div class="date-t1">
                		<i class="fas fa-calendar-alt"></i>
                		<span>05 - 02 - 2021</span>
                	</div>
                </div>
                <div u="thumb">
                    <img class="i" src="{{ asset('./public/images/bwd2020.jpg')}}" />
                    <div class="t">Carousel VKU: Trường Đại học vươn tầm quốc tế VKU: Trường Đại học vươn tầm quốc tế</div>
                </div>
            </div>
            <div>
                <img u="image" src="{{ asset('./public/images/bwd2020.jpg')}}" />
                <div class="shadown-t1"></div>
                <div class="content-t1">
                	<div class="title-t1">VKU: Trường Đại học vươn tầm quốc tế</div>
                	<div class="date-t1">
                		<i class="fas fa-calendar-alt"></i>
                		<span>05 - 02 - 2021</span>
                	</div>
                </div>
                <div u="thumb">
                    <img class="i" src="{{ asset('./public/images/bwd2020.jpg')}}" />
                    <div class="t">Carousel VKU: Trường Đại học vươn tầm quốc tế VKU: Trường Đại học vươn tầm quốc tế</div>
                </div>
            </div>
        </div>
        
        <div u="thumbnavigator" class="jssort11">
            <div u="slides" style="cursor: default;" class="slides-content-dv">
                <div u="prototype" class="p" style="top: 0; left: 0;">
                    <div u="thumbnailtemplate" class="tp"></div>
                </div>
            </div>
        </div>

    </div>
</div>
 -->

<div class="main-content">
    <div class="main-content-left">
        <div class="top-main-content-left">
            <img src="http://www.udn.vn/Portals/_default/skins/dhdnskin/img/tintuc.png">
            <p>Tin tức - sự kiện</p>
        </div>
        <div class="bottom-main-content-left">
            <ul>
                <li>
                    <a href="#">
                        <img src="{{ asset('./public/Images/bwd2020.jpg')}}">
                    </a>
                    <a href="#">
                        <div class="content-r">
                            <p class="title">Đại học Đà Nẵng giữ ổn định 04 phương thức xét tuyển, mở rộng cơ hội theo đề án tuyển sinh riêng của các trường đại học thành viên</p>
                            <div class="date">
                                <i class="fas fa-calendar-alt"></i>
                                <span>19 - 02 - 2021</span> 
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="{{ asset('./public/Images/bwd2020.jpg')}}">
                    </a>
                    <a href="#">
                        <div class="content-r">
                            <p class="title">Đại học Đà Nẵng giữ ổn định 04 phương thức xét tuyển, mở rộng cơ hội theo đề án tuyển sinh riêng của các trường đại học thành viên</p>
                            <div class="date">
                                <i class="fas fa-calendar-alt"></i>
                                <span>19 - 02 - 2021</span> 
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="{{ asset('./public/Images/bwd2020.jpg')}}">
                    </a>
                    <a href="#">
                        <div class="content-r">
                            <p class="title">Đại học Đà Nẵng giữ ổn định 04 phương thức xét tuyển, mở rộng cơ hội theo đề án tuyển sinh riêng của các trường đại học thành viên</p>
                            <div class="date">
                                <i class="fas fa-calendar-alt"></i>
                                <span>19 - 02 - 2021</span> 
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="{{ asset('./public/Images/bwd2020.jpg')}}">
                    </a>
                    <a href="#">
                        <div class="content-r">
                            <p class="title">Đại học Đà Nẵng giữ ổn định 04 phương thức xét tuyển, mở rộng cơ hội theo đề án tuyển sinh riêng của các trường đại học thành viên</p>
                            <div class="date">
                                <i class="fas fa-calendar-alt"></i>
                                <span>19 - 02 - 2021</span> 
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="{{ asset('./public/Images/bwd2020.jpg')}}">
                    </a>
                    <a href="#">
                        <div class="content-r">
                            <p class="title">Đại học Đà Nẵng giữ ổn định 04 phương thức xét tuyển, mở rộng cơ hội theo đề án tuyển sinh riêng của các trường đại học thành viên</p>
                            <div class="date">
                                <i class="fas fa-calendar-alt"></i>
                                <span>19 - 02 - 2021</span> 
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="{{ asset('./public/Images/bwd2020.jpg')}}">
                    </a>
                    <a href="#">
                        <div class="content-r">
                            <p class="title">Đại học Đà Nẵng giữ ổn định 04 phương thức xét tuyển, mở rộng cơ hội theo đề án tuyển sinh riêng của các trường đại học thành viên</p>
                            <div class="date">
                                <i class="fas fa-calendar-alt"></i>
                                <span>19 - 02 - 2021</span> 
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="{{ asset('./public/Images/bwd2020.jpg')}}">
                    </a>
                    <a href="#">
                        <div class="content-r">
                            <p class="title">Đại học Đà Nẵng giữ ổn định 04 phương thức xét tuyển, mở rộng cơ hội theo đề án tuyển sinh riêng của các trường đại học thành viên</p>
                            <div class="date">
                                <i class="fas fa-calendar-alt"></i>
                                <span>19 - 02 - 2021</span> 
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="{{ asset('./public/Images/bwd2020.jpg')}}">
                    </a>
                    <a href="#">
                        <div class="content-r">
                            <p class="title">Đại học Đà Nẵng giữ ổn định 04 phương thức xét tuyển, mở rộng cơ hội theo đề án tuyển sinh riêng của các trường đại học thành viên</p>
                            <div class="date">
                                <i class="fas fa-calendar-alt"></i>
                                <span>19 - 02 - 2021</span> 
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <a href="#" class="see-all">
            Xem tất cả
            <i class="fas fa-arrow-right "></i>
        </a>
        <div class="border-line">
            
        </div>
    </div>

    <div class="main-content-right">
        <div class="top-main-content-right">
            <img src="http://www.udn.vn/Portals/_default/skins/dhdnskin/img/thongbao.png">
            <p>Thông báo</p>
        </div>
        <div class="bottom-main-content-right">
            <ul>
                <li>
                   <div class="date">
                        <i class="fas fa-calendar-alt"></i>
                        <span>19 - 02 - 2021</span> 
                    </div> 
                    <a href="#"><p>Trường Đại học Mahidol, Thái Lan thông báo Học bổng Thạc sĩ, Tiến sĩ ngành Công nghệ thông tin năm 2021</p></a>
                </li>
                <li>
                   <div class="date">
                        <i class="fas fa-calendar-alt"></i>
                        <span>19 - 02 - 2021</span> 
                    </div> 
                    <p>Trường Đại học Mahidol, Thái Lan thông báo Học bổng Thạc sĩ, Tiến sĩ ngành Công nghệ thông tin năm 2021</p>
                </li>
                <li>
                   <div class="date">
                        <i class="fas fa-calendar-alt"></i>
                        <span>19 - 02 - 2021</span> 
                    </div> 
                    <p>Trường Đại học Mahidol, Thái Lan thông báo Học bổng Thạc sĩ, Tiến sĩ ngành Công nghệ thông tin năm 2021</p>
                </li>
                <li>
                   <div class="date">
                        <i class="fas fa-calendar-alt"></i>
                        <span>19 - 02 - 2021</span> 
                    </div> 
                    <p>Trường Đại học Mahidol, Thái Lan thông báo Học bổng Thạc sĩ, Tiến sĩ ngành Công nghệ thông tin năm 2021</p>
                </li>
                <li>
                   <div class="date">
                        <i class="fas fa-calendar-alt"></i>
                        <span>19 - 02 - 2021</span> 
                    </div> 
                    <p>Trường Đại học Mahidol, Thái Lan thông báo Học bổng Thạc sĩ, Tiến sĩ ngành Công nghệ thông tin năm 2021</p>
                </li>
                <li>
                   <div class="date">
                        <i class="fas fa-calendar-alt"></i>
                        <span>19 - 02 - 2021</span> 
                    </div> 
                    <p>Trường Đại học Mahidol, Thái Lan thông báo Học bổng Thạc sĩ, Tiến sĩ ngành Công nghệ thông tin năm 2021</p>
                </li>
                <li>
                   <div class="date">
                        <i class="fas fa-calendar-alt"></i>
                        <span>19 - 02 - 2021</span> 
                    </div> 
                    <p>Trường Đại học Mahidol, Thái Lan thông báo Học bổng Thạc sĩ, Tiến sĩ ngành Công nghệ thông tin năm 2021</p>
                </li>
            </ul>
        </div>
        <a href="#" class="see-all">
            Xem tất cả
            <i class="fas fa-arrow-right "></i>
        </a>
        <div class="border-line">
            
        </div>
    </div>
 </div>



<div class="main-block">
	<ul>
		@foreach($all_top_news as $value_atnews)
		<li class="img-main-li-1 line-1-main">
			<div class="img-main-block">
				<img src="{{ asset('./public/uploads/Cms_img/'.$value_atnews->Avatar)}}">
				<div class="content-img-main">
					<div class="title-img-main">
						<h3 style="background: {{$value_atnews->Color_bl}}">{{$value_atnews->Name_l0}}</h3>
					</div>
					<a href="{{URL::to('thong-tin-chi-tiet/'.$value_atnews->Slug)}}"><p>{{$value_atnews->Title_l0}}</p></a>
				</div>
				<div class="mang-den"></div>
			</div>
		</li> 
		@endforeach	
	</ul>
</div>

<div class="ngoai-khoa">
	<div class="title-ngoai-khoa">
		<h3>Hoạt động ngoại khoá</h3>
	</div>
	<div class="div-3-block">
		@foreach($all_hdnk as $value_hdnk)
		<div class="block-3bl block-1">
			<div class="img-bl">
				<a href="{{URL::to('thong-tin-chi-tiet/'.$value_hdnk->Slug)}}"><img src="{{ asset('./public/uploads/Cms_img/'.$value_hdnk->Avatar)}}"></a>
	 		</div>
			<p class="title-bl"><a href="{{URL::to('thong-tin-chi-tiet/'.$value_hdnk->Slug)}}">{{$value_hdnk->Title_l0}}</a></p>
			<p class="day-bl">{{date('d/m/Y', strtotime($value_hdnk->Date))}}</p>
			<p class="content-bl">{{$value_hdnk->SimpleContent_l0}}</p>
			<div class="detail-bl">
				<i class="fas fa-angle-double-right ic-detail-left"></i>
				<a href="{{URL::to('thong-tin-chi-tiet/'.$value_hdnk->Slug)}}">Chi tiết</a>
				<i class="fas fa-angle-double-right ic-detail-right"></i>
			</div>
		</div>	
		@endforeach	
	</div>
</div>

<div class="list-div-block">
	<div class="ldbl ldbl-1">
		<div class="title-ldbl">
			<h3>Tin tức ngành</h3>
		</div>
		<div class="img-ldbl">
			<a href="{{URL::to('thong-tin-chi-tiet/'.$all_tintucnganh_hot->Slug)}}"><img src="{{ asset('./public/uploads/Cms_img/'.$all_tintucnganh_hot->Avatar)}}"></a>
		</div>
		<p class="text-tt-ldbl"><a href="{{URL::to('thong-tin-chi-tiet/'.$all_tintucnganh_hot->Slug)}}">{{$all_tintucnganh_hot->Title_l0}}</a></p>
		<p class="day-ldbl">{{date('d/m/Y', strtotime($all_tintucnganh_hot->Date))}}</p>
		<ul>
			@foreach($all_tintucnganh as $value_tintucnganh)
			<li>
				<div class="img-li-ldbl">
					<a href="{{URL::to('thong-tin-chi-tiet/'.$value_tintucnganh->Slug)}}"><img src="{{ asset('./public/uploads/Cms_img/'.$value_tintucnganh->Avatar)}}"></a>
				</div>
				<div class="content-li-ldbl">
					<p class="ct-li-ldbl"><a href="{{URL::to('thong-tin-chi-tiet/'.$value_tintucnganh->Slug)}}">{{$value_tintucnganh->Title_l0}}</a></p>
					<p class="day-li-ldbl">{{date('d/m/Y', strtotime($value_tintucnganh->Date))}}</p>
				</div>
			</li>
			@endforeach
		</ul>
	</div>
	<div class="ldbl ldbl-2">
		<div class="title-ldbl">
			<h3>Góc kỹ năng</h3>
		</div>
		<div class="img-ldbl">
			<a href="{{URL::to('thong-tin-chi-tiet/'.$all_gockynang_hot->Slug)}}"><img src="{{ asset('./public/uploads/Cms_img/'.$all_gockynang_hot->Avatar)}}"></a>
		</div>
		<p class="text-tt-ldbl"><a href="{{URL::to('thong-tin-chi-tiet/'.$all_gockynang_hot->Slug)}}">{{$all_gockynang_hot->Title_l0}}</a></p>
		<p class="day-ldbl">{{date('d/m/Y', strtotime($all_gockynang_hot->Date))}}</p>
		<ul>
			@foreach($all_gockynang as $value_gockynang)
			<li>
				<div class="img-li-ldbl">
					<a href="{{URL::to('thong-tin-chi-tiet/'.$value_gockynang->Slug)}}"><img src="{{ asset('./public/uploads/Cms_img/'.$value_gockynang->Avatar)}}"></a>
				</div>
				<div class="content-li-ldbl">
					<p class="ct-li-ldbl"><a href="{{URL::to('thong-tin-chi-tiet/'.$value_gockynang->Slug)}}">{{$value_gockynang->Title_l0}}</a></p>
					<p class="day-li-ldbl">{{date('d/m/Y', strtotime($value_gockynang->Date))}}</p>
				</div>
			</li>
			@endforeach
		</ul>
	</div>
	<div class="ldbl ldbl-3">
		<div class="title-ldbl">
			<h3>Nghiên cứu khoa học</h3>
		</div>
		<div class="img-ldbl">
			<a href="{{URL::to('thong-tin-chi-tiet/'.$all_nghiencuukhoahoc_hot->Slug)}}"><img src="{{ asset('./public/uploads/Cms_img/'.$all_nghiencuukhoahoc_hot->Avatar)}}"></a>
		</div>
		<p class="text-tt-ldbl"><a href="{{URL::to('thong-tin-chi-tiet/'.$all_nghiencuukhoahoc_hot->Slug)}}">{{$all_nghiencuukhoahoc_hot->Title_l0}}</a></p>
		<p class="day-ldbl">{{date('d/m/Y', strtotime($all_nghiencuukhoahoc_hot->Date))}}</p>
		<ul>
			@foreach($all_nghiencuukhoahoc as $value_nghiencuukhoahoc)
			<li>
				<div class="img-li-ldbl">
					<a href="{{URL::to('thong-tin-chi-tiet/'.$value_nghiencuukhoahoc->Slug)}}"><img src="{{ asset('./public/uploads/Cms_img/'.$value_nghiencuukhoahoc->Avatar)}}"></a>
				</div>
				<div class="content-li-ldbl">
					<p class="ct-li-ldbl"><a href="{{URL::to('thong-tin-chi-tiet/'.$value_nghiencuukhoahoc->Slug)}}">{{$value_nghiencuukhoahoc->Title_l0}}</a></p>
					<p class="day-li-ldbl">{{date('d/m/Y', strtotime($value_nghiencuukhoahoc->Date))}}</p>
				</div>
			</li>
			@endforeach
		</ul>
	</div>
</div>
@endsection

