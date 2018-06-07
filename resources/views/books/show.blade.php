@extends('layouts.app')

@section('styles')
     <link href="{{ asset('css/show.css') }}" rel="stylesheet">
     
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
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="row container">
            <div class="col-md-7">
              <div class="border-left">
                <h1 style="display: inline;">{{ $book->title }} </h1><br>
                <label>Author: </label> {{ $book->author }} <br>
                <label>Year Published: </label> {{ $book->year_published }} <br>
                <label>Course: </label> @foreach($courses as $row) @if($row->id == $book->course_id) {{ $row->name }} @endif @endforeach
              </div>
              
              
              <hr>
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
            <div class="col-md-3">
              <div class="well" style="margin-right: 50px;">

                  <dl class="dl-horizontal">
                    <label>Created At:</label>
                    <p class="small">{{ date('M j, Y H:i', strtotime($book->created_at)) }}</p>
                  </dl>

                  <dl class="dl-horizontal">
                    <label>Last Updated:</label>
                    <p class="small">{{ date('M j, Y H:i', strtotime($book->updated_at)) }}</p>
                  </dl>
                  <hr>
                  <dl class="dl-horizontal">
                    <label>Available:</label> @if($book->availability == 1)
                                                  {{ 'Yes' }}
                                                  @else
                                                  {{ 'No' }}
                                                  @endif
                  </dl>
                  <dl class="dl-horizontal">
                    <label>With CD:</label> @if($book->with_cd == 1)
                                                  {{ 'Yes' }}
                                                  @else
                                                  {{ 'No' }}
                                                  @endif
                  </dl>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
        function printContent(el) {
            var restorepage = document.body.innerHTML;
            var printcontent = document.getElementById(el).innerHTML;
            document.body.innerHTML = printcontent;
            window.print();
        }   

        function blinker() {
            $('.blink_me').fadeOut(500);
            $('.blink_me').fadeIn(500);
        }

        setInterval(blinker, 1000);     
</script>


@endsection


@section('scripts')
      <script src="{{ asset('js/parsley.min.js') }}"></script>
@endsection