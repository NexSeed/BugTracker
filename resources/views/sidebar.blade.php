          <div class="sidebar">

            <ul class="widget widget-menu unstyled">
	            <li class="active"><a href={{url("/")}}>
	                <i class="menu-icon icon-dashboard"></i>
	                Dashboard
	            </a></li>
				      <li><a href={{url("articles")}}>
	                <i class="menu-icon icon-bullhorn"></i>
	                Feed
	            </a></li>
              <li><a href={{url("articles/create")}}>
                  <i class="menu-icon icon-edit"></i>
                  New Report
              </a></li>
            </ul><!--/.widget-nav-->


            <ul class="widget widget-menu unstyled">
                @if (Auth::guest())
                {{-- ログインしていない時 --}}
                    <li><a href={{url("auth/login")}}>
                    <i class="icon-inbox"></i>
                        Login
                    </a></li>
                    <li><a href={{url("auth/register")}}>
                    <i class="icon-inbox"></i>
                        Register
                    </a></li>
                @else
                    <li><a href={{url("auth/logout")}}>
                      <i class="menu-icon icon-signout"></i>
                      Logout
                    </a></li>
                @endif

            </ul>

          </div><!--/.sidebar-->
