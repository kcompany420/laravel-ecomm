@extends('admin.partials.app')
@section('content')
	

		<div class="col-md-12">
			@section('breadcrumb')
			<nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.category.index')}}">Categoary</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add/Edit Categoary</li>
                </ol>
            </nav>
			@endsection
			<br>
			<h2>Create Category</h2>
			<form method="post" action="@if(isset($category)) {{route('admin.category.update',$category->id)}} @else {{route('admin.category.store')}} @endif">
				@csrf
			@if(isset($category))
				@method('PUT')
			@endif
						@include('admin.partials.error')
  
			  <div class="form-group">
			    <label for="exampleInputEmail1">Title:</label>
			    <input type="text" class="form-control" value="{{@$category->title}}" id="txturl" name="title" aria-describedby="emailHelp" placeholder="Enter Category">
			    <small id="emailHelp" class="form-text text-muted">{{config('app.url')}}<span id="url">{{@$category->slug}}</span></small>
			    <input type="hidden" name="slug" id="slug" value="{{$category->slug}}">
			  </div>
			   <div class="form-group">
   				 <label for="exampleFormControlTextarea1">Description:</label>
   				 <textarea class="form-control" name="description" id="editor" rows="6">{!!@$category->description!!}</textarea>
 				</div>
				@php
					$ids = (isset($category->childerns) && $category->childerns->count() > 0) ? array_pluck($category->childerns,'id') : null
				@endphp
				{{-- {{dd($ids)}} --}}
 				<div class="form-group">
   				 <label for="exampleFormControlTextarea1">Select Category:</label>
				<select class="custom-select form-control" id="parent_id" class="form-control" name="parent_id[]" multiple>
					@if($categories)
				  <option value="0">Top Level</option>
					option
					@foreach ($categories as $cat)
				  <option value="{{$cat->id}}" @if(!is_null($ids) && in_array($cat->id,$ids)) {{'selected'}} @endif>{{$cat->title}}</option>
					@endforeach
				  @endif
				  option
				</select>	
				</div>
				@if(isset($category))
			  <button type="submit" class="btn btn-primary">Update</button>
			  @else
			  <button type="submit" class="btn btn-primary">Submit</button>
			@endif
			</form>
		</div>
	
	</div>
@endsection
@section('scripts')
<script src="./node_modules/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
<script>
	// $(function(){
		ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .then( editor => {
            window.editor = editor;
        } )
        .catch( err => {
            console.error( err.stack );
        } );
	// });

	$('#parent_id').select2({
		placeholder:"select a Parent Category",
		allowClear:true,
		minimumResultsForSearch:Infinity
	});
    	
    $('#txturl').on('keyup',function(){
    	var url = slugify($(this).val());
    	$('#url').html(url);
    	$('#slug').val(url);
    })	

</script> 
@endsection