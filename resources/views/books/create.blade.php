@extends('layouts.app')

@section('styles')
     <link href="{{ asset('css/create.css') }}" rel="stylesheet">
     <link href="{{ asset('css/parsley.css') }}" rel="stylesheet">
@endsection
            
@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h1>Books <small class="muted">Add book in the database</small></h1>
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-horizontal" action="{{ route('book.store') }}" method="POST" id="create_form" data-parsley-validate="parsley" >
                       {{ csrf_field() }}
                      <div class="form-group">
                        <label class="control-label col-sm-2" for="title">Title:</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="title" placeholder="Enter title" name="title" value="{{ old('title') }}" required data-parsley-maxlength="255" data-parsley-required-message="Title is required">
                          @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong class="err-msg">{{ $errors->first('title') }}</strong>
                                    </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-sm-2" for="author">Author:</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="author" placeholder="Enter author" name="author" value="{{ old('author') }}" required data-parsley-maxlength="255" data-parsley-required-message="Author is required">
                          @if ($errors->has('author'))
                                    <span class="help-block">
                                        <strong class="err-msg">{{ $errors->first('author') }}</strong>
                                    </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-sm-2" for="date">Date:</label>
                        <div class="col-sm-8">
                          <input type="date" class="form-control" id="date" name="date_published" value="{{ old('date_published') }}" required data-parsley-required-message="Date published is required" >
                          @if ($errors->has('date_published'))
                                    <span class="help-block">
                                        <strong class="err-msg">{{ $errors->first('date_published') }}</strong>
                                    </span>
                          @endif
                        </div>
                      </div>                 
                    </form>
                    <!-- Split button -->
                      <div class="btn-group btn-float-right">
                        <button type="submit" class="btn btn-primary" form="create_form">Submit</button>
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu">
                          <li><a href="#">Submit and View</a></li>
                          <li><a href="#">Submit and Create again</a></li>
                        </ul>
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