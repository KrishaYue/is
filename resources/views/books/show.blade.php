@extends('layouts.app')

@section('styles')
     <link href="{{ asset('css/create.css') }}" rel="stylesheet">
     <link href="{{ asset('css/parsley.css') }}" rel="stylesheet">
@endsection
            
@section('content')
<div class="container">
 @if($book->image == '')
                      <img src=" {{ asset('default-profile.png') }} " width="100" height="100">
                    @else
                  <img src=" {{ asset('images/' . $book->image) }} " width="100" height="100">
                    @endif
   <div class="row">
    <div class="col-md-8">
     
      <h1>{{ $book->title }}</h1>
      <p class="lead">Author: {{ $book->author }}</p>
      <p class="lead">Date Published: {{ date('M j, Y', strtotime($book->date_published)) }}</p>
    </div>

    <div class="col-md-4">
      <div class="well">

        <dl class="dl-horizontal">
          <label>Created At:</label>
          <p>{{ date('M j, Y H:i', strtotime($book->created_at)) }}</p>
        </dl>

        <dl class="dl-horizontal">
          <label>Last Updated:</label>
          <p>{{ date('M j, Y H:i', strtotime($book->updated_at)) }}</p>
        </dl>
        <hr>
        <dl class="dl-horizontal">
          <p class="lead">Available: @if($book->availability == 1)
                                        {{ 'Yes' }}
                                        @else
                                        {{ 'No' }}
                                        @endif</p>
        </dl>
    </div>
  </div>
</div>



@endsection


@section('scripts')
      <script src="{{ asset('js/parsley.min.js') }}"></script>
@endsection