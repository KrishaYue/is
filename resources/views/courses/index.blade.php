@extends('layouts.app')

@section('styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/courses.css') }}">
@endsection

@section('content')

<div class="container">
	@if(session('success'))
                <div class="alert alert-success alert-dismissible fade in">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Success!</strong> {{ session('success') }}
                </div>
@endif
	<div class="row">
		<div class="col-sm-7 col-sm-offset-1">
			<h1>Courses</h1>
			<table class="table table-hover">
			    <thead>
			      <tr>
			        <th>ID</th>
			        <th>Name</th>
			        <th>Action</th>
			      </tr>
			    </thead>
			    <tbody>
			     @foreach($courses as $row)
			      <tr>
			        <td>{{ $row->id }}</td>
			        <td>{{ $row->name }}</td>
			        <td><a href="{{ route('course.edit', $row->id) }}" class="btn btn-default btn-xs"><i class="fas fa-edit"></i> Edit</a></td>
			      </tr>

					

			      @endforeach
			    </tbody>
			  </table>
		</div>
		<div class="col-sm-3">
			<div class="create-form">
				<div class="well">
					<form action="{{ route('course.store') }}" method="POST">
						{{ csrf_field() }}
					  <div class="form-group">
					    <label for="name">Course Name:</label>
					    <input type="text" class="form-control input-sm" id="name" name="name" required>
					  </div>
					  <button type="submit" class="btn btn-default btn-sm"><i class="fas fa-plus"></i> Add Course</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection