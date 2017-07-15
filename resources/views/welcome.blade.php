
@extends('layout.index')

@section('content')
<meta content="text/html; charset=utf-8" http-equiv="content-type">
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
    </tr>

  @endfor
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
    <{{$color[$i]}}>
  <div class="col-md-8 col-xs-8">
    <div align=center>
        @if ($name_drugs[$i][0] == "") <br><span class=usunieta>Substancja tego wpisu została usunięta</span><br>
        @else 
	  <br>
	      Wziąłeś {{$name_drugs[$i][0]}} w dawce {{$select_drugs2[$i][1]}} {{$type[$i]}} <br>
	      Wziąłeś to w  {{$data[$i]}}  <br>
	      Wydałeś na to {{$price[$i]}} <br>
	      @if ($name_drugs[$i][6] != "" )
		<{{$color[$i]}}>
		Tyle alkoholu wypiłeś {{$percent[$i]}} mililitrów <br>
		<{{$color_end[$i]}}>
		@endif
		<{{$color[$i]}}>
		@if ($name_drugs[$i][5] != "" and $name_drugs[$i][5] != 0.00)
			<div id=benzo_rowno{{$i}}>Równoważnik dzienny diazepamu {{$equivalent[$i]}} mg</span></div><form method=get>	<input type=hidden id=benzo4{{$i}} value={{$equivalent[$i]}}>

  <div class=row>
   <div class="col-md-2 col-xs-2"></div>
   <div class="col-md-8 col-xs-8">
    <select id=benzo3{{$i}} class=form-control>
        @for ($z=0;$z < count($equivalent5);$z++)
            <option value={{$equivalent5[$z][0]}}>{{$equivalent5[$z][1]}}</option>

		 
	
        @endfor
	</select>
   </div>
   <div class="col-md-2 col-xs-2"></div>
  </div>
	
	<input type=button class="btn btn-danger" onclick=dodaj_rowno2('{{ url('/ajax/sum_equivalent') }}','{{$i}}')  value="Przelicz">
	<{{$color_end[$i]}}>
	<div id=opis444$i></div>
	<br>";
		
		
	      @endif
	      <a class=normalna2 onclick=add_registration('{{$i}}')>Dodaj opis</a>
	      <a class=normalna2 onclick=edit_registration('{{$i}}')>Edytuj wpis</a><br>
	      <a class=normalna2 onclick=show_average('{{ url('/ajax/average')}}','{{$name_drugs[$i][7]}}','{{$select_drugs2[$i][4]}}','{{$i}}')>pokaż średnią</a>
	      <a class=normalna2 onclick=sum_difference('{{url('/ajax/sum_difference')}}','{{$sum[$i]}}','{{$i}}')>Od tej daty</a><br>
	
        @endif
        
	  <a class=normalna2 onclick=delete_description('{{url('/ajax/delete_description')}}','{{$select_drugs2[$i][5]}}','{{$i}}')>
	      usuń wpis</a>
	      <a class=normalna2 onclick="load_description('{{url('/ajax/load_description')}}','{{$select_drugs2[$i][5]}}','{{$i}}')">pokaż opis</a>
	      <{{$color_end[$i]}}>
    </div>
  </div>
</div>

	      
	      	      <form method=get>
	      	 
	      	 
	      
<div class=row>
  <div class="col-md-3 col-xs-3"></div>
   <div class=edit1{{$i}}>
    <div class="col-md-3 col-xs-3">
      
	<span class=normalna3>Nazwa substancji</span>      
	      </div>
       
	
	<div class="col-md-3 col-xs-3">  
	
	   <select id=name1{{$i}} class=form-control>
	 @for ($z=0;$z < count($name_drugs6);$z++)
	 @if ($name_drugs[$i][7] == $name_drugs6[$z][$i][1]) 
	  <option value={{$name_drugs6[$z][$i][1]}} selected>{{$name_drugs6[$z][$i][0]}}</option>
	
	@else 
	  <option value={{$name_drugs6[$z][$i][1]}}>{{$name_drugs6[$z][$i][0]}}</option>
	@endif
		 
	
	@endfor
	
	</div>
       
  </div>
  

</div>
  <div class="col-md-1 col-xs-1"></div>
</select>	
	      
	            

	      
	      
</div>
</div>
  <div class="col-md-2 col-xs-2"></div>
</div>
<div class=row>
    <div class=edit1{{$i}}>
      <div class="col-md-3 col-xs-3"></div>
      <div class="col-md-2 col-xs-2">
	      <span class=normalna3>Porcja</span>
      
      
      </div>
      <div class="col-md-1 col-xs-1"></div>
      <div class="col-md-2 col-xs-2">
      <input class=form-control type=text id=name2{{$i}} value={{$select_drugs2[$i][1]}} size=5>
      </div>
   </div>
