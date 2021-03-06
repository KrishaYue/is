@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
@endsection

@section('content')

<div class="container">
	<div class="col-sm-10 col-sm-offset-1">
		<h1>All Borrowed Books</h1>
		<hr>
		<table class="table table-hover table-striped" id="indextable">
			<thead>
				<tr>
					<th style="width:5%; ">Book ID</th>
					<th style="width:20%; ">Title</th>
					<th style="width:11%; ">Author</th>
					<th style="width:5%; ">With CD</th>
					<th style="width:11%; ">Year Published</th>
					<th>Borrower</th>
					<th style="width:11%; ">Date Borrowed</th>
					<th style="width:11%; ">Deadline</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($books as $book)
					<tr @if(session('isNew') == $book->id) style="font-weight: bold; color: #ff890fe6;" @endif>
						<td>{{$book->id}}</td>
						<td>{{$book->title}}</td>
						<td>{{(strlen($book->author) >= 15) ? substr($book->author, 0, 15). '...' : $book->author}}</td>
						<td>{{ ($book->with_cd) == 0 ? 'No':'Yes' }}</td>
						<td>{{$book->year_published }}</td>
						<td>{{ $book->borrower->firstname. ' ' . $book->borrower->lastname }}</td>
						<td>{{ date('F d, Y',strtotime($book->borrower->created_at) ) }}</td>
						<td>{{ date('F d, Y',strtotime($book->borrower->deadline) ) }}</td>
						<td>
							<form method="POST" action="{{ route('destroy.borrow.book', $book->borrower->id) }}">
								<button class="btn btn-xs btn-primary"><i class="fas fa-reply"></i> Return</button>
								<input type="hidden" name="_token" value="{{ Session::token() }}">
                                {{ method_field('DELETE') }}
							</form>
						 	<a href="{{ route('edit.borrow.book', $book->borrower->id) }}" class="btn btn-xs btn-default"><i class="fas fa-edit"></i> Edit</a></td>

					</tr>
				@endforeach
			</tbody>
		</table>
		{{ $books->links() }}
	</div>
</div>

@endsection

@section('scripts')
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
  <script>
    $(document).ready(function() {
    $('#indextable').DataTable();
    } );
  </script>
@endsection