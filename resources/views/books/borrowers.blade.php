@extends('layouts.app')

@section('content')

<div class="container">
	<div class="col-sm-10 col-sm-offset-1">
		@if(session('success'))
                <div class="alert alert-success alert-dismissible fade in">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Success!</strong> {{ session('success') }}
                </div>
        @endif
		<div class="row">
			<div class="col-md-6" style="font-size: 20px;">
				All Borrowers
			</div>
			<div class="col-md-6">
				<form id="search_form" method="GET" action="{{ route('search.borrowers') }}">
					<input type="text" name="quary" class="form-control input-sm pull-right" style="width: 200px;" placeholder="Search">
					<button class="btn btn-sm btn-primary pull-right"><i class="fas fa-search"></i></button>
				</form>
			</div>
		</div>
		<hr>
		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th style="width:30%; ">Book</th>
					<th style="width:11%; ">Firstname</th>
					<th style="width:11%; ">Lastname</th>
					<th style="width:11%; ">Address</th>
					<th style="width:11%; ">Contact</th>
					<th style="width:11%; ">Date Borrowed</th>
					<th style="width:11%; ">Deadline</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($borrowers as $row)
					<tr @if(session('isNew') == $row->id) style="font-weight: bold; color: #ff890fe6;" @endif>
						<td>{{$row->book->title}}</td>
						<td>{{$row->firstname}}</td>
						<td>{{$row->lastname}}</td>
						<td>{{$row->address}}</td>
						<td>{{$row->contact }}</td>
						<td>{{date('F d, Y',strtotime($row->created_at) )}}</td>
						<td>{{date('F d, Y',strtotime($row->deadline) )}}</td>
						<td>
							<form method="POST" action="{{ route('destroy.borrow.book', $row->id) }}">
								<button class="btn btn-xs btn-primary"><i class="fas fa-reply"></i> Return</button>
								<input type="hidden" name="_token" value="{{ Session::token() }}">
                                {{ method_field('DELETE') }}
							</form>
						 	<a href="{{ route('edit.borrow.book', $row->id) }}" class="btn btn-xs btn-default"><i class="fas fa-edit"></i> Edit</a></td>
					</tr>
				@endforeach
			</tbody>
		</table>
		{{ $borrowers->links() }}
	</div>
</div>

@endsection
