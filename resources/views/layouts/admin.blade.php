<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $data['title'] }} - школа самодисциплины</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <!-- Google fonts - Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <div class="page">
      <!-- Main Navbar-->
      <header class="header">
        <nav class="navbar">
          <!-- Search Box-->
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <!-- Navbar Header-->
              <div class="navbar-header">
                <!-- Navbar Brand --><a href="#" class="navbar-brand d-none d-sm-inline-block">
                  <div class="brand-text d-none d-lg-inline-block"><span>Панель </span><strong> управления</strong></div>
                  <div class="brand-text d-none d-sm-inline-block d-lg-none"><strong>BD</strong></div></a>
                <!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
              </div>
              <!-- Navbar Menu -->
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <!-- Logout    -->
                <li class="nav-item">
                  <form action="{{ route('logout') }}" method="post">
                    {{ csrf_field() }}
                    <button type="submit" class="nav-link logout">Выход <i class="fas fa-sign-out-alt"></i></button>
                  </form>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <div class="page-content d-flex align-items-stretch"> 
        <!-- Side Navbar -->
        <nav class="side-navbar">
          <!-- Sidebar Header-->
          <div class="sidebar-header d-flex align-items-center">
            <div class="avatar"><img src="/img/samo-admin-logo.png" alt="..." class="img-fluid rounded-circle"></div>
            <div class="title">
              <h1 class="h4">САМО</h1>
              <p>дисциплина</p>
            </div> 
          </div>
          <!-- Sidebar Navidation Menus--><span class="heading">Основное</span>
          <ul class="list-unstyled">
            <li class="{{ Request::is('admin') ? 'active' : '' }}"><a href="{{ route('admin') }}"> <i class="fas fa-home"></i>Главная </a></li>
            <li class="{{ Request::is('admin/reporters') ? 'active' : '' }}"><a href="{{ route('reporters.index') }}"> <i class="far fa-calendar-check"></i></i>Отчетные </a></li>
            <li><a href="#participantsCollapse" aria-expanded="true" data-toggle="collapse"> <i class="fas fa-users"></i>Участники </a>
              <ul id="participantsCollapse" class="collapse list-unstyled show">
                <li class="{{ Request::is('admin/activeparticipants') ? 'active' : '' }}"><a href="{{ route('participants.active') }}"> <i class="fas fa-user-check"></i>Активные</a></li>
                <li class="{{ Request::is('admin/inactiveparticipants') ? 'active' : '' }}"><a href="{{ route('participants.inactive') }}"><i class="fas fa-user-times"></i>Неактивные</a></li>
              </ul>
            </li>
            <li class="{{ Request::is('admin/groups') ? 'active' : '' }}"><a href="{{ route('groups.index') }}"> <i class="far fa-calendar-check"></i></i>Группы </a></li>
            <li class="{{ Request::is('admin/motivators') ? 'active' : '' }}"><a href="{{ route('motivators.index') }}"> <i class="fas fa-grin-stars"></i>Мотивашки </a></li>
          </ul>
          <span class="heading">Помощь</span>
          <ul class="list-unstyled">
            <li class="{{ Request::is('admin/helper') ? 'active' : '' }}"> <a href="{{ route('helper.index')}}"> <i class="fas fa-info-circle"></i>О системе </a></li>
          </ul>
        </nav>
        <div class="content-inner">

            @yield('content')
              <!-- Page Footer-->
            <footer class="main-footer">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-sm-6">
                      <p>Школа самодисциплины &copy; 2019</p>
                    </div>
                    <div class="col-sm-6 text-right">
                      <p>Created by <a href="https://www.ismarty.pro/" class="external">iSmarty PRO</a></p>
                    </div>
                  </div>
                </div>
            </footer>            

        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="/js/front.js"></script>
    @yield('jscript')
  </body>
</html>