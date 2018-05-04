@extends('layout')

@section('content')



@if (count($errors) > 0)
	<div class="alert alert-danger">
		<strong>Whoops!</strong> There were some problem with your input. <br><br>
		<ul>
		  @foreach ($errors->all() as $error)
		    <li>{{ $error }}</li>
		  @endforeach
		</ul>
	</div>
@endif

<div class="module span4 offset2">
	<form class="form-vertical" role="form" method="POST" action={{url("/auth/login")}}>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<div class="module-head">
			<h3>Sign In</h3>
		</div>
		<div class="module-body">
			<div class="control-group">
				<div class="controls row-fluid">
					<input class="span12" type="email" name="email" value="{{ old('email') }}" placeholder="Email">
				</div>
			</div>
			<div class="control-group">
				<div class="controls row-fluid">
					<input class="span12" type="password" name="password" placeholder="Password">
				</div>
			</div>
		</div>
		<div class="module-foot">
			<div class="control-group">
				<div class="controls clearfix">
					<button type="submit" class="btn btn-primary pull-right">Login</button>
					<label class="checkbox">
						<input type="checkbox" name="remember"> Remember me
					</label>
				</div>
			</div>
			<a href={{url("password/email")}}>Forgot Your Password?</a>

		</div>
	</form>
</div>


@endsection