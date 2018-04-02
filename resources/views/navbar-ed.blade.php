  <div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container">

        <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
          <i class="icon-reorder shaded"></i></a>
        <a class="brand" href="/">Okayu </a>

        <div class="nav-collapse collapse navbar-inverse-collapse">

          <ul class="nav nav-icons">
          </ul>

          <form class="navbar-search pull-left input-append" action="#">
            <input type="text" class="span3" placeholder="under construction">
            <button class="btn" type="button">
              <i class="icon-search"></i>
            </button>
          </form>

          <ul class="nav pull-right">

            <li class="nav-user dropdown">
                @if (Auth::guest())
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Login/Register
<!--                   <img src="{{ asset('images/user.png') }}" class="nav-avatar" /> -->
                  <span class="caret"></span>
                </a>

                <ul class="dropdown-menu">
                  <li><a href="/auth/login">Login</a></li>
                  <li><a href="/auth/register">Register</a></li>
                </ul>
              @else
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}<b class="caret"></b></a>

                <ul class="dropdown-menu">
                  <li><a href="/auth/logout">Logout</a></li>
                </ul>
              @endif
            </li>
          </ul>
        </div><!-- /.nav-collapse -->
      </div>
    </div><!-- /navbar-inner -->
  </div><!-- /navbar -->
