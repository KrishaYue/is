@extends('layouts.app')

@section('styles')

     <link href="{{ asset('css/home.css') }}" rel="stylesheet">
          
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @if(session('borrow_warning'))
                <script>
                  alert('Book no.' + {{ session('borrow_warning') }} + ' is not available.');
                </script>
            @endif
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade in">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Success!</strong> {{ session('success') }}
                </div>
             @endif
             @if(session('info'))
                <div class="alert alert-info alert-dismissible fade in">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong><i class="fas fa-info"></i> </strong> {{ session('info') }}
                </div>
             @endif
              <h1>All Books</h1>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <ul class="list-inline">

                        <li><a href="{{ route('book.create') }}" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Add Book</a></li>
                        <li>|</li>
                        <li><a href="{{ route('backup.book') }}" class="btn btn-success btn-sm"><i class="fas fa-download"></i> Backup Database</a></li>
                        <a href="#" class="btn btn-sm btn-success" onclick="printContent('all-books')">Print Books Data</a>
                            <li style="float:right;">
                              <button class="btn btn-sm btn-default" form="qr_print_form" formaction="{{ route('qr.selected.print') }}"><i class="fas fa-print"></i> Print</button>
                            </li>
                            <li style="float:right;">
                                <form id="qr_print_form" method="POST">
                                  {{ csrf_field() }}
                                  <div class="multiselect">
                                    <div class="selectBox" onclick="showCheckboxes()">
                                      <select class="form-control input-sm">
                                        <option>Select a QR to print</option>
                                      </select>
                                      <div class="overSelect"></div>
                                    </div>
                                    <div id="checkboxes">
                                        @foreach($allBooks as $book)
                                          <label for="{{ 'book'.$book->id }}">
                                            <input type="checkbox" id="{{ 'book'.$book->id }}" name="{{ $book->id }}" value="{{ $book->id }}" /> {{ $book->id.'. ' }} {{ $book->title }}
                                          </label>
                                        @endforeach
                                      <!-- <label for="two">
                                        <input type="checkbox" id="two" />Second checkbox</label>
                                      <label for="three">
                                        <input type="checkbox" id="three" />Third checkbox</label> -->
                                    </div>
                                  </div>
                                </form>
                        
                                
                        </li>
                        <li style="float:right;"> or</li>
                        <li style="float:right;"> <a href="{{ route('books.print') }}" class="btn btn-default btn-sm"><i class="fas fa-print"></i> Print All QR</a></li>
                    </ul>                   
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="container">
                            <ul class="list-inline">
                                <li>
                                    <form>
                                        <select id="itemsOption" onchange="myFunc()" class="form-control input-sm">
                                            <option value="10" @if($items == 10) selected @endif >10</option>
                                            <option value="20" @if($items == 20) selected @endif >20</option>
                                            <option value="50" @if($items == 50) selected @endif >50</option>
                                            <option value="100" @if($items == 100) selected @endif >100</option>
                                        </select>
                                    </form>
                                </li>
                                <li>
                                   records per page  
                                </li>               
                                <li class="searh-form">
                                    <form class="form-inline" action="{{ route('search.book') }}" method="GET">
                                      <div class="form-group">
                                        <input type="text" class="form-control input-sm" id="search" placeholder="Search" name="quary" title="Search by ID or Title">
                                      </div>
                                      <button type="submit" class="btn btn-default btn-sm"><i class="fas fa-search"></i></button>
                                    </form>
                                </li>
                            </ul>          
                        </div>   
                    </div>
                    
                    <table class="table table-bordered table-striped table-hover" id="indextable">
                        <thead>
                          <tr>
                            <th style="width:10%" onclick="location='javascript:SortTable(0,\'N\');'" >ID</th>
                            <th style="width:30%" onclick="location='javascript:SortTable(1,\'T\');'">Title</th>
                            <th style="width:10%" onclick="location='javascript:SortTable(2,\'T\');'">Author(s)</th>
                            <th style="width:10%" onclick="location='javascript:SortTable(3,\'N\');'">Year Published</th>
                            <th onclick="location='javascript:SortTable(4,\'T\');'">Available</th>
                            <th onclick="location='javascript:SortTable(5,\'T\');'">With CD</th>
                            <th>QR Code</th>
                            <th style="width:25%" >Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($books  as $book)
                                  <tr>
                                    
                                    <td>{{ $book->id }}@if(date('M j, Y') == $book->created_at->toFormattedDateString()) <span class="label label-danger blink_me">New !</span></span> @endif</td>
                                    <td title="{{ $book->title }}">{{ $book->title }} </td>
                                    <td title="{{ $book->author }}">{{ (strlen($book->author) >= 15) ? substr($book->author, 0, 15). '...' : $book->author }}</td>
                                    <td>{{ $book->year_published }}</td>
                                    <td>@if($book->availability == 1)
                                        {{ 'Yes' }}
                                        @else
                                        {{ 'No' }}
                                        @endif
                                    </td>
                                    <td>@if($book->with_cd == 1)
                                        {{ 'Yes' }}
                                        @else
                                        {{ 'No' }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModal{{$book->id}}" title="Click me to view the QR"><i class="fas fa-qrcode"></i></a>
                                    </td>
                                    <td>
                                        <a href="{{ route('book.show', $book->id) }}" class="btn btn-default btn-xs"><i class="fas fa-eye"></i> View</a>
                                        @if($book->availability == 1)
                                          <a href="{{ route('view.borrow.book', $book->id) }}" class="btn btn-default btn-xs"><i class="fas fa-book"></i> Borrow</a>
                                        @endif
                                        <a href="{{ route('book.edit', $book->id) }}" class="btn btn-default btn-xs"><i class="fas fa-edit"></i> Edit</a>
                                                                                
                                        <form  class="form_inline" method="POST" action="{{ route('book.destroy', $book->id) }}" onsubmit="return ConfirmDelete()">
                                        <button class="btn btn-danger btn-xs"><i class="fas fa-trash-alt"></i> Delete</button>
                                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                                        {{ method_field('DELETE') }}
                                        </form>
                                    </td>
                                    
                                  </tr>
                                  <!-- Modal -->
                                    <div class="modal fade" id="myModal{{$book->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h1 class="modal-title text-light" id="myModalLabel">{{$book->title}}</h1>
                                            <p class="text-muted"> ID: {{ $book->id }}</p>
                                          </div>
                                          <div class="modal-body" >
                                            <div class="row">
                                                <div class="col-md-offset-2">
                                                    <img src="data:image/png;base64, {{base64_encode(QrCode::format('png')->size(400)->generate(url('book/').'/'.$book->id))}} ">
                                                </div>
                                            </div>
                                          </div>

                                          <!-- print content -->
                                          <div class="qr_div" id="qr{{$book->id}}">
                                                <ul class="list-inline">
                                                    <h1 class="mono_font">ID: {{ $book->id }}</h1>
                                                    <img src="data:image/png;base64, {{base64_encode(QrCode::format('png')->size(150)->generate(url('book/').'/'.$book->id))}} ">
                                                </ul>
                                          </div>
                                          
                                          <div class="modal-footer">
                                            <button class="btn btn-primary btn-sm" onclick="printContent('qr{{$book->id}}')"><i class="fas fa-print"></i> Print</button>
                                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div> 
                            @endforeach
                        </tbody>
                    </table>
                    
                    <!-- pagination -->
                    <ul class="pagination pagination-sm">
                        <li style="float: left;">
                            <a href="{{ url('/home?page='.$page.'&items='.$items) }}" class="btn btn-sm btn-primary @if($isActive == $page) disabled @endif">First</a>
                        </li>
                        @for ($i = $allBooks->count(); $i > 0; $i-=$items)
                            <li class=" 
                                       @if($isActive == $page) active @endif"  
                                       value="{{ $page }}" 
                                       @if($page  > $isActive + 5) style="display: none;" @endif 
                                       @if($page  < $isActive - 3 ) style="display: none;" @endif>
                                       <a href="{{ url('/home?page='.$page.'&items='.$items) }}">{{ $page++ }}</a>
                            </li>
                        @endfor
                        <li>
                            <a href="{{ url('/home?page='.--$page.'&items='.$items) }}" class="btn btn-sm btn-primary @if($isActive == $page) disabled @endif">Last</a>
                        </li>
                    </ul>                                      
                    <!-- pagination end -->

                </div>
            </div>
        </div>
    </div>
</div>

<div id="all-books">
  <div class="container">
    <div class="col-md-12">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Year Published</th>
            <th>Availability</th>
            <th>CD Availability</th>
          </tr>
        </thead>
        <tbody>
          @foreach($allBooks as $row)
          <tr>
            <td>{{ $row->id }}</td>
            <td>{{ $row->title }}</td>
            <td>{{ $row->author }}</td>
            <td>{{ $row->year_published }}</td>
            <td>@if($row->availability == 1)
                {{ 'Yes' }}
                @else
                {{ 'No' }}
                @endif
            </td>
            <td>@if($row->with_cd == 1)
                {{ 'Yes' }}
                @else
                {{ 'No' }}
                @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>




<script src="{{ asset('js/sort.js') }}"></script>
<script>
        function myFunc() {
            d = document.getElementById("itemsOption").value;
            window.location = "{{ $books->url(1) }}&items=" + d;
        };

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
        


        //////////////////////////////////////////

        var expanded = false;

        function showCheckboxes() {
          var checkboxes = document.getElementById("checkboxes");
          if (!expanded) {
            checkboxes.style.display = "block";
            expanded = true;
          } else {
            checkboxes.style.display = "none";
            expanded = false;
          }
        }

         function ConfirmDelete()
          {
          var x = confirm("Are you sure you want to delete?");
          if (x)
            return true;
          else
            return false;
          }     
</script>



@endsection

