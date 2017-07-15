var i = 0;
var add;
//$("#opis_a").hide();
while (i < 4000 ) {
  add = "#add1" + i;
  edit = ".edit1" + i;
  description = "#description" + i;
  review = "#review" + i;
  $(add).hide();
  $(edit).hide();
  $(description).hide();
  $(review).hide();
  i++;
  
}
//alert('dobrze');
function add_registration(i) {
  //alert('dobrze');
  var variable = "#add1" + i;
  
  var variable2 = ".edit1" + i;
  if ($(variable2).is( ':visible' ) ) {
    $(variable2).fadeOut(300)
  }
  
    if (!$(variable).is( ':visible' ) ) {
      $(variable).fadeIn(300); 
    }
    else {
      $(variable).fadeOut(300)
    }
  //$(variable).toggle();

}

function edit_registration2(adress2,variable,i) {
  var name1 = "#name1" + i;
  var text = $(name1).val();
  text = escape(text);
  var name2 = "#name2" + i;
  name2 = $(name2).val();
  name2 = escape(name2);

  var minutes = "#minutes" + i;
  minutes = $(minutes).val();
  minutes = escape(minutes);

  var years = "#years" + i;
  years = $(years).val();
  years = escape(years);

  var month = "#month" + i;
  month = $(month).val();
  month = escape(month);

  var day = "#day" + i;
  day = $(day).val();
  day = escape(day);

  var hours = "#hours" + i;
  hours = $(hours).val();
  hours = escape(hours);
  //text = text + i;
  
  var adress = adress2  + "?id_wpisu=" +  variable + "&name1=" + text + "&name2=" + name2 + "&years=" + years + "&month=" + month + "&day=" + day + "&hours=" + hours + "&minutes=" + minutes;
  //alert(adress);
  var description = '#description' + i;
  //alert(adres);
  $(description).show();
  //$(description).slideUp(4000);
  $(description).load(adress);


}
function dodaj_rowno(zmienna) {
  //alert(zmienna2);
  //var adres = zmienna + zmienna2;
  //var i = zmienna3;
  //var opis = '#opis4' + i;
   var description = '#description' + i;
  var benzo = $("#benzo").val();
  var benzo2 = $("#benzo2").val();
  alert(benzo);
  //$(opis).toggle();
  
  //alert(zmienna2);
  var text = 2;
  var zmienna2 = zmienna + "?benzo=" + benzo + "&benzo2=" + benzo2 + "&text=" + text;
  $(description).load(zmienna2);

  //alert(zmienna);

}



function dodaj_rowno2(zmienna,i) {
  var benzo1 = "#benzo3" + i;
  var benzo11 = "#benzo4" + i;
  
  var benzo = $(benzo1).val();
  var benzo2 = $(benzo11).val();
  
  //$(opis).toggle();
  var text = 1;
  
  var zmienna2 = zmienna + "?benzo=" + benzo + "&benzo2=" + benzo2 + "&text=" + text;
  //alert(zmienna2);
  //alert(zmienna2);
  //alert(benzo);
  var description = '#benzo_rowno' + i;
  
  var status = $(description).load(zmienna2);
  //alert(status);
}
function load_description(variable,variable2,variable3) {
  
  //var adres = zmienna + zmienna2;
  var i = variable3;
  var variable = variable + "?id=" + variable2;
  var description = '#description' + i;
  $(description).toggle();
  $(description).load(variable);

  //alert(zmienna);

}
function delete_description(variable,variable2,i) {
  var result = confirm("Czy na pewno usunąć");
   var description = '#description' + i;
   if (result == true) {
     variable3 = variable + "?id=" + variable2;
    $(description).load(variable3); 
    $(description).toggle();
   }
  
}
function sum_difference(url,variable,i) {
  
  
  var variable2 = url + "?second=" + variable;
  $("#description" + i).load(variable2);
  
}

function show_average(url,id,id2,i) {
  ///srednia.php?id={{$select_drugs2[$i][5]}}&data={{$select_drugs2[$i][4]}}','{{$i}}')
  var url2 = url + "?id=" + id + "&data=" + id2
  //alert(url2);
  
  var variable = "#description" + i;
  $(variable).load(url2);
  $(variable).toggle();
}
function add_description2(url,id,i) {
  var add2 = "#add2" + i;
  var text = $(add2).val();
  text = escape(text);
  //text = text + i;
  var description = '#description' + i;
  var adres =  url + "?id=" + id +  "&add2=" + text;
  var opis = '#opis' + i;
  //alert(adres);
  $(description).show();
  $(description).load(adres);
}
function edit_registration(i) {
  var description = '#description' + i;
  var variable = ".edit1" + i;
  var variable2 = "#add1" + i;
  if ($(variable2).is( ':visible' ) ) {
    $(variable2).fadeOut(300)
  }
  //$(variable).toggle();
  //alert($(variable).toggle());
  if (!$(variable).is( ':visible' ) ) {
    $(variable).fadeIn(300); 
  }
  else {
    $(variable).fadeOut(300)
  }
  $(description).hide();
  //
   	/*
		      var target = $(variable);
		      target = target.length ? target : $('[name=' + url.slice(1) +']');
		      if (target.length) {
		        $('html, body').animate({
		          scrollTop: target.offset().top - $('.head').outerHeight() - 20
		        }, 1000);
		        return false;
		      }
	*/	    
  	
	
	
  
}
