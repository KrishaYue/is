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

            <h1>Books <small class="muted">Add book in the database</small></h1>
            <div class="panel panel-default">
                <div class="panel-body">

                    <form class="form-horizontal" method="POST" id="create_form" data-parsley-validate="parsley" enctype="multipart/form-data">
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
                          <input type="text" class="form-control" id="author" placeholder="Enter author" name="author" value="{{ old('author') }}" required data-parsley-maxlength="255" data-parsley-required-message="Author is required" style="text-transform: capitalize;">
                          @if ($errors->has('author'))
                                    <span class="help-block">
                                        <strong class="err-msg">{{ $errors->first('author') }}</strong>
                                    </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-sm-2" for="date">Year:</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="year_published" required data-parsley-required-message="Year published is required" >
                              @for($year = date("Y"); $year >= 1900; $year--)
                                  <?php echo '<option value="'.$year.'" '.(($year==old('year_published'))?'selected="selected"':"").'>'.$year.'</option>'; ?>
                              @endfor
                            </select>
                            
                            @if ($errors->has('year_published'))
                                      <span class="help-block">
                                          <strong class="err-msg">{{ $errors->first('year_published') }}</strong>
                                      </span>
                            @endif
                          
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-sm-2" for="availability">Available:</label>

                          <div class="checkbox" id="available" >                        
                            <input type="checkbox" name="available" id="availability">Yes
                          </div>
 
                      </div> 

                      <div class="form-group">
                        <label class="control-label col-sm-2" for="cd">With Cd:</label>

                          <div class="checkbox" id="available" >                        
                            <input type="checkbox" name="cd" id="cd">Yes
                          </div>
 
                      </div> 

                      <div class="form-group">
                       
                        <label class="control-label col-sm-2" for="title">Book Picture:</label>
                        <div class="col-sm-8">
                          <input type="file" name="bookpic" class="form-group col-sm-8">
                        </div>
                      </div>
                      @if ($errors->has('bookpic'))
                                    <span class="col-md-offset-2">
                                        <strong class="err-msg">{{ $errors->first('bookpic') }}</strong>
                                    </span>
                      @endif                
                    </form>

                    <!-- Split button -->
                      <div class="btn-group btn-float-right">
                        <button type="submit" class="btn btn-success btn-sm" form="create_form" formaction="{{ route('book.store') }}" ><i class="fas fa-save"></i> Submit</button>
                        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu">
                          <li><button class="btn-link" form="create_form" formaction="{{ route('book.store.new') }}" >Submit and Add New</button></li>
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