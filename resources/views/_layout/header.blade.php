<!-- Main Header -->
<header class="main-header">

  <!-- Logo -->
  <a href="#" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>O</b>ps</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>OPS</b></span>
  </a>

  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account Menu -->
        <li class="dropdown user user-menu">
          <!-- Menu Toggle Button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <!-- The user image in the navbar-->
            <img src="{!! asset("/s/dist/img/user2-160x160.jpg")!!}" class="user-image" alt="User Image">
            <!-- hidden-xs hides the username on small devices so only the image appears. -->
            <span class="hidden-xs">{!! Auth::user()->name !!}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- The user image in the menu -->
            <li class="user-header">
              <img src="{!! asset("/s/dist/img/user2-160x160.jpg")!!}" class="img-circle" alt="User Image">
              <p>
                {!! Auth::user()->name !!} - {!! Auth::user()->roles->lists('description')->first() !!}
                <small>since {!! Auth::user()->created_at !!}</small>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="{!! route('admin.person') !!}" class="btn btn-default btn-flat">个人设置</a>
              </div>
              <div class="pull-right">
                <a href="{!!route('logout')!!}" class="btn btn-default btn-flat">退出</a>
              </div>
            </li>
          </ul>
        </li>

      </ul>
    </div>
  </nav>
</header>