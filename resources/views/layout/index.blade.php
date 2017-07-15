<body>
<script src="{{asset('./jquery.js')}}"></script>
<link href="{{ asset('./style.css') }}" rel="stylesheet"> 
<link href="{{ asset('./bootstrap-3/css/bootstrap.min.css') }}" rel="stylesheet"> 


</bodY>
<div id="center">

  <div id="menu">
    <div class="row">
      <div class="col-md-12"><div align=center><span class=menu2>MENU</span></div></div>
    </div>
    <div class="row">
      <div class="col-md-12"><div align=center><a href={{ url('/login') }} class=menu>kalenadarz</a></div></div>
    </div>
    <div class="row">
      <div class="col-md-12"><div align=center><a href={{ url('/logout') }} class=menu>Wyloguj {{Auth::User()->login}}</a></div></div>
    </div>
  </div>
  <div id="center2">
  
  &nbsp;
  </div>
  <div id="page">
    @yield('content')
  </div>

</div>

