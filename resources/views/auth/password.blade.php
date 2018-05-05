@extends('layout')

@section('content')

<div class="container-fluid">
  <div class="row">
<!--
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-body">
-->
          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif

          @if (count($errors) > 0)
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form class="form-vertical" role="form" method="POST" action={{url("/password/email")}}>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

			<div class="module span4 offset2">
              	<div class="module-head">
                	<h3>Reset Password</h3>
              	</div>
			  	<div class="module-body">

		            <div class="control-group">
		              <div class="controls row-fluid">
		                <input type="email" name="email" class="span12" name="email" value="{{ old('email') }}" placeholder="Email">
		              </div>

		              <div class="controls clearfix">
		                <button type="submit" class="btn btn-primary">Send Password Reset Link
		                </button>
		              </div>
		            </div>
			  	</div>
			</div> <!-- module -->
          </form>
<!--
        </div>
      </div>
    </div>
-->
  </div>
</div>

@endsection