</div>
<div class=edit1{{$i}}>
  <div class=row>
  
    <div class="col-md-3 col-xs-3"></div>
      <div class="col-md-2 col-xs-2">
	<span class=normalna3>Data wzięcia</span>
      </div>
      <div class="col-md-1 col-xs-1"></div>
      <div class="col-md-2 col-xs-2">
	      

    <select id=years{{$i}} class=form-control>

    @for($j = $years3[$i];$j <= $years4[$i];$j++) 
    
      @if ($j == $years4[$i] ) <option value={{$j}} selected>{{$j}}</option>
      @else <option value={{$j}}>{{$j}}</option>
      @endif
    @endfor
    
    </select>
    
    </div>
         <div class="col-md-2 col-xs-2">
	      

    <select id=month{{$i}} class=form-control>

    @for($j = 1;$j <= 12;$j++) 
    
      @if ($j == $month2[$i] ) <option value={{$j}} selected>{{$j}}</option>
      @else <option value={{$j}}>{{$j}}</option>
      @endif
    @endfor
    
    </select>
    
    </div>

  </div>
  <div class=row>
  
    <div class="col-md-3 col-xs-3"></div>
      <div class="col-md-2 col-xs-2">
	<span class=normalna3></span>
      </div>
      <div class="col-md-1 col-xs-1"></div>
      <div class="col-md-2 col-xs-2">
	      

    <select id=day{{$i}} class=form-control>

    @for($j = 1;$j <= 31;$j++) 
      @if ($j == $day4[$i] ) <option value={{$j}} selected>{{$j}}</option>
      @else <option value={{$j}}>{{$j}}</option>
      @endif
    @endfor
    
    </select>
    
    </div>
    <div class="col-md-2 col-xs-2">
	      

    <select id=hours{{$i}} class=form-control>

    @for($j = 0;$j <= 23;$j++) 
      @if ($j == $hours[$i] ) <option value={{$j}} selected>{{$j}}</option>
      @else <option value={{$j}}>{{$j}}</option>
      @endif
    @endfor
    
    </select>
    
    </div>
   </div>
     <div class=row>
  
    <div class="col-md-3 col-xs-3"></div>
      <div class="col-md-2 col-xs-2">
	<span class=normalna3></span>
      </div>
      <div class="col-md-1 col-xs-1"></div>
      <div class="col-md-2 col-xs-2">
	      

    <select id=minutes{{$i}} class=form-control>

    @for($j = 0;$j <= 59;$j++) 
      @if ($j == $minutes[$i] ) <option value={{$j}} selected>{{$j}}</option>
      @else <option value={{$j}}>{{$j}}</option>
      @endif
    @endfor
    
    </select>
    
    </div>
   
   </div>
   
</div>

<div class=row>
  <div class=edit1{{$i}}>
    <div class="col-md-5 col-xs-5"></div>
      <div class="col-md-3 col-xs-3">
	<input type=button class="btn btn-danger" onclick=edit_registration2('{{ url('/ajax/edit_description') }}','{{$select_drugs2[$i][5]}}','{{$i}}')  value="Edytuj wpis">
      </div>
    <div class="col-md-4 col-xs-4"></div>  
  </div>
</div>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>
<div class="row">
    <div class="col-md-3 col-xs-3"></div>
    <div class="col-md-6 col-xs-6">
	      <div id=add1{{$i}}>
	      <form method=get>
	      <textarea id=add2{{$i}} class="form-control"></textarea><br>
      
	      <input type=button class="btn btn-danger" onclick=add_description2('{{ url('/ajax/add_description') }}','{{$select_drugs2[$i][5]}}','{{$i}}') value="Dodaj wpis">
	      <input type="hidden" name="_token" value="{{ csrf_token() }}">
	      </form>
      
	      </div>
    </div>
    <div class="col-md-3 col-xs-3"></div>
</div>
<div class="row">
  <div class="col-md-3 col-xs-3"></div>
  <div class="col-md-6 col-xs-6">
  
    <div id=description{{$i}}></div>
  </div>
</div>



@endfor
<div class="row">
    <div class="col-md-3 col-xs-3"></div>
    <div class="col-md-6 col-xs-6">
        @for ($i = 0;$i < count($table_drugs);$i++)
           <div align=center><span class=normalna3>{{$table_drugs[$i][0]}} = </span><span class=normalna4>{{$table_drugs[$i][1]}} {{$table_drugs[$i][2]}}</span>
            
        @endfor
    </div>
    <div class="col-md-3 col-xs-3"></div>
</div>
<script>

</script>
<script src="{{asset('./funkcje.js')}}"></script>
@endsection
