@extends('layout')

@section('title','新規登録')

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
	<form class="form-vertical" role="form" method="POST" action="/auth/register">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">


		<div class="module-head">
			<h3>Sign Up</h3>
		</div>

		<div class="module-body">
			<div class="control-group">
				<div class="controls row-fluid">
					<input class="span12" type="text" name="name" value="{{ old('name') }}" placeholder="Name">
				</div>
			</div>

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

			<div class="control-group">
				<div class="controls row-fluid">
					<input class="span12" type="password" name="password_confirmation" placeholder="Confirm Password">
				</div>
			</div>
		</div>

		<div class="module-foot">
			<div class="control-group">
				<div class="controls clearfix">
					<button type="submit" class="btn btn-primary pull-right">Register</button>
				</div>
			</div>
		</div>
	</form>

</div>
@endsection