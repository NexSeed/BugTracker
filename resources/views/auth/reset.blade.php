@extends('layout')

@section('title', 'パスワードリセット')

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Reset Password</div>
        <div class="panel-body">
          @if (count($errors) > 0)
            <div class="alert alert-danger">
              <strong>Whoops!</strong> インプットにエラーがありました
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form class="form-horizontal" role="form" method="POST" action="/password/reset">
            <input type="text" name="_token" value="{{ csrf_token }}">
            <input type="text" name="token" value="{{ $token }}">

            <div class="form-group">
              <label class="col-md-4 control-label">Email</label>
              <div class="col-md-6">
                <input type="email" name="email" class="form-control" name="email" value="{{ old('email') }}">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label">Password</label>
              <div class="col-md-6">
                <input type="password" name="password" class="form-control">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label">Confirm Password</label>
              <div class="col-md-6">
                <input type="password" name="confirm_password" class="form-control">
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">Reset Password</button>
              </div>
            </div>
          </form>
        </div>  <!-- panel-body -->
      </div>
    </div>
  </div> <!-- row -->
</div>

