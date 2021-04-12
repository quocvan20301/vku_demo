@extends('admin_layout')
@section('admin_content') 

<div class="top-dang-bai-viet">
	<p>Sửa bài biết</p>
</div>

<form action="{{URL::to('./editdata/'.$post_edit->CmsID)}}" enctype="multipart/form-data" method="post" data-parsley-validate>
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
							<td><input type="text" name="title_post" id="ip_tieude" onkeyup="auto_slug()" value="{{$post_edit->Title_l0}}"></td>
						</tr>
						<tr>
							<td class="texttbbt">Slug</td>
							<td><input type="text" name="slug_post" id="ip_slug" value="{{$post_edit->Slug}}"></td>
						</tr>
						<tr>
							<td class="texttbbt">Xuất hiện ở Khoa:</td>
							<td>
								@foreach($all_khoa as $value_allkhoa)
								<ul>
									<li style="float: left;">
										<input type="checkbox" name="all_khoa[]" value="{{$value_allkhoa->id_khoa}}" 
										<?php foreach ($post_showcare as $show) {
											if($show->id_khoa==$value_allkhoa->id_khoa)
												echo 'checked';
										}
										 ?>
										<font>{{$value_allkhoa->id_khoa}}</font>
									</li>
								</ul>
								@endforeach
							</td>
						</tr>
						<tr>
							<td class="texttbbt">Nằm trong thư mục</td>
							<td>
								<input type="hidden" name="category_post" value="{{$post_edit->CategoryID}}" id="hddanhmuc" required="">
								<ul class="list-danh-muc">
									<li><label>Giới thiệu</label>
										<i class="icon-menu fas fa-chevron-right"></i>
										<ul class="sub-menu">
											<li><p data-value="220">Giới thiệu khoa</p></li>
											<li><p data-value="221">Thế mạnh của khoa</p></li>
											<li><p data-value="222">Đội ngũ CB_GV</p></li>
											<li><p data-value="223">Thông tin liên hệ</p></li>
										</ul>
									</li>
									<li><label>Ngành đào tạo</label>
										<i class="icon-menu fas fa-chevron-right"></i>
										<ul class="sub-menu">
											<li><p data-value="224">Chương trình đào tạo</p></li>
											<li><p data-value="225">Danh sách môn học</p></li>
										</ul>
									</li>
									<li><label>Tuyển sinh</label>
										<i class="icon-menu fas fa-chevron-right"></i>
										<ul class="sub-menu">
											<li><p data-value="226">Tuyển sinh</p></li>
										</ul>
									</li>
									<li><label>Tin tức - sự kiện</label>
										<i class="icon-menu fas fa-chevron-right"></i>
										<ul class="sub-menu">
											<li><p data-value="227">Thông tin - thông báo</p></li>
											<li><p data-value="228">Hoạt động ngoại khoá</p></li>
											<li><p data-value="230">Tin tức ngành</p></li>
										</ul>
									</li>
									<li><label>Nghiên cứu khoa học</label>
										<i class="icon-menu fas fa-chevron-right"></i>
										<ul class="sub-menu">
											<li><p data-value="231">Nghiên cứu khoa học</p></li>
										</ul>
									</li>
									<li><label>Sinh viên</label>
										<i class="icon-menu fas fa-chevron-right"></i>
										<ul class="sub-menu">
											<li><p data-value="234">Góc kỹ năng</p></li>
										</ul>
									</li>
								</ul>
							</td>
						</tr>
						<tr>
							<td class="texttbbt">Thư mục đang chọn</td>
							<td><input type="text" id="thumucdc" name="tmdc" required="" value="{{$post_cate->Name_l0}}"></td>
						</tr>
						<tr>
							<td class="texttbbt">Ảnh đại diện</td>
							<td>
								<div class="show-img-anhdd">
									<img id="imgPrime" src="{{ asset('./public/uploads/Cms_img/'.$post_edit->Avatar)}}" alt="uploaded image placeholder" />
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
									<option value="1" <?php if($post_edit->Status == "1") { echo "selected"; } ?> >Xuất bản (đã được kiểm duyệt)</option>
									<option value="0" <?php if($post_edit->Status == "0") { echo "selected"; } ?> >Chưa được kiểm duyệt</option>
								</select>
							</td>
						</tr>
						<tr>
							<td class="texttbbt">Tin quan trọng</td>
							<td>
								<select name="quantrong_post" class="quantrongsl">
									<option value="0" <?php if($post_edit->Event == "0") { echo "selected"; } ?> >Bình thường</option>
									<option value="1" <?php if($post_edit->Event == "1") { echo "selected"; } ?> >Rất nổi bật</option>
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
					<textarea class="form-control" rows="5" id="ckeditor" name="content_vn_post" required="" placeholder="" >{{$post_edit->Content_l0}}</textarea>
				</div>
				<div class="simple-content">
					<p>Simple Content</p>
					<textarea name="simple_content_post" id="area_simpleconten" required="">
						{{$post_edit->SimpleContent_l0}}
					</textarea>
				</div>
				<div class="hash-tag">
					<p>Hash-tag: (Các Hash-tag ngăn cách nhau bởi dấu ' , ')</p>
					<input type="text" name="hashtag" 
					value=" 
					<?php
						foreach($post_hastag as $value_post_hashtag) {
							echo $value_post_hashtag->name_tags." ,";
						}
					?> " 
					required="">
				</div>

			</div> 

			<div class="bottom-post">
				day la botoom 3 
			</div>
			<div class="bottom-post">
				day la botoom 4
			</div>

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
			<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>


			<script type="text/javascript" src="{{ asset('./public/Js/titletab_admin.js')}}"></script>
		</div>
	</div>

	<input type="submit" id="submiteditpost" name="submit" value="Sửa bài">
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