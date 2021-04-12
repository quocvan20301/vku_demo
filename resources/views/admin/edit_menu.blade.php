@extends('admin_layout')
@section('admin_content')

<script type="text/javascript">
	
	function editParent(idParent, nameEdit) {
		var url = "{{ URL::to('admin/edit-parent')}}";
		$.ajax({
			url: url,
			type: 'GET',
			cache: false,
			data: {idParent: idParent, nameEdit: nameEdit},
			success: function(data) {
				if (data != null) {
					location.reload();
				}   
			}
		});
	}

	function insertParent(nameParent) {
		var url = "{{ URL::to('admin/insert-parent')}}";
		$.ajax({
			url: url,
			type: 'GET',
			cache: false,
			data: {nameParent: nameParent},
			success: function(data) {
				if (data != null) {
					alert(data);
					location.reload();
				}   
			}
		});
	}

	function deleteParent(idParent) {
		var url = "{{ URL::to('admin/delete-parent')}}";
		$.ajax({
			url: url,
			type: 'GET',
			cache: false,
			data: {idParent: idParent},
			success: function(data) {
				if (data != null) {
					location.reload();
				}   
			}
		});
	}

	function insertChild(idChild, namechild) {
		var url = "{{ URL::to('admin/insert-child')}}";
		$.ajax({
			url: url,
			type: 'GET',
			cache: false,
			data: {idChild: idChild, namechild: namechild},
			success: function(data) {
				if (data != null) {
					location.reload();
				}   
			}
		});
	}

	function deleteChild(idChild) {
		var url = "{{ URL::to('admin/delete-child')}}";
		$.ajax({
			url: url,
			type: 'GET',
			cache: false,
			data: {idChild: idChild},
			success: function(data) {
				if (data != null) {
					location.reload();
				}   
			}
		});
	}

</script>

<div class="top-dang-bai-viet">
	<p>Edit Menu</p>
</div>
<div class="edmenu">

	<!-- <ul id="Parent">
		<li id="1">
			<input type="text" name="" value="Parent1">
			<h3 id="deleteele">Delete</h3>
			<h3 id="addele"  data-value="1">Add Child</h3>
			<ul><li><input><h3 id="delechild">Delete</h3></li></ul>
		</li>
		<li id="2">
			<input type="text" name="" value="Parent2">
			<h3 id="deleteele">Delete</h3>
			<h3 id="addele"  data-value="2">Add Child</h3>
		</li>
		<li id="3">
			<input type="text" name="" value="Parent3">
			<h3 id="deleteele">Delete</h3>
			<h3 id="addele"  data-value="3">Add Child</h3>
		</li>
		<li id="4">
			<input type="text" name="" value="Parent4">
			<h3 id="deleteele">Delete</h3>
			<h3 id="addele" data-value="4">Add Child</h3>
		</li>
	</ul> -->

	<ul id="Parent">
		<?php $id = 1; ?>
	@foreach($rs as $valuers)

		@if($valuers->ParentID == 0 && $valuers->hasChild == 0)
		<li id="{{$id}}" data-value="{{$valuers->CategoryID}}">
			<input type="text" name="" value="{{$valuers->Name_l0}}" id="{{'ip'.$id}}" disabled="">
			<h3 id="deleteele" data-value="{{$valuers->CategoryID}}" >Delete</h3>
			<h4 id="{{'saveele'.$id}}" data-id="{{$valuers->CategoryID}}" data-value="{{$id}}">Save</h4>
			<h3 id="editele" data-value="{{$id}}">Edit</h3>
			<h3 id="addChild"  data-id="{{$id}}" data-value="{{$valuers->CategoryID}}">Add Child</h3>
		</li>
		@endif

		@if($valuers->ParentID == 0 && $valuers->hasChild == 1)
		<li id="{{$id}}" data-value="{{$valuers->CategoryID}}">
			<input type="text" name="" value="{{$valuers->Name_l0}}" id="{{'ip'.$id}}" disabled="">
			<h4 id="{{'saveele'.$id}}" data-id="{{$valuers->CategoryID}}" data-value="{{$id}}">Save</h4>
			<h3 id="editele" data-value="{{$id}}">Edit</h3>
			<h3 id="addChild"  data-id="{{$id}}" data-value="{{$valuers->CategoryID}}">Add Child</h3>
			<ul>
				@foreach($all_menu as $value_allmenu)
				@if ($value_allmenu->ParentID == $valuers->CategoryID)
				<li>
					<input value="{{$value_allmenu->Name_l0}}" disabled="">
					<h3 id="delechild" data-value="{{$value_allmenu->CategoryID}}" >Delete</h3>
				</li>
				@endif
				@endforeach
			</ul>
		</li>
		@endif
		<?php $id++; ?>


	@endforeach

	</ul>

	<script type="text/javascript">
		$(document).ready(function() {
			$('.edmenu ul li #deleteele').live('click',function() {

				var idParent = this.dataset.value;

				deleteParent(idParent);

				$(this).parent('li').remove();
			});

			$('.edmenu ul #addEle').live('click',function() {

				var dataAddpr = document.getElementById("inputAddEle").value;

				if (!dataAddpr) {
					alert("Hay nhap ten menu");
				} else {
					insertParent(dataAddpr);
				}

				
			});

			$('.edmenu ul li #editele').live('click',function() {

				var dataPr = this.dataset.value;

				var div = document.getElementById("ip"+dataPr).disabled = false;

				$(this).remove();

				document.getElementById("saveele"+dataPr).style.display = 'inline-block';

			});

			$('.edmenu ul li h4').live('click',function() {

					
				var idPr = this.dataset.value;

				var dataParent = document.getElementById("ip"+idPr).value;

				var idparent = $(this).attr('data-id');

				editParent(idparent, dataParent);

			});

			$('.edmenu ul li #addChild').live('click',function() {
				var p = document.createElement("ul");

				var p1 = document.createElement("li");

				var p2 = document.createElement("input");
				p2.id = "dataaddchildele";

				var p3 = document.createElement("h3");
				var node = document.createTextNode("Add Child");
				p3.appendChild(node);
				p3.id = "addchidele";
				p3.dataset.value = this.dataset.value;

				p1.appendChild(p2);
				p1.appendChild(p3);

				p.appendChild(p1);

				var dataPr = $(this).attr('data-id');

				var div = document.getElementById(dataPr);
				div.appendChild(p);
			});

			$('.edmenu ul #delechild').live('click',function() {
				var idchild = this.dataset.value;
				deleteChild(idchild);
				$(this).parent('li').remove();
			});

			$('.edmenu ul #addchidele').live('click',function() {

				var dataAddpr = document.getElementById("dataaddchildele").value;
				var idAddpr = this.dataset.value;

				if (!dataAddpr) {
					alert("Hay nhap ten menu");
				} else {
					insertChild(idAddpr, dataAddpr);
				}

			});

		});
	</script>

</div>

<p class="addParent" onclick="add_Parent()">Add Menu</p>

<script>
	function add_Parent() {   
		var p = document.createElement("li");

		var p1 = document.createElement("input");
		p1.setAttribute("name", "horse");
		p1.id = "inputAddEle";

		var p2 = document.createElement("h3");
		var node = document.createTextNode("Add");
		p2.id = "addEle";
		p2.appendChild(node);

		p.appendChild(p1);
		p.appendChild(p2);

		var div = document.getElementById("Parent");
		div.appendChild(p);
	}
</script>

@endsection