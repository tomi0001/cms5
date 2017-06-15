@extends('layout.index')

@section('content')

	<table border=0 width=500 height=200 align=center>
	  <tr>
	    <td colspan=7><div align=center><span class=pogrubiona>{{$month1}} {{$years}}</span></div></td>
	  </tr>
	  <tr>
	  </tr>
	    <td><div align=center><span class=normalna2>Pon</span></div></td>
	    <td><div align=center><span class=normalna2>Wto</span></div></td>
	    <td><div align=center><span class=normalna2>śro</span></div></td>
	    <td><div align=center><span class=normalna2>Czwa</span></div></td>
	    <td><div align=center><span class=normalna2>Pią</span></div></td>
	    <td><div align=center><span class=normalna2>Sob</span></div></td>
	    <td><div align=center><span class=normalna2>Nie</span></div></td>
	  </tr>
	  <tbody>




  @for ($row=0;$row < 7;$row++) 

    <tr>
    
    @for ($column=0;$column < 7;$column++) 

      @if ($day2 <= $how_day_month ) 
	<td>
	
	@if ($day1 >= $day_week )
	  @if ( $day2 == $day3 ) 
	    <div align=center><span class=wieksza>{{$day2}}</span></div>

	  @elseif ( $day2 == $day ) 
	    <div align=center><span class=wieksza>{{$day2}}</span></div>
	  

	  @else 
	   <div align=center><a class=kalendarz href={{   url('login')}}/{{$years}}/{{$month}}/{{$day2}}  }}>{{$day2}}</a></div>
	  @endif
	  @php
	  $day2++;
	  @endphp
       
	@endif
	@php 
	$day1++;
	@endphp
	</td>
      @endif
    @endfor
    </tr>"

  @endfor;
  <tr>

</table>
<div class="row">
  <div class="col-md-2 col-xs-2"></div>
  <div class="col-md-4 col-xs-4"><a class=przycisk href={{ url('login')}}/{{$back[0]}}/{{$back[1]}}/1/wstecz>Wstecz</a></div>
  <div class="col-md-4 col-xs-4"><div align=right><a class=przycisk href={{ url('login')}}/{{$next[0]}}/{{$next[1]}}/1/dalej>dalej</a></div></div>
  
</div>




@for ($i=0;$i < count($select_drugs2);$i++) 
<div class=row>

  <div class="col-md-2 col-xs-2"></div>
  
  <div class="col-md-8 col-xs-8"><div align=center><{{$color[$i]}}>{{$select_drugs2[$i][0]}}</span></div></div>
  
  <div class="col-md-2 col-xs-2"></div>
</div>
@endfor

@endsection