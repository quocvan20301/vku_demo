@extends('admin_layout')
@section('admin_content') 	
<div class="all-post">
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<td>ID</td>
				<td>Tiêu đề tin tức</td>
				<td>Chuyên mục</td>
				<td>Khoa</td>
				<td>Trạng thái</td>
				<td colspan="3">Tác vụ</td>
			</tr>
		</thead>
		<tbody>
			@foreach($all_post_khoa as $value_all_post)
			<tr>
				<td>{{$value_all_post->CmsID}}</td>
				<td>{{$value_all_post->Title_l0}}</td>
				<td>{{$value_all_post->Name_l0}}</td>
				<td>{{$value_all_post->List_show_khoa}}</td>
				<td>
					@if($value_all_post->Status == 1) 
					<a href="{{URL::to('eyepost-show/'.$value_all_post->CmsID)}}"><i class="fa fa-toggle-on" style="color: #006400;"> Hiện</i></a>
					@else
					<a href="{{URL::to('eyepost-hide/'.$value_all_post->CmsID)}}"><i class="fa fa-toggle-on" style="color: #696969;"> Ẩn</i></a>
					@endif
				</td>
				<td><a href="{{URL::to('preview-post/'.$value_all_post->CmsID)}}"><i class="fas fa-eye" style="color: #002147;"></i></a></td>
				<td><a href="{{URL::to('edit-post/'.$value_all_post->CmsID)}}"><i class="fas fa-edit" style="color: #28a745;"></i></a></td>
				<td><a href="{{URL::to('delete-post/'.$value_all_post->CmsID)}}"><i class="fas fa-trash-alt" style="color: #dc3545;"></i></a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<div class="post-pagination">
		@if ($currentPage > 1 && $countPage > 1)
		<p class="page-link"><a href="
			{{URL::to('all-post/'.$khtpost.'/'.($currentPage-1))}}"><i class="fas fa-angle-left"></i></a></p>
		@else
		<p class="page-link"><i class="fas fa-angle-left"></i></p>
		@endif

		@if ($currentPage > 4)
			<p class="page-link">...</p>
		@endif

		@for ($i = $currentPage-2; $i <= $currentPage+2; $i ++)

		@if ($i < 1 || $i > $countPage )
		@else
			@if($i == $currentPage)
			<p class="page-link active-bm">{{$i}}</p>
			@else
			<p class="page-link"><a href="{{URL::to('all-post/'.$i)}}">{{$i}}</a></p>
			@endif
		@endif

		@endfor

		@if ($currentPage < $countPage - 2)
			<p class="page-link">...</p>
		@endif


		@if ($currentPage < $countPage && $countPage > 1)
		<p class="page-link"><a href="{{URL::to('all-post/'.($currentPage+1))}}"><i class="fas fa-angle-right"></i></a></p>
		@else
		<p class="page-link"><i class="fas fa-angle-right"></i></p>
		@endif

	</div>
</div>

@endsection