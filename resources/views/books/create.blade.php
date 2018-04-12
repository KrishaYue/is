@extends('layouts.app')

@section('styles')
     <link href="{{ asset('css/create.css') }}" rel="stylesheet">
@endsection
            
@section('content')
<div class="container">

  @if(count($errors) > 0)

                  @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                  @endforeach

            @endif
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h1>Books <small class="muted">Add book in the database</small></h1>
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-horizontal" action="{{ route('book.store') }}" method="POST" id="create_form" >
                       {{ csrf_field() }}
                      <div class="form-group">
                        <label class="control-label col-sm-2" for="title">Title:</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="title" placeholder="Enter title" name="title">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-sm-2" for="author">Author:</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="author" placeholder="Enter author" name="author">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-sm-2" for="date">Date:</label>
                        <div class="col-sm-8">
                          <input type="date" class="form-control" id="date" name="date_published">
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
                          <li><a href="#">Submit and Edit</a></li>
                        </ul>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
