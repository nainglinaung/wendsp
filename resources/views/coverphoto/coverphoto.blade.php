@extends('master')

@section('content')
<div class="list-title">
        <span>Cover Image</span>
 </div>
 <form action="{{route('cover_image_add')}}" method="POST" enctype="multipart/form-data">
<div class="col-md-3">



	<div class="form-group">
    <label for="cover_image_name">Name:</label>
    <input type="text" class="form-control" id="cover_image_name" name="cover_image_name">
    	{{ csrf_field() }}
    </div>

    <div class="form-group">
    <label class="control-label">Select File</label>
     <input id="input-2" name="cover_image_source" type="file" class="file" multiple data-show-upload="false" data-show-caption="true">
    </div>

    <button type="submit" class="btn btn-default" style="margin-top:20px;">Add Cover Image</button>
</div>
</form>

<div class="col-md-9">
<table class="table">
	<thead>
	<tr>
	<th>#</th>
	<th>Name</th>
	<th>Source</th>
	<th>Action</th>
	</tr>
	</thead>

	<tbody>
	@foreach($coverphotos as $coverphoto)
	<tr>
	<td>{{$coverphoto->cover_image_id}}</td>
	<td>{{$coverphoto->cover_image_name}}</td>
	<td><img src="../../cover_image/{{$coverphoto->cover_image_source}}" width="50" height="50"></td>
	<td><a href="/admin/cover_image/delete/{{$coverphoto->cover_image_id}}"><span class="glyphicon glyphicon-trash text-danger"></span></a></td>
	</tr>
	@endforeach
	</tbody>


</table>
</div>
@stop


@section('script')
<script src="../../js/jquery.min.js"></script>
<script src="../../js/fileinput.js"></script>
<script src="../../js/bootstrap.min.js"></script>


@stop