<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ICTDU Inventory</title>

    <link rel="shortcut icon" href="{{ asset('sample.ico') }}" />
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/print.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bookloading.css') }}">

    <!-- Font Awesome icon -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
    
</head>
<body onload="myFunction()" style="background-color: #222222;width: 100%;height: 100vh;margin: 0;">

<div class="bookshelf_wrapper" id="loader">
  <ul class="books_list" id="loader_ul">
    <li class="book_item first" id="loader_li1"></li>
    <li class="book_item second" id="loader_li2"></li>
    <li class="book_item third" id="loader_li3" ></li>
    <li class="book_item fourth" id="loader_li4"></li>
    <li class="book_item fifth" id="loader_li5"></li>
    <li class="book_item sixth" id="loader_li6"></li>
  </ul>
  <div class="shelf" id="loader_shelf"></div>
</div>

<div id="app">
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        ICTDU Inventory
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">

                            <li class=""><a href="{{ route('home') }}">Home</a></li>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">

                            <li>
                                @if(Auth::user()->image == '')
                                    <img src="{{ asset('default-profile.png') }} " width="28;" height="28" style="border-radius: 50%; margin-top: 10px;">
                                @else
                                    <img src="{{ asset('images/' . Auth::user()->image) }} " width="28;" height="28" style="border-radius: 50%; margin-top: 10px;">
                                @endif
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('view.user') }}"><i class="fas fa-user-circle"></i> Profile</a></li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>
                                             Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>



                    </ul>
                </div>
            </div>
        </nav>
        <!-- spacer -->
        <div style="margin-bottom: 100px;">
            
        </div>
        
		<div class="container animate-bottom" style="display:none;" id="myDiv" >
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="border-left">
						<ul class="list-inline">
							<li><h3>Your files are now ready.</h3><p class="text-success small">Thank you for waiting!</p></li>
							<li><button style="position: absolute; right: 35px; top: 35px;" class="btn btn-success btn-sm" onclick="printContent('qr')"><i class="fas fa-print"></i> Print</button></li>
						</ul>			
					</div>
				</div>
			</div>
		</div>



    </div>



<!-- print content -->
<div id="qr">
	@foreach($selectedBooks as $book)
	<div class="qr_content">
    	<ul class="list-inline">
	        <li style="margin-left: 100px;"><h1>ID: {{ $book }}</h1></li>
	        <li style="margin-left: 200px;"><img src="data:image/png;base64, {{base64_encode(QrCode::format('png')->size(150)->generate(url('book/').'/'.$book))}} "></li>
    	</ul>	
    </div>
    
    @endforeach
</div>

</body>

<script>
        function printContent(el) {
            var restorepage = document.body.innerHTML;
            var printcontent = document.getElementById(el).innerHTML;
            document.body.innerHTML = printcontent;
            window.print();
        } 

        
        var myVar;

		function myFunction() {
		    myVar = setTimeout(showPage, 3000);
		}

		function showPage() {

		  document.getElementById('loader').removeAttribute("class"); 
		  document.getElementById('loader_ul').removeAttribute("class");

		  document.getElementById('loader_li1').removeAttribute("class");
		  document.getElementById('loader_li2').removeAttribute("class");
		  document.getElementById('loader_li3').removeAttribute("class");
		  document.getElementById('loader_li4').removeAttribute("class");
		  document.getElementById('loader_li5').removeAttribute("class"); 
		  document.getElementById('loader_li6').removeAttribute("class");

		  document.getElementById('loader_shelf').removeAttribute("class");

		  document.body.removeAttribute('style');

		  document.getElementById("loader").style.display = "none";
		  document.getElementById("myDiv").style.display = "block";

		}   
</script>


    <script src="{{ asset('js/app.js') }}"></script>
</html>





