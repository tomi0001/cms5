<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Input;
use DB;
use Auth;
use Hash;
//use Form;
//use App\User;
//namespace App\Http\Controllers\Auth;

/*

  git init
  git add README.md
  git commit -m "first commit"
  git remote add origin https://github.com/tomi0001/kale_2017.git
  git push -u origin master
  

…or push an existing repository from the command line

git remote add origin https://github.com/tomi0001/kale_2017.git
  git push -u origin master
  */
class Controller extends BaseController
{
    public $data = "";
    private $day_week = [
        'Monday' => "Poniedziałek",
        'Tuesday' => 'Wtorek',
        'Wednesday' => 'Środa',
        'Thursday' => 'Czwartek',
        'Friday' => 'Piątek',
        'Saturday' => 'Sobota',
        'Sunday' => 'Niedziela',
    ];

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function login() {
      if (!empty(Auth::User()->id))  return Redirect('login');
      return view('login');
      
    }
    

    
    public function ajax2() {
      $text = str_replace("\n","<br>",Input::get('add2'));
    
        if (empty(Auth::User()->id)) {
	  print ("<div align=center><span class=blad>Musisz się ponownie zalogować</span></div>");
	  
	} 
	else if ($text == "") print "<span class=blad>Musisz wpisać jakąś wartość</span>";
	else {
	
	  //$text = add2{{$i}};
	  
	  $id = Input::get('id');
	    //print $text;
	  
	  $add = DB::select("select opis_spozycia from spozycie where id = '$id' ");
	  foreach ($add as $add2) {
	  
	  }
	  
	  $data = date("Y-m-d H:i:s");
	  $registration = $add2->opis_spozycia . "<br>" . $data . "<br>" . $text;
	  //print $registration;
	  $update = array('opis_spozycia' => $registration);
	  DB::table('spozycie')->where('id', $id)->update($update);
	  //$baza->query("update spozycie set opis_spozycia = '$wpis' where id = '$id_substancji' ");
	  //return "<span class=normalna3>Pomyślnie dodano dane</font>";
	  if ($text != "") {
	    print "<span class=succes>Pomyślnie dodano</span>";
	  }
	}
	
      
    
    
    
    
    }
    
    public function ajax3() {
    
	//print "dobrze";
	if (empty(Auth::User()->id)) {
	  print ("<div align=center><span class=blad>Musisz się ponownie zalogować</span></div>");
	  
	}
	else {
	  $id = Input::get('id');
	  $description = DB::select("select opis_spozycia from spozycie where id = '$id' ");
	  foreach ($description as $description2) {
	  
	  }
  
	if ($description2->opis_spozycia == "") {
	  print "<div align=center><span class=blad> Do tego wzięcia substancji nie wprowdziłeś tekstu</span></div>";
	}
	else {
	  //$opis[0] = charset_utf_fix($opis[0]);
	  $description2->opis_spozycia = $this->charset_utf_fix($description2->opis_spozycia);
	  print "<div align=center><span class=normalna3>" . $description2->opis_spozycia  . "</span></div>";
	}
	
      }
      
      
      
    
    
    
    }
    
    public function ajax4() {
      	if (empty(Auth::User()->id)) {
	  print ("<div align=center><span class=blad>Musisz się ponownie zalogować</span></div>");
	  
	}
	else {
	  $id_users = Auth::User()->id;
	  $id = Input::get('id');
	  
	  
	  $wynik = DB::delete("delete from spozycie where id = '$id' and id_usera = '$id_users' ");
   
	
	  print "<div align=center><span class=normalna3>Pomyślnie usunięte</span></div>";
	  
	}
      
      
      
    }
    
