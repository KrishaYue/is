@extends('layouts.app')

@section('styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/borrow.css') }}">
    <link href="{{ asset('css/parsley.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="container">
	<div class="col-md-10 col-md-offset-1">
		@if($errors->has('firstname'))
			{{ $errors->first('firstname') }}
		@endif
		@if($errors->has('lastname'))
			{{ $errors->first('larstname') }}
		@endif
		@if($errors->has('address'))
			{{ $errors->first('address') }}
		@endif
		@if($errors->has('contact'))
			{{ $errors->first('contact') }}
		@endif
		@if($errors->has('deadline'))
			{{ $errors->first('deadline') }}
		@endif
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="row">
					<div class="col-md-4">
						<img class="book-pic" src="{{ asset('book-pic.jpg') }}">
					</div>
					<div class="col-md-8">

						<div class="book-info">
							<strong class="book-title">{{ $book->title }}</strong>
							<div class="book-author">
								<p><strong class="small">Author(s): </strong>{{ $book->author }}</p>
							</div>
							<div class="row">
								<div class="col-md-5">
									<div class="book-year">
										<p><strong class="small">Year Published: </strong>{{ $book->year_published }}</p>
									</div>
									<div class="book-qr">
										<img src="data:image/png;base64, {{base64_encode(QrCode::format('png')->size(100)->generate(url('book/').'/'.$book->id))}} ">
									</div>
								</div>
								<div class="col-md-7">
									<hr>
									<p>Borrower Info: </p>
									<div class="borrower-info">
										<form action="{{ route('borrow.book') }}" method="POST" data-parsley-validate="parsley">
											{{ csrf_field() }}
											<input type="hidden" name="book_id" value="{{ $book->id }}">
											<input type="text" name="firstname" class="form-control input-sm form-group" value="{{ old('firstname') }}" required data-parsley-maxlength="255" data-parsley-required-message="Firstname is required" placeholder="Firstname">
											<input type="text" name="lastname" class="form-control input-sm form-group" value="{{ old('lastname') }}" required data-parsley-maxlength="255" data-parsley-required-message="Lastname is required" placeholder="Lastname">
											<input type="text" name="address" class="form-control input-sm form-group" value="{{ old('address') }}" required data-parsley-maxlength="255" data-parsley-required-message="Address is required" placeholder="Address">
											<input type="text" name="contact" class="form-control input-sm form-group" value="{{ old('contact') }}" required data-parsley-maxlength="25" data-parsley-required-message="Contact is required" placeholder="Contact Number">
											<input type="date" name="deadline" class="form-control input-sm form-group" value="{{ old('deadline') }}" required data-parsley-required-message="Deadline is required">
											<button class="btn btn-sm btn-success pull-right"><i class="fas fa-save"></i> Save</button>
										</form>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')
      <script src="{{ asset('js/parsley.min.js') }}"></script>
@endsection