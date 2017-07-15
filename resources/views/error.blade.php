<link href="{{ asset('./style.css') }}" rel="stylesheet"> 
<link href="{{ asset('./bootstrap-3/css/bootstrap.min.css') }}" rel="stylesheet"> 
<script src="{{asset('./jquery.js')}}"></script>
<script src="{{asset('./funkcje.js')}}"></script>














<div id=login>
  <br><Br><br><Br>
  <div id=login_center>
    <div class="row">
    <form action={{ url('login3') }} method=post>
      
      <div class="col-md-12 col-xs-12"><div align=center><span class=blad>{{Session::get('login_error')}}</span></div></div>
      
    </div>

    
  </div>
  
</div>