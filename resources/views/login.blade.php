<link href="{{ asset('./style.css') }}" rel="stylesheet"> 
<link href="{{ asset('./bootstrap-3/css/bootstrap.min.css') }}" rel="stylesheet"> 
<script src="{{asset('./jquery.js')}}"></script>
<script src="{{asset('./funkcje.js')}}"></script>














<div id=login>
  <br><Br><br><Br>
  <div id=login_center>
    <div class="row">
    <form action={{ url('login3') }} method=post>
      <div class="col-md-1 col-xs-1"> </div>
      <div class="col-md-5 col-xs-5"><span class=login>Twój login</span></div>
      <div class="col-md-5 col-xs-5"><input type=text class=form-control size=19 placeholder=login name=login></div>
    </div>
    <div class="row">
      <div class="col-md-1 col-xs-1"> </div>
      <div class="col-md-5 col-xs-5"><span class=login>Twoje hasło</span></div>
      <div class="col-md-5 col-xs-5"><input type=password class=form-control size=19 placeholder=hasło name=password></div>
    </div>
    <div class="row">
      <div class="col-md-1 col-xs-1"> </div>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="col-md-10 col-xs-10"><br><div align=center><button  class="btn btn-primary">Zaloguj</button></div></div>
    </form>
    </div>
    
  </div>
  
</div>