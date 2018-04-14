@extends('layouts.app')

@section('styles')

     <link href="{{ asset('css/home.css') }}" rel="stylesheet">
     
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
            <h1>Books <small class="muted">All books in the database</small></h1>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ route('book.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Book</a>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="container">
                            <ul class="list-inline">
                                
                                    <li>
                                        <form>
                                            <select id="itemsOption" onchange="myFunc()" class="form-control input-sm">
                                                <option value="5" @if($items == 5) selected @endif >5</option>
                                                <option value="10" @if($items == 10) selected @endif >10</option>
                                                <option value="15" @if($items == 15) selected @endif >15</option>
                                            </select>
                                        </form>
                                    </li>
                                    <li>
                                       records per page 
                                    </li>               
                                    <li>
                                        <form class="form-inline float-right" action="{{ route('search.book') }}" method="GET">
                                          <div class="form-group">
                                            <input type="text" class="form-control input-sm" id="search" placeholder="Search" name="quary">
                                          </div>
                                          <button type="submit" class="btn btn-default btn-sm"><i class="fas fa-search"></i></button>
                                        </form>
                                    </li>
                            </ul>          
                        </div>   
                    </div>
                    
                    <table class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th style="width:10%" >ID</th>
                            <th style="width:20%" >Title</th>
                            <th style="width:20%" >Author</th>
                            <th style="width:20%" >Published Date</th>
                            <th>Available</th>
                            <th>QR Code</th>
                            <th style="width:20%" >Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($books  as $book)
                                  <tr>
                                    <td>{{ $book->id }}</td>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->author }}</td>
                                    <td>{{ date('M j, Y', strtotime($book->date_published)) }}</td>
                                    <td>@if($book->availability == 1)
                                        {{ 'Yes' }}
                                        @else
                                        {{ 'No' }}
                                        @endif
                                    </td>
                                    <td><a href="#" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal{{$book->id}}"><i class="fas fa-eye"></i> View</a></td>
                                    <td><a href="#" class="btn btn-default btn-sm"><i class="fas fa-edit"></i> Edit</a> <a href="#" class="btn btn-default btn-sm"><i class="fas fa-trash-alt"></i> Delete</a></td>
                                    
                                  </tr>
                                  <!-- Modal -->
                                    <div class="modal fade" id="myModal{{$book->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h1 class="modal-title" id="myModalLabel">{{$book->title}}<small class="text-muted"> QR CODE</small></h1>
                                          </div>
                                          <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-offset-2">
                                                    {!! QrCode::size(400)->generate($book->id.'-'.$book->created_at) !!}
                                                </div>
                                            </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div> 
                            @endforeach
                        </tbody>
                    </table>
                    <!-- links for button page -->
                    <ul class="pagination">
                        @for ($i = $allBooks->count(); $i > 0; $i-=$items)                           
                                <li value="{{ $page }}"><a class="btn-xs"  href="{{ url('/home?page='.$page.'&items='.$items) }}">{{ $page++ }}</a></li>
                        @endfor
                    </ul>                    

                </div>
            </div>
        </div>
    </div>
</div>

<script>
        function myFunc() {
            d = document.getElementById("itemsOption").value;
            window.location = "{{ $books->url(1) }}&items=" + d;
        };        
</script>



@endsection


