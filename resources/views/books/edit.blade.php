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
                  
                    <form class="form-horizontal" method="POST" id="create_form" data-parsley-validate="parsley" enctype="multipart/form-data">

                      <div class="form-group">                       
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
                        <label class="control-label col-sm-2" for="date">Year:</label>
                        <div class="col-sm-8">
                          
                            <select class="form-control" name="year_published" required data-parsley-required-message="Year published is required" >
                              @for($year = 1900; $year <= date("Y"); $year++)
                                  <?php echo '<option value="'.$year.'" '.(($year==$book->year_published)?'selected="selected"':"").'>'.$year.'</option>'; ?>
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
                            <input type="checkbox" name="available" id="availability" @if($book->availability == 1) checked @endif>Yes
                          </div>
 
                      </div>
                      <div class="form-group">
                        <label class="control-label col-sm-2" for="availability">With CD:</label>
            
                          <div class="checkbox" id="available" >                        
                            <input type="checkbox" name="cd" id="availability" @if($book->with_cd == 1) checked @endif>Yes
                          </div>
 
                      </div>
                      <div class="form-group">
                        <label class="control-label col-sm-2" for="bookpic">Book Picture:</label>
                        <div class="col-sm-8">
                          <input type="file" name="bookpic" class="form-group col-sm-8">
                        </div>
                      </div>
                      @if ($errors->has('bookpic'))
                                    <span class="col-md-offset-2">
                                        <strong class="err-msg">{{ $errors->first('bookpic') }}</strong>
                                    </span>
                      @endif
                      
                      <div class="form-group">
                        <label class="control-label col-sm-2" for="bookpic"></label>
                        <div class="col-sm-8">
                          @if($book->image == '')
                              <img src=" {{ asset('default-book.jpg') }} " width="200" height="200">
                          @else
                              <img class="zoom" src=" {{ asset('images/' . $book->image) }} " width="200" height="200" data-toggle="modal" data-target="#myModal">
                          @endif

                                <!-- Modal -->
                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-light">&times;</span></button>
                                      </div>
                                      <div class="modal-body" >
                                        <div class="row">
                                            <div class="col-md-offset-1">
                                                @if($book->image == '')
                                                    <img src=" {{ asset('default-book.jpg') }} " width="600" height="600">
                                                @else
                                                    <img src=" {{ asset('images/' . $book->image) }} " width="600" height="600" >
                                                @endif
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div> 
                        </div>
                      </div>
                      
                        

                      <input type="hidden" name="_token" value="{{ Session::token() }}">
              		  {{ method_field('PUT') }}                 
                    </form>

                    <!-- Split button -->
                      <div class="btn-group btn-float-right">
                        <button type="submit" class="btn btn-success btn-sm" form="create_form" formaction="{{ route('book.update', $book->id) }}" ><i class="fas fa-save"></i> Submit</button>
                        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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