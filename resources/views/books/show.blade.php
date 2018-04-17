@extends('layouts.app')

@section('styles')
     <link href="{{ asset('css/create.css') }}" rel="stylesheet">
     <link href="{{ asset('css/parsley.css') }}" rel="stylesheet">
@endsection
            
@section('content')
<div class="container">

   <div class="row">
    <div class="col-md-8">

      <h1>{{ $book->title }}</h1>
      <p class="lead">Author: {{ $book->author }}</p>
      <p class="lead">Date Published: {{ $book->date_published }}</p>
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

    </div>
  </div>
</div>



@endsection


@section('scripts')
      <script src="{{ asset('js/parsley.min.js') }}"></script>
@endsection