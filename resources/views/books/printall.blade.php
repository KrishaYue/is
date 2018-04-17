@extends('layouts.app')

@section('styles')

     <link href="{{ asset('css/print.css') }}" rel="stylesheet">
     
@endsection

@section('content')


<div class="container" id="loading_content">
	<div class="row print_loading">
		<div class="col-md-8 col-md-offset-2">
			<h3 class="text-muted text-center">Please wait...</h3>
			<div class="progress" width="20">
			  <div class="progress-bar progress-bar-success progress-bar-striped active"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
			    <h4 class="modal-title" id="myModalLabel"><p id="demo"></p>%</h4>
			  </div>
			</div>
		</div>
	</div>
</div>


<div class="container" id="print_content" style="display: none;">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
				<div class="alert alert-success">
				  <strong>Success!</strong> your files are now ready.<button class="btn btn-primary print-btn" onclick="printContent('qr')"><i class="fas fa-print"></i> Print</button>
				</div>		
        </div>
    </div>
</div>



<!-- print content -->
<div id="qr">
	@foreach($books as $book)
	<div class="qr_content">
    	<ul class="list-inline">
	        <li style="margin-left: 100px;"><h1>ID #: {{ $book->id }}</h1></li>
	        <li style="margin-left: 200px;"><img src="data:image/png;base64, {{base64_encode(QrCode::format('png')->size(150)->generate(url('book/').'/'.$book->id))}} "></li>
    	</ul>	
    </div>
    
    @endforeach
</div>


<script>
        function printContent(el) {
            var restorepage = document.body.innerHTML;
            var printcontent = document.getElementById(el).innerHTML;
            document.body.innerHTML = printcontent;
            window.print();
        } 

        var myVar=setInterval(function(){myTimer()},1);
		var count = 0;
		function myTimer() {
		if(count < 100){
		  $('.progress').css('width', count + "%");
		  count += 0.15;
		   document.getElementById("demo").innerHTML = Math.round(count) +"%";
		   // code to do when loading
		  }
		  
		  else if(count > 99){  
		      // code to do after loading
		      document.getElementById('print_content').style.display = 'block';
		      document.getElementById('loading_content').style.display = 'none';
		      document.body.style.backgroundColor = '#f5f8fa';
			
		  
		  }
		}  
             
</script>

@endsection

