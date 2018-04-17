@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/settings.css') }}">
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
             	@if($errors->has('profile_picture'))
	                <div class="alert alert-danger alert-dismissible fade in">
	                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	                  <strong><i class="fas fa-exclamation-triangle"></i></strong> {{ $errors->first('profile_picture') }}
	                </div>
	             @endif
	             @if($errors->has('name') || $errors->has('email'))
	                <div class="alert alert-danger alert-dismissible fade in">
	                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	                  @if($errors->has('name'))
						<p><strong><i class="fas fa-exclamation-triangle"></i></strong> {{ $errors->first('name') }}</p>
	                  @endif
	                  @if($errors->has('email'))
						<p><strong><i class="fas fa-exclamation-triangle"></i></strong> {{ $errors->first('email') }}</p>
	                  @endif                  
	                </div>
	             @endif
	             @if($errors->has('old_password') || $errors->has('new_password'))
	                <div class="alert alert-info alert-dismissible fade in">
	                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	                  @if($errors->has('old_password'))
						<p><strong><i class="fas fa-info"></i></strong> {{ $errors->first('old_password') }}</p>
	                  @endif
	                  @if($errors->has('new_password'))
						<p><strong><i class="fas fa-info"></i></strong> {{ $errors->first('new_password') }}</p>
	                  @endif
	                </div>
	             @endif
				<h1>  My Account </h1>
				<div class="panel-group" id="accordion">
				  <div class="panel panel-default">
				    <div class="panel-heading">
				      <h4 class="panel-title">
				        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
				        <i class="fas fa-image"></i> Update Profile Picture</a>
				      </h4>
				    </div>
				    <div id="collapse1" class="panel-collapse collapse @if($errors->has('profile_picture')) in @endif @if(session('picture-is-in')) in @endif ">
				      <div class="panel-body">
				      	<div class="row">
				      		<div class="col-md-2">
				      			@if(Auth::user()->image == '')
				      				<img src=" {{ asset('default-profile.png') }} " width="100" height="100">
				      			@else
									<img src=" {{ asset('images/' . Auth::user()->image) }} " width="100" height="100">
				      			@endif
				      		</div>
				      		<div class="col-md-8">			      			
				      			<form action="{{ route('update.picture') }}" method="POST" enctype="multipart/form-data" data-parsley-validate="parsley">
				      				{{ csrf_field() }}
				      				<input type="file" name="profile_picture" class="form-group margin-top-30" required data-parsley-required-message="Please insert an image">
				      				<button class="btn btn-success btn-sm"><i class="fas fa-save"></i> Save</button>
				      			</form>
				      		</div>
				      	</div>
				      </div>
				    </div>
				  </div>
				  <div class="panel panel-default">
				    <div class="panel-heading">
				      <h4 class="panel-title">
				        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
				        <i class="fas fa-user"></i> Update Account Info</a>
				      </h4>
				    </div>
				    <div id="collapse2" class="panel-collapse collapse @if($errors->has('name') || $errors->has('email')) in @endif @if(session('info-is-in')) in @endif">
				      <div class="panel-body">
				      	<form action="{{ route('update.info') }}" method="POST" data-parsley-validate="parsley">
				      	  {{ csrf_field() }}
						  <div class="form-group">
						    <label for="exampleInputName">Name</label>
						    <input type="text" class="form-control" id="exampleInputName" placeholder="Name" value="{{ Auth::user()->name }}" name="name" required data-parsley-required-message="Name is required">
						  </div>
						  <div class="form-group">
						    <label for="exampleInputEmail">Email address</label>
						    <input type="email" class="form-control" id="exampleInputEmail" placeholder="Email" value="{{ Auth::user()->email }}" name="email" required data-parsley-required-message="Email is required">
						  </div>
						  <button class="btn btn-success btn-sm"><i class="fas fa-save"></i> Save</button>
						</form>
				      </div>
				    </div>
				  </div>
				  <div class="panel panel-default">
				    <div class="panel-heading">
				      <h4 class="panel-title">
				        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
				        <i class="fas fa-key"></i> Change Password</a>
				      </h4>
				    </div>
				    <div id="collapse3" class="panel-collapse collapse @if($errors->has('old_password') || $errors->has('new_password')) in @endif @if(session('password-is-in')) in @endif">
				      <div class="panel-body">
				      	<form action="{{ route('update.password', Auth::user()->id) }}" method="POST" data-parsley-validate="parsley">
						  <div class="form-group">
						    <label>Old Password</label>
						    <input type="password" class="form-control" placeholder="Old Password" name="old_password" required data-parsley-required-message="Old Password is required">
						  </div>
						  <div class="form-group">
						    <label>New Password</label>
						    <input type="password" class="form-control" placeholder="New Password" name="new_password" required data-parsley-required-message="New Password is required">
						  </div>
						  <div class="form-group">
						    <label>Confirm New Password</label>
						    <input type="password" class="form-control" placeholder="Confirm New Password" name="new_password_confirmation" required data-parsley-required-message="New Password is required"> 
						  </div>
						  <button class="btn btn-success btn-sm"><i class="fas fa-save"></i> Save</button>
						   <input type="hidden" name="_token" value="{{ Session::token() }}">
             				{{ method_field('PUT') }}
						</form>
				      </div>
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