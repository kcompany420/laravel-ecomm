  @extends('admin.partials.app')
@section('content')
	
	
	<div class="col-md-12">
    @section('breadcrumb')
    <nav aria-label="breadcrumb">
                <ol class="breadcrumb">

                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Categroy</li>


                </ol>
    @endsection
	<br>	
	<a href="{{route('admin.category.create')}}" class="btn btn-outline-primary float-md-right">Add Category</a>
	<h2>Category List</h2>
  @include('admin.partials.error')
	<hr>
	<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">slug</th>
      <th scope="col">Categories</th>
      <th scope="col">Created At</th>
      <th>Actions</th>

    </tr>
  </thead>
  <tbody>
  	@if ($categories)
  		@foreach($categories as $category)
    <tr>
      <th scope="row">{{$category->id}}</th>
      <td>{{$category->title}}</td>
      <td>{!! $category->description !!}</td>
      <td>{{$category->slug}}</td>
      <td>
      	@if($category->childerns->count() > 0)
      		@foreach($category->childerns as $childcategory)
      		{{$childcategory->title}},
      		@endforeach
      	@else
      	<strong>{{"Parent Category"}}</strong>
      	@endif
      </td>
      <td>{{$category->created_at}}</td>
      <td><a href="{{route('admin.category.edit',$category->id)}}" class="btn btn-warning btn-sm">Edit</a> | <a href="javascript:;" onclick="confirmDelete('{{$category->id}}')" id="confirmdelete" class="btn btn-danger btn-sm">Delete</a>
      <form id="delete-category-{{$category->id}}" action="{{route('admin.category.destroy',$category->id)}}" method="POST">
        
        @csrf
        @method('DELETE')
      </form>
      </td>
    </tr>
    @endforeach
    	@else
    	<tr>
    		<td colspan="5">Not Categories Found !!!</td>
    	</tr>
    @endif


  </tbody>
</table>
  {{$categories->links()}}
	</div>
  
@endsection

@section('scripts')

<script>
  
  function confirmDelete(id){

    let choice = confirm("Are You Agree To Delete ?");
    if(choice)
    {
      document.getElementById('delete-category-'+id).submit();
    }

  }

</script>

@endsection