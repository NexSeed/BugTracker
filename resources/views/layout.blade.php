<!DOCTYPE html>
<html lang="ja">
<head>
  <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
  <!-- <meta charset="utf-8"> -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>
    @yield('title')
  </title>


  <title>Edmin</title>
  <link type="text/css" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link type="text/css" href="{{ asset('/bootstrap/css/bootstrap-responsive.min.css') }}" rel="stylesheet">
  <link type="text/css" href="{{ asset('/css/theme.css') }}" rel="stylesheet">
  <link type="text/css" href="{{ asset('/images/icons/css/font-awesome.css') }}" rel="stylesheet">
  <link type="text/css" href="{{ asset('/css/custom.css') }}" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
</head>

<body>
  @include('navbar-ed')
  <div class="container">
    @if (Session::has('flash_message'))
      <div class="alert alert-success">{{ Session::get('flash_message') }}
      </div>
    @endif

    @include('flash::message')

  </div>
  <div class="wrapper">
    <div class="container">
      <div class="row">
        <div class="span2">
          @include('sidebar')
        </div><!--/.span2-->
			<div class="span10">
				<div class="content">
					@yield('content')
				</div>
			</div>
        </div>
    </div><!--/.container-->
  </div><!-- /.wrapper -->





  <div class="footer">
    <div class="container">


      <b class="copyright">&copy; Okayu <?php echo date("Y"); ?> </b> All rights reserved.
    </div>
  </div>

  <script src="{{ asset('/scripts/jquery-1.9.1.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('/scripts/jquery-ui-1.10.1.custom.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('/scripts/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
  <script src="{{ asset('scripts/common.js')}}" type="text/javascript"></script>

  <script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>


  @if (View::hasSection('additionaljs'))
	  @yield('additionaljs')
  @endif


</body>
</html>