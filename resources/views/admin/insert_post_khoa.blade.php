@extends('admin_layout')
@section('admin_content') 

<div class="top-dang-bai-viet">
	<p>Đăng bài biết Khoa</p>
</div>

<form action="{{URL::to('./insertdata-khoa')}}" enctype="multipart/form-data" method="post" data-parsley-validate>
	{{ csrf_field() }}
	<div class="postttt">
		<div class="post">
			<div class="top-post">
				<ul>
					<li class="tabLink active" onclick="newtabtitle_admin(event, 1)">
						<p>Tổng quan</p>
					</li>
					<li class="tabLink" onclick="newtabtitle_admin(event, 2)">
						<p>Nội dung Tiếng Việt</p>
					</li>
					<li class="tabLink" onclick="newtabtitle_admin(event, 3)">
						<p>Nội dung Tiếng Anh</p>
					</li>
					<li class="tabLink" onclick="newtabtitle_admin(event, 4)">
						<p>Nội dung Tiếng Korea</p>
					</li>
				</ul>
			</div>
			<div class="bottom-post post-1 activebp">
				<div class="displaypost tablepost">
					<table>
						<tr>
							<td class="texttbbt tieude">Tiêu đề bài viết</td>
							<td><input type="text" name="title_post" id="ip_tieude" required="" onkeyup="auto_slug()"></td>
						</tr>
						<tr>
							<td class="texttbbt">Slug</td>
							<td><input type="text" name="slug_post" required="" id="ip_slug"></td>
						</tr> 
						<tr>
							<td class="texttbbt">Nằm trong thư mục</td>
							<td>
								<input type="hidden" name="category_post" value="" id="hddanhmuc" required="" uired="">
								<ul class="list-danh-muc">
									@foreach($cateAll as $value_cateall)
									@if($value_cateall->hasChild == 0)
									<li>
										<p data-value="{{$value_cateall->CategoryID}}">{{$value_cateall->Name_l0}}</p>
									</li>
									@endif
									@endforeach
								</ul>
							</td>
						</tr> 
						<tr>
							<td class="texttbbt">Thư mục đang chọn</td>
							<td><input type="text" id="thumucdc" name="tmdc" disabled="" required=""></td>
						</tr>
						<tr>
							<td class="texttbbt">Ảnh đại diện</td>
							<td>
								<div class="show-img-anhdd">
									<img id="imgPrime" src="{{ asset('./public/Images/home/logofooter.png')}}" alt="uploaded image placeholder" />
								</div>
								<div id="userActions">
									<p>Drag &amp; Drop Image</p>
									<input type="file" name="anhdaidienimg" id="fileUpload" />
								</div>
							</td>
						</tr>

						<tr>
							<td class="texttbbt trangthai">Trạng thái bài viết</td>
							<td>
								<select name="status_post">
									<option value="1">Xuất bản (đã được kiểm duyệt)</option>
									<option value="0">Chưa được kiểm duyệt</option>
								</select>
							</td>
						</tr>
						<tr>
							<td class="texttbbt">Tin quan trọng</td>
							<td>
								<select name="quantrong_post" class="quantrongsl">
									<option value="0">Bình thường</option>
									<option value="1">Rất nổi bật</option>
								</select>
							</td>
						</tr>
					</table>
				</div>

				<div class="displaypost upload-img-post">
					1
				</div>				

			</div>

			<div class="bottom-post tab-tv">			
				<div class="content-text-tv">
					<textarea class="form-control" id="ckeditor" name="content_vn_post" style="height: 700px;"  required="" placeholder=""></textarea>
				</div>
				<div class="simple-content">
					<p>Simple Content</p>
					<textarea name="simple_content_post" id="area_simpleconten" required=""></textarea>
				</div>
				<div class="hash-tag">
					<p>Hash-tag: ( Các Hash-tag ngăn cách nhau bởi dấu ' , ' )</p>
					<input type="text" id="hashtaged" name="hashtag" required="">
				</div>
			</div> 

			<div class="bottom-post">
				day la botoom 3 
			</div>
			<div class="bottom-post">
				day la botoom 4
			</div>


			<script type="text/javascript">
				$('.list-danh-muc > li > p').on('click', function() {
					var datadmcl = this.dataset.value;
					(this).classList.toggle('ocldm');
					$('#hddanhmuc').val(datadmcl);
					var namedmcl = $(this).text();
					$('#thumucdc').val(namedmcl);
				});
			</script>

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
			<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>


			<script type="text/javascript" src="{{ asset('./public/Js/titletab_admin.js')}}"></script>
		</div>
	</div>

	<input type="submit" id="submitpost" name="submit" value="Đăng bài">
</form>

<script type="text/javascript" src="{{ asset('./public/Js/custom.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('./public/Js/ckeditor/ckeditor.js')}}"></script>

<script type="text/javascript">
	CKEDITOR.replace('ckeditor',{

		filebrowserImageUploadUrl : "{{url('upload-ckeditor?_token='.csrf_token())}}",
		filebrowserBrowseUrl : "{{url('file-browser?_token='.csrf_token())}}",
		filebrowserUploadMethod : 'form' 

	});


</script>
@endsection