    public function ajax5() {
        if (empty(Auth::User()->id)) {
	  print ("<div align=center><span class=blad>Musisz się ponownie zalogować</span></div>");
	  
	}
	else {
	  $id_users = Auth::User()->id;
	  $variable = Input::get('second');
	  
	  $result = $this->check_difference($id_users,$variable);
	  print $result;
  //print $zmienna;
  
  //$sekundy = $obiekt_data->oblicz_roznice_sekund(2000);
  //print $sekundy;
  if ($result != false) {
  $this->add_difference2($id_users,$variable);
  $result = $this->check_difference2($id_users,$variable);
  $second = $this->sum_difference_second($result);
    print ("
    <script language=javascript>
    alert('od w  źięcia óóóó tych $second');
    
    </script>
    ");

  }
      
      }
      
      
      
    }
    

    
    
    
    
    private function sum_average_drugs($id_drugs,$data2) {
      //print $id_drugs;
      $data_new = $data2;
      
      $number_of_days = DB::select("select DATEDIFF(data2,'$data_new') AS DiffDate, porcja, data2 from spozycie where id_substancji='$id_drugs' and data2 <= '$data_new' group by data2 order by DiffDate desc");
      
      //$number_of_days = DB::table('spozycie')->select(DB::raw("DATEDIFF(data,'$data_new') AS DiffDate, porcja, data"))->where('id_substancji', '=', $id_drugs)->groupBy('data')->get();
      
      $i = 0;
      $array_data = array();
      $array_data2 = array();
      foreach ($number_of_days as $number_of_days2) {
	//print "d";
	$array_data[$i] = $number_of_days2->DiffDate;
	$temporary = $array_data[$i];
	//if ($i > 0) {
	//$aa = $array_data[$i-1]-1;
	//print "<font color=red>" . $aa . "</font>";
	//print $number_of_days2->data . "<br>";
	//}
	$array_data2[$i] = $number_of_days2->data2;
	//print $number_of_days2->DiffDate;
	if ($i > 0 and $array_data[$i-1]-1 != $temporary) {
	  
	  break;
	}
	$i++;
      }
      //print $array_data2[$i-1];
      $data_start = $array_data2[$i-1];
      $sum = DB::select("select sum(porcja) as porcja2 from spozycie where id_substancji = '$id_drugs' and  data2 <= '$data_new'  and data2 >= '$data_start'");
      foreach ($sum as $sum2) {}
      return array(round($sum2->porcja2 / $i,2),$i);
      
      //print $id_drugs;
      
   /*
    $data1 = "2009-04-01" . poczatek_dnia;
    $data2 = $data2 . poczatek_dnia;
    //print $data2;
    $data = explode(" ",$data2);
    $data22 = explode("-",$data[0]);
    $data33 = explode(":",$data[1]);
    $dni = mktime($data33[0],$data33[1],$data33[2],$data22[1],$data22[2],$data22[0]);
    $dni2 = $dni;
    $data = new data;
    $roznica = $data->oblicz_liczbe_dni($data1,$data2);
    //print $roznica;
    $data11 = $data1;
    for ($i=0;$i <=$roznica;$i++) {
      $data11 = date("Y-m-d H:i:s",$dni-86400);
      $data111 = date("Y-m-d H:i:s",$dni);
      $dni -= 86400;
      $dd = $baza->query("select porcja from spozycie where id_substancji = '$id_substancji' and data >= '$data11'  and data <= '$data111' ");
      $dd = mysqli_fetch_array($dd);
      if ($dd[0] == "") {
	$data11 = date("Y-m-d H:i:s",$dni);
	break;
      }
      
    }
    $data222 = $dni2 + 86400;
    
    $data222 = date("Y-m-d H:i:s",$data222);
    //print $data2;
    $suma2 = $baza->query("select sum(porcja) from spozycie where id_substancji = '$id_substancji' and  data <= '$data222'  and data >= '$data11'");
    $suma2 = mysqli_fetch_array($suma2);
    return array($suma2[0],$i+1);
   */ 
  }
    
    
    
    
    private function  check_portions($type_portions) {
      if ($type_portions == 1) return "mg";
      if ($type_portions == 2) return "mililitry";
      if ($type_portions == 3) return "ilości";
      //if ($rodzaj_porcji == 4) return "gramy";
      //if ($rodzaj_porcji == 5) return "mililitry";
      //if ($rodzaj_porcji == 6) return "litry";
    }
    


    
    
    public function ajax6() {
      //print "dobrze";
    
      $result = $this->sum_average_drugs(Input::get('id'),Input::get('data'));
      $id = Input::get('id');
      $id_users = Auth::User()->id;
      $question = DB::select("select rodzaj_porcji from substancje where id = '$id' and id_usera = '$id_users' ");
      foreach ($question as $question2) {}
      $type = $this->check_portions($question2->rodzaj_porcji);
      print "<span class=normalna3>Średnia dawka to " . $result[0] . $type .   " bierze ją od " . $result[1] . " dni </span>";
      
      /*
      $wynik = $substancja->oblicz_srednia_sub($id,$data);
      $wynik2 = $wynik[0] / $wynik[1];
      $wynik2 = round($wynik2,2);
      print "<span class=normalna2>średnia dawka $wynik2 $rodzaj na dzień bierzesz to od $wynik[1] dni</span>";
      
    */
    
    
    }
    
      private function sum_difference_second2($hours1,$hours2,$minutes1,$minutes2,$second1,$second2) {
	$number_second1 = mktime($hours1,$minutes1,$second1,1,1,1970);
	$number_second2 = mktime($hours2,$minutes2,$second2,1,1,1970);
	return array($number_second1,$number_second2);
      }
    
    private function check_difference($id_users,$data) {
    
    $check = DB::select("select data1,data2 from roznica where id_usera = '$id_users' ");
    $check3 = "";
    $check4 = "";
    foreach ($check as $check2) {
      $check3 = $check2->data1;
      $check4 = $check2->data2;
    }
    if ($check3 != "" and $check4 != "") {
      //print "<script language=javascript> alert('dobrze'); </script>";
      $this->clear_difference($id_users);
      $this->add_difference($id_users,$data); 
      $this->check_difference($id_users,$data); 
    }
    else if ($check3 == "" and $check4 == "") {
      $this->add_difference($id_users,$data); 
      //$this->sprawdz_roznice($id_usera,$data);     
      return false;
      }
      else if ($check4 == "") return $check3;
    }	
    
    
    
   public function check_difference2($id_users,$data) {
    $check = DB::select("select data1,data2 from roznica where id_usera = '$id_users' ");
    foreach ($check as $check2) {}
    if ($check2->data1 < $check2->data2) $result = $check2->data2 - $check2->data1;
    else $result = $check2->data1 - $check2->data2;
    return $result;
  }
  
  public function clear_difference($id_users) {
    $check = DB::select("select id_usera from roznica where id_usera = '$id_users' ");
    $check3 = "";
    foreach ($check as $check2) {
      $check3 = $check2->id_usera;
    }
    //if ($check3 == "") DB::select("delete from roznica where id_usera = '$id_users' ");
    
  }
  
    
  private function add_difference($id_users,$data) {

    DB::insert("insert into roznica(id_usera,data1) values('$id_users','$data')");
    
  }

  
  
  /*
    private function sum_difference_second($sekundy) {
    $wynik = $sekundy / 3600;
    if ( strstr($wynik,".") ) { 
      $godzina = explode(".",$wynik);
    }
    else {
      $godzina[0] = $wynik;
      return $godzina[0] . "Godzin";
    }
    $minuty = "0." . $godzina[1];
    $minuty = $minuty * 60;
    if ( strstr($minuty,".") ) {
      $minuty2 = explode(".",$minuty);
    }
    else {
      $minuty2[0] = $minuty;
    }
    $minuty3 = $minuty2[0];
    
    $sekundy = "0." . $minuty2[1];
    //$sekundy = "0." . $godzina[1];
    $sekundy = $sekundy * 60;
    if ( strstr($sekundy,".") ) {
      $sekundy2 = explode(".",$sekundy);
    }
    else {
      $sekundy2[0] = $sekundy;
    }
    $sekundy3 = $sekundy2[0];
    //if ($minuty > 1) $sekundy3++;
    $zmienna = "";
    if ($godzina[0] != 0) $zmienna .= $godzina[0] . " godzin i "; 
    if ($minuty3 != 0) $zmienna .= $minuty3 . " minut i ";
    if ($sekundy3 != 0) $zmienna .= $sekundy3 . " sekund";
    return $zmienna;
    
  }
  */
  
    private function sum_difference_second($second) {
    $result = $second / 3600;
    if ( strstr($result,".") ) { 
      $hours = explode(".",$result);
    }
    else {
      $hours[0] = $result;
      return $hours[0] . "Godzin";
    }
    $minutes = "0." . $hours[1];
    $minutes = $minutes * 60;
    if ( strstr($minutes,".") ) {
      $minutes2 = explode(".",$minutes);
    }
    else {
      $minutes2[0] = $minutes;
    }
    $minutes3 = $minutes2[0];
    
    $second = "0." . $minutes2[1];
    //$sekundy = "0." . $godzina[1];
    $second = $second * 60;
    if ( strstr($second,".") ) {
      $second2 = explode(".",$second);
    }
    else {
      $second2[0] = $second;
    }
    $second3 = $second2[0];
    //if ($minuty > 1) $sekundy3++;
    $variable = "";
    if ($hours[0] != 0) $variable .= $hours[0] . " godzin i "; 
    if ($minutes3 != 0) $variable .= $minutes3 . " minut i ";
    if ($second3 != 0) $variable .= $second3 . " sekund";
    return $variable;
    
  }
  
  
  
  public function add_difference2($id_users,$data) {
    
    //$baza->query("insert into roznica(id_usera,data2) values('$id_usera','$data')")
    $update = array('data2' => $data);
    DB::table('roznica')->where('id_usera', $id_users)->update($update);
    //DB::insert("update roznica set data2 = '$data'  where id_usera = '$id_usera' ");
    
  }
    private  function charset_utf_fix($string) {
 
	$utf = array(
	 "%u0104" => "Ą",
	 "%u0106" => "Ć",
	 "%u0118" => "Ę",
	 "%u0141" => "Ł",
	 "%u0143" => "Ń",
	 "%u00D3" => "Ó",
	 "%u015A" => "Ś",
	 "%u0179" => "Ź",
	 "%u017B" => "Ż",
	 "%u0105" => "ą",
	 "%u0107" => "ć",
	 "%u0119" => "ę",
	 "%u0142" => "ł",
	 "%u0144" => "ń",
	 "%u00F3" => "ó",
	 "%u015B" => "ś",
	 "%u017A" => "ź",
	 "%u017C" => "ż"
	);
	
	
	
	
	
	return str_replace(array_keys($utf), array_values($utf), $string);
	
  }
    
    public function ajax1() {
    
	
        if (empty(Auth::User()->id)) {
	  print ("<div align=center><span class=blad>Musisz się ponownie zalogować</span></div>");
	  
	} 
	else {
	  $name1 =  Input::get('name1');
	  $name2 =  Input::get('name2');
	  $id_registration =  Input::get('id_wpisu');
	  $years =  Input::get('years');
	  $month =  Input::get('month');
	  $day =  Input::get('day');
	  $hours =  Input::get('hours');
	  $minutes =  Input::get('minutes');
	  
	  $check_drugs = DB::select("select id,rodzaj_porcji from substancje where id = '$name1' ");
	  foreach ($check_drugs as $check_drugs2) {
	    
	  }
	  if ($check_drugs2->id == "") {
	    print "<div align=center><span class=blad>Nie ma takie substancji w bazie danych musisz ją napierw dodać</span></div>";
	  }
	  elseif ($name2 == "") {
	    print  "<div align=center><span class=blad>Nie ustaliłeś dawki</span></div>";
	   return;
	  }
	  //if ($rok != "" or $miesiac != "" or $dzien != "" or $godzina != "" or $minuta != "") {
	  elseif ($years != "" and $month != "" and $day != "" and $hours != "" and $minutes != "") {
	  	  

	    $data1 = $years . "-" . $month . "-" . $day;
	    $data2 = $data1 . " " . $hours . ":" . $minutes . ":" . "00";
	    $check = checkdate($month,$day,$years);
	    $second = mktime($hours, $minutes, 0, $month, $day, $years);
	    if ($second > date("U") ) {
	      print  "<div align=center><span class=blad>Podana data jest większa od teraźniejszej daty</span></div>";
	      return;
	    }
	    elseif ($check == false) {
	      print  "<div align=center><span class=blad>Niepoprawna data</span></div>";
	      return;
	    }
	  }
	  else {
	    print  "<div align=center><span class=blad>Uzupełnij dobrze data wzięcia</span></div>";
	    return;
	  }
    //}
    //$baza->query("insert into spozycie(porcja,data,opis_spozycia,id_usera,rodzaj_porcji,id_substancji,data2) values ('$dawka','$data2','$opis','$user2','$sprawdz_substancje[1]','$sprawdz_substancje[0]','$data1')");
      $id_usera = Auth::User()->id;
    //$baza->query("update spozycie set porcja='$dawka',data='$data2',id_usera='$user2',rodzaj_porcji='$sprawdz_substancje[1]',id_substancji='$sprawdz_substancje[0]',data2='$data1' where id = '$id_wpisu' ");
    $update = array('porcja' => $name2,'data' => $data2,'id_usera' => $id_usera,'rodzaj_porcji' => $check_drugs2->rodzaj_porcji,'id_substancji' => $check_drugs2->id,'data2' => $data1);
        DB::table('spozycie')->where('id', $id_registration)->update($update);
    
            print  "<div align=succes><span class=blad>Pomyślnie zmodyfikowałęś</span></div>";
            
    
	}
      
       
    
    }
    
    private function set_date($month,$action,$day,$years) {
            if (empty($month) ) {
	  $month = date("m");
	  $years = date("Y");
	}
	
	if ( empty($day) and empty($action) ) {
	  $day = date("d");
	}
	else {
	  if ( !empty($day) ) {
	    $day = $day;
	  }
	  //$month = $month;
	  //$years = $years;
	}
	
	if ( !empty($years) or  !empty($month)) {
	//$_GET["rok"] = atak_sql($_GET["rok"]);
	//$_GET["miesiac"] = atak_sql($_GET["miesiac"]);
	//$rok = $_GET["rok"];
	//$miesiac = $_GET["miesiac"];
	$day_week = $this->check_day_week("$years-$month-1");
      }
      else {
	$years = date("Y");
	$month = date("m");
	$day_week = $this->check_day_week("Y-m-1");
      }
  
      if ($day_week == 0) {
	  $day_week = 7;
      }
	
	return array($month,$years,$day,$day_week,$action);
    }
    public function login2($years = "",$month="",$day="",$action = "") {
    
    //Input::get('month');
	if (empty(Auth::User()->id)) {
	  return Redirect('error')->with('login_error','Musisz się zalogować');
	}
      $date = $this->set_date($month,$action,$day,$years);
	
	 //oblicza w kt rym dniu zacza  si  dany miesiac 


  $day1 = 1;
  $day2 = 1;
  $day3 = "";
  if (!empty($date[4]) ) {
    if ($date[4] == "wstecz") {
      $day3 = $this->sum_how_day_month($date[0],$date[1]);
      //$_GET["dzien"] = $dzien3;
    }
    if ($date[4] == "dalej")  {
      $day3 = 1;
      //$_GET["dzien"] = 1;
    }
    $date[2] = $day3;
  }
	

      $month2 = $this->return_month_text($date[0]);
      $how_day_month = $this->sum_how_day_month($date[0],$date[1]);
      $back = $this->return_back_month($date[0],$date[1]);
      $next = $this->return_next_month($date[0],$date[1]);
      
      $this->delete_differences(Auth::User()->id);
      if ($date[1] == "" and $date[0] == "" and $date[2] == "") {  
	  $date[1] = date('Y');
	  $date[0] = date('m');
	  $date[2] = date('d');
      }
    
    $start_day = $this->Calculate_date_beginning_of_the_day($date[1],$date[0],$date[2]);
    $id_users = Auth::User()->id;
    //print $start_day[1];
    $select_drugs = DB::select("select id_substancji,porcja,data,rodzaj_porcji,data2,id from spozycie where id_usera = '$id_users'  and data >= '$start_day[0]' and data <= '$start_day[1]'  order by data");
    
    //$kolor = "<span class=normalna2>";
    //$kolor2 = "<span class=normalna3>";
    $kol = "<span ";
    $i = 1;
    $price = array();
    $table_substances = array();
    $benzo = 0;
    $alcohol = 0;
    $select_drugs3 = array();
    $color = array();
    $sum = array();
    $name_drugs = "";
    $data = array();
    $color2 = array();
    $type = array();
    $color_end = array();
    $name_drugs3 = array();
    $name_drugs6 = array();
    $years3 = "";
    $years4 = "";
    $month3 = array();
    $day4 = array();
    $hours = array();
    $minutes = array();
    $data3 = array();
    $data4 = array();
    $percent = array();
    $alcohol = 0;
    $equivalent = array();
    $equivalent5 = array();
    $equivalent2 = 0;
    $j = 0;
    foreach ($select_drugs as $select_drugs2 ) {
      $name_drugs = DB::select("select nazwa,cena,rodzaj_porcji,za_ile,color,rownowaznik,ile_procent,id from substancje where id = '" . $select_drugs2->id_substancji . "' ");
      foreach ($name_drugs as $name_drugs2) {
	$name_drugs3[$j][0] = $name_drugs2->nazwa;
	$name_drugs3[$j][5] = $name_drugs2->rownowaznik;
	$name_drugs3[$j][6] = $name_drugs2->ile_procent;
	$name_drugs3[$j][7] = $name_drugs2->id;
	//print "kupa";
      }

      if ($name_drugs2->color != "") {
	$color[$j] = "font color=" . $name_drugs2->color ." size=3";
	$color2[$j] = "<font color=" . $name_drugs2->color  . " size=3";
	$color_end[$j] = "/font";
      }
      else {
	$color[$j] = "span class=normalna2";
	$color2[$j] = "<span class=normalna3";      
	$color_end[$j] = "/span";
	
      }
      
      $select_drugs3[$j][0] = $name_drugs2->nazwa;
      $select_drugs3[$j][1] = $select_drugs2->porcja;
      $select_drugs3[$j][2] = $select_drugs2->data;
      $select_drugs3[$j][3] = $select_drugs2->rodzaj_porcji;
      $select_drugs3[$j][4] = $select_drugs2->data2;
      $select_drugs3[$j][5] = $select_drugs2->id;
      $select_drugs3[$j][6] = $select_drugs2->id_substancji;
      $data_111 = explode(" ",$select_drugs2->data);
      $data_222 = explode("-",$data_111[0]);
      $data_333 = explode(":",$data_111[1]);
      $sum[$j] = mktime($data_333[0],$data_333[1],$data_333[2],$data_222[1],$data_222[2],$data_222[0]);
      //$tablica_substancji[$i-1][0] = $nazwa_substancji[0];
      //$tablica_substancji[$i-1][1] = $wybierz_leki2[1];
      //$tablica_substancji[$i-1][2] = $wybierz_leki2[3];
      $price2  = 0;
      $price[$j] = $this->sum_price_drugs($name_drugs2->za_ile,$select_drugs2->porcja,$name_drugs2->cena);
      $price2 += $price[$j];
      $price[$j] = $this->sum_price($price[$j]);
      $type[$j] = $this->check_portion($name_drugs2->rodzaj_porcji);
      $data[$j] = $this->sum_date($sum[$j],$select_drugs2->data);
      //print( $color . $i);  
      $name_drugs4 = DB::select("select nazwa,id from substancje where id_usera = '$id_users' ");
      $z = 0;
      foreach( $name_drugs4 as $name_drugs5) {
	$name_drugs6[$z][$j][0] = $name_drugs5->nazwa;
	$name_drugs6[$z][$j][1] = $name_drugs5->id;
	$z++;
      }
         $years2 = DB::select("select data2 from spozycie where id_usera = '$id_users' order by data2 ASC limit 1");
	//$years2 = mysqli_fetch_array($years2);
	foreach ($years2 as $years22) {
	  $years222 = $years22->data2;
	}
	$years33 = explode("-",$years222);
	$years3[$j] = $years33[0];
	//$data = date("Y-n-d");

	$data2 = explode(" ",$select_drugs2->data);
	$data3 = explode("-",$data2[0]);
	$data4 = explode(":",$data2[1]);
	
	$hours[$j] = $data4[0];
	$years4[$j] = $data3[0];
	$day4[$j] = $data3[2];
	$month3[$j] = $data3[1];
	$minutes[$j] = $data4[1];
	//print $data4[1];
	//print $years3 . "<br>";
      //$obiekt_data->oblicz_date($sum,$select_drugs->data);
      //var_dump($hours);
      
      if ($name_drugs3[$j][6] != "") {
	$percent[$j] = $this->sum_percent($select_drugs3[$j][1],$name_drugs3[$j][6]);
	$alcohol += $percent[$j]; 
	
      }
    if ($name_drugs3[$j][5] != "" and $name_drugs3[$j][5] != 0.00) {
        $equivalent[$j] = $this->draw_equivalent($select_drugs3[$j][6],$select_drugs3[$j][1],$id_users);
        $equivalent2 += $equivalent[$j];
        $equivalent3 = DB::select("select rownowaznik,nazwa,id from substancje where rownowaznik != '' and id_usera = '$id_users' ");
            $z = 0;
            foreach ($equivalent3 as $equivalent4 ) {
                
                
                $equivalent5[$z][0] = $equivalent4->id;
                $equivalent5[$z][1] = $equivalent4->nazwa;
                $z++;
            }
            //var_dump($rownowaznik5);
      }
      /*
      if ($nazwa_substancji[5] != "" and $nazwa_substancji[5] != 0.00) {
	$rownowaznik = rysuj_rownowaznik($kolor2,$i,$wybierz_leki2[0],$wybierz_leki2[1],$id_usera);
	$rownowaznik2 += $rownowaznik;
      }
      //if ($rownowaznik != false) {
	print "<div id=opis$i></div>";
	print "<div id=opisz$i></div>";
	
      //}
      print ("</span></div></td></tr>
      ");
      $kolor = " class=normalna2";
      $i++;
      */
      $i++;
      $j++;//$j,$rok2,$rok3,$data3[0]);
    }
    $table_drugs = $this->sort_drugs($start_day[0],$start_day[1],$id_users);

      //var_dump($name_drugs6);
      return view('welcome')->with('month',$date[0])->with('years',$date[1])->with('day1',$day1)->with('day2',$day2)->with('day3',$day3)->with('how_day_month',$how_day_month)->with('day_week',$date[3])->with('day',$date[2])->with('month1',$month2)->with('back',$back)->with('next',$next)->with('select_drugs2',$select_drugs3)->with('color',$color)->with('color2',$color2)->with('name_drugs',$name_drugs3)->with('data',$data)->with('price',$price)->with('sum',$sum)->with('type',$type)->with('name_drugs6',$name_drugs6)->with('color_end',$color_end)->with('years3',$years3)->with('years4',$years4)->with('month2',$month3)->with('day4',$day4)->with('hours',$hours)->with('minutes',$minutes)->with("percent",$percent)->with("equivalent",$equivalent)->with("equivalent5",$equivalent5)->with('table_drugs',$table_drugs);
    
    }
    
    

    
    
 
   private  function sort_drugs($data1,$data2,$id_users) {
  
  $table = array();
  $i = 0;
  $qestions = DB::select("select sum(porcja) as porcja2,id_substancji,rodzaj_porcji from spozycie where data >= '$data1' and data <= '$data2' and id_usera = '$id_users' group by id_substancji");
  foreach ($qestions as $qestions2) {
    $name_drugs = DB::select("select nazwa from substancje where id = '" . $qestions2->id_substancji .  "' ");
    foreach ($name_drugs as $name_drugs2) {}
    $type_portions = $this->check_portions($qestions2->rodzaj_porcji);
    if ($name_drugs2->nazwa == "") {
      $table[$i][0] = "<span class=usunieta>Substancja usunięta</span>";
    }
    else {
      $table[$i][0] = $name_drugs2->nazwa;
    }
    $table[$i][1] = $qestions2->porcja2;
    $table[$i][2] = $type_portions;
    //print $tablica[$i][0] . "<br>";
    //print $tablica[$i][1] . "<br>";
    //print $tablica[$i][2] . "<br>";
    $i++;
  }
  
  return $table;
}
    
    private  function draw_equivalent($select_drugs3,$select_drugs2,$id_users) {
  	$equivalent = $this->check_equivalent($select_drugs3,$select_drugs2,true);
	//$rownowaznik2 += $rownowaznik;
	

	
  
	return $equivalent;
  }
  
  
  public function ajax7() {
  
         if (empty(Auth::User()->id)) {
	  print ("<div align=center><span class=blad>Musisz się ponownie zalogować</span></div>");
	  
	} 
	
	
	$benzo =  Input::get('benzo');
$benzo2 = Input::get('benzo2');
$text = Input::get('text');
//print $benzo;
  $sum = DB::select("select nazwa from substancje where id = '$benzo' ");
  foreach ($sum as $sum2) { }
  $equivalent = $this->check_equivalent($benzo,$benzo2,false);
  if ($text == 1) {
    print "<span class=normalna2>Równoważnik dzienny diazepamu to $equivalent mg " . $sum2->nazwa . "</span>";
  }
  else {
    print "<span class=normalna2>W sumie tego dnia wziąłeś $equivalent mg " . $sum2->nazwa . "</span>";
  }




  
  
  }
  
    private   function check_equivalent($id_drugs,$dose_end,$status) {
        $check3 = array();
        $check = DB::select("select rownowaznik from substancje where rownowaznik != '' and id = '$id_drugs' and rownowaznik != '0.00'");
        foreach ($check as $check2) {
            $check3[0] = $check2->rownowaznik;
        }
        //var_dump($sprawdz3);
        //$sprawdz2 = $baza->query("select rownowaznik from substancje where id = '$id_substancji2' ");
        //$sprawdz2 = mysqli_fetch_array($sprawdz2);
        if ($check3[0] == "") return false;
        if ($status == true) $sum = $this->sum_equivalent(10,$check3[0],$dose_end);
        else $sum = $this->sum_equivalent($check3[0],10,$dose_end);
        //print $oblicz = oblicz_rownowaznik(10,20,5) . "<br>";
        return $sum;
    }
    private   function sum_equivalent($equivalent_diazepam,$equivalent_x,$dose_end) {
        return ($dose_end / $equivalent_x) * $equivalent_diazepam;
    
    }
    private function sum_percent($porcion,$how_percent) {
    //$zaladuj_procent = mysql_query("select ile_procent from substancje where id = '$id' ");
    //$zaladuj_procent = mysql_fetch_array($zaladuj_procent);
    //if ($zaladuj_procent[0] == "") return false;
    
      $divide = explode("/",$how_percent); 
    //print $podziel[0];
      $result = $divide[1] / $divide[0];
      return $result * $porcion;
    
     }
    
      private function sum_date($data,$data2) {
    $time_present = time();
    $time_add = $time_present - $data;
    if ($time_add <= 3600) {
      $minutes = $this->sum_how_second_in_minutes($time_add);
      $this->data = "Mniej niż $minutes minuty temu" ;
    }
    else {

      $data2_division = explode(" ",$data2);
      $data2_division3 = explode(":",$data2_division[1]);
      $day_week = date("l",strtotime($data2));
      $day_week2 = $this->sum_day_week($day_week);   
      if ($data2_division3[0] < 5 or $data2_division3[0] == 0) {
	if ($data2_division3[0] == 0) $data2_division3[0] = 24;
	    $poprzedni_dzien = $this->sum_back_day($day_week2);
	    return  "W nocy z " . $poprzedni_dzien . " na " .  $day_week2  .  " o godzinie " . $data2_division3[0] . " i minucie " . $data2_division3[1];
	}
	else {
	    return  $day_week2 . " o  godzinie " . $data2_division3[0] . " i minucie " . $data2_division3[1];
	}
	//}
    }
  }
    private function sum_how_second_in_minutes($second) {
  
    $minutes =  $second / 60;
    return (int) $minutes + 1;
  
  }
    private function sum_day_week($day_week) {
     //$value = "Niedziela";
     foreach ($this->day_week as $key => $value) {
        if (strstr($day_week, $key)) return $value;
     }
     return $value;
  }
    
  private function sum_back_day($day) {
  
    switch($day) {
      case "Poniedziałek" : return "Niedzieli";
      case "Wtorek" : return "Poniedziałku";
      case "Środa" : return "Wtorku";
      case "Czwartek" : return "Środy";
      case "Piątek" : return "Czwartku";
      case "Sobota" : return "Piątku";
      default : return "Soboty";
    }
  
  }
   private function check_portion($type_portion) {
    if ($type_portion == 1) return "mg";
    if ($type_portion == 2) return "mililitry";
    if ($type_portion == 3) return "ilości";
    //if ($rodzaj_porcji == 4) return "gramy";
    //if ($rodzaj_porcji == 5) return "mililitry";
    //if ($rodzaj_porcji == 6) return "litry";
  }
      private  function sum_price($number) {
    
      //$liczba_odwrotna = strrev($liczba);
	//print $liczba_odwrotna . "<br>";
      $number = round($number,2);
    
      if ( !strstr($number,".") ) {
	
	return $number . " zł";
      }
      else {
      

	$number2 = explode(".",$number);
	//$liczba2 = substr($liczba2[1],0,2);
	$number3 = strlen($number2[1]);
	if ($number3 == 1) {
	  $number2[1] .= "0";
	}
	if ( $number2[0][0] == 0) {
	  return $number2[1] . " gr";
	}
	else {
	  return $number2[0] . " zł i " . $number2[1] . " gr";
	}
      }
    
    
    
  }
  private function sum_price_drugs($for_much,$portion,$price) {
    if ($for_much == 0) return 0;
    return $price * $portion / $for_much;
  }
   private function delete_differences($id_users) {
    
    DB::delete("delete from roznica where id_usera = '$id_users' ");
    }
    public function logout() {
      Auth::logout();
      return Redirect('succes')->with('login_succes','Wylogowałeś się pomyślnie');
      
    }
    public function succes() {
      
      return view('succes');
    }
   private function Calculate_date_beginning_of_the_day($years,$month,$day) {

    $date_show = $years . "-" . $month . "-" . $day;
    $start_day = ' 05:00:00';
    $date_show2 = $date_show . $start_day;
    //$data_pokazania4 = $data_pokazania3 . " 05:00:00";
    $time_day = strtotime($date_show2);
    $time_day2 = date("Y-m-d H:i:s",$time_day);
    $time_day3 = date("Y-m-d H:i:s",$time_day+86400);
  
    return array($time_day2,$time_day3);
  
  }
    
   private function return_month_text($month) {
    
    switch($month) {
      case 1 : return "Styczeń";
      case 2 : return "Luty";
      case 3 : return "Marzec";
      case 4 : return "Kwiecień";
      case 5 : return "Maj";
      case 6 : return "Czerwiec";
      case 7 : return "Lipiec";
      case 8 : return "Sierpień";
      case 9 : return "Wrzesień";
      case 10 : return "Październik";
      case 11: return "Listopad";
      case 12 : return "Grudzień";
    }

  }
  
    private function return_back_month($month,$years) {
    if ($month == 1) {
      $years--;
      $month = 12;
    }
    else {
      $month--;
    }
    return array($years,$month);
  }

  private function return_next_month($month,$years) {
    if ($month == 12) {
      $years++;
      $month = 1;
    }
    else {
      $month++;
    }
    return array($years,$month);
  }
  
  private function check_day_week($data) {

      //$dzien_tyg = date("w",strtotime($data));
      //return $dzien_tyg; 
      return date("w",strtotime($data));
  }
  
  
    private function sum_how_day_month($month,$years) {

      if ($month == 12) {
	  return 31;
      }
      else if ($month == 11) {
	  return 30;
      }
      else if ($month == 10) {
	  return 31;
      }
      else if ($month == 9) {
	  return 30;
      }
      else if ($month == 8) {
	  return 31;
      }
      else if ($month == 7) {
	  return 31;
      }
      else if ($month == 6) {
	  return 30;
      }
      else if ($month == 5) {
	  return 31;
      }
      else if ($month == 4) {
	  return 30;
      }
      else if ($month == 3) {
	  return 31;
      }
      else if ($month == 2) {

	  if ( $this->if_accessible($years) == 1) {
	      return 29;
	  }
	  else {
	      return 28;
	  }

      }
      else if ($month == 1) {
	  return 31;
      }


  }
  
  private function if_accessible($years)
  {
       return (($years%4 == 0 && $years%100 != 0) || $years%400 == 0);
  }
  
  public function error() {
    
    return view('error');
    
    
    
  }
  
          public function login3() {

    $password = Input::get('password');
    //821c6e4d060725576d68717f2c4bd95429bbb848
    //$a = Hash::make("");
    //print $a;
    
  $user = array(
    'login' => Input::get('login'),
    'password' => $password
  );
  //var_dump($user);
  if (Input::get('login') == "" and Input::get('password') == "" ) {
    return Redirect('error')->with('login_error','Uzupełnij pole login i hasło');
    //print "3";
  }
  if (Auth::attempt($user))
  {
  //print Auth::User()->id;
    return Redirect('login');
  }
  else {
    //print Input::get('login');
    return Redirect('error')->with('login_error','Nieprawidłowy login lub hasło');
  }
    
    }
  
}

