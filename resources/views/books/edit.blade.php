@extends('layouts.app')

@section('styles')
     <link href="{{ asset('css/create.css') }}" rel="stylesheet">
     <link href="{{ asset('css/parsley.css') }}" rel="stylesheet">
@endsection
            
@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
          @if(session('success'))
                <div class="alert alert-success alert-dismissible fade in">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Success!</strong> {{ session('success') }}
                </div>
          @endif

            <h1>Books <small class="muted">Edit book in the database</small></h1>
            <div class="panel panel-default">
                <div class="panel-body">
                  @if($book->image == '')
                      <img src=" {{ asset('default-profile.png') }} " width="100" height="100">
                    @else
                  <img src=" {{ asset('images/' . $book->image) }} " width="100" height="100">
                    @endif
                    <form class="form-horizontal" method="POST" id="create_form" data-parsley-validate="parsley" enctype="multipart/form-data">
                      <div class="form-group">
                        <input type="file" name="bookpic" class="form-group col-sm-8">
                        <label class="control-label col-sm-2" for="title">Title:</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="title" placeholder="Enter title" name="title" value="{{ $book->title }}" required data-parsley-maxlength="255" data-parsley-required-message="Title is required">
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
                          <input type="text" class="form-control" id="author" placeholder="Enter author" name="author" value="{{ $book->author }}" required data-parsley-maxlength="255" data-parsley-required-message="Author is required">
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
                          
                            <input type="date" class="form-control" id="date" name="date_published" value="{{ $book->date_published }}" required data-parsley-required-message="Date published is required" >
                            @if ($errors->has('date_published'))
                                      <span class="help-block">
                                          <strong class="err-msg">{{ $errors->first('date_published') }}</strong>
                                      </span>
                            @endif
                          
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-sm-2" for="availability">Available:</label>
						
                          <div class="checkbox" id="available" >                        
                            <input type="checkbox" name="available" id="availability" @if($book->availability == 1) checked @endif>Yes
                          </div>
 
                      </div>

                      <input type="hidden" name="_token" value="{{ Session::token() }}">
              		  {{ method_field('PUT') }}                 
                    </form>

                    <!-- Split button -->
                      <div class="btn-group btn-float-right">
                        <button type="submit" class="btn btn-success" form="create_form" formaction="{{ route('book.update', $book->id) }}" >Submit</button>
                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu">
                          <li><button class="btn-link" form="create_form" formaction="{{ route('book.update.view', $book->id) }}" >Submit and View</button></li>
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