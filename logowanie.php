<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
 <head>
   <meta http-equiv="content-type" content="text/html; charset=utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link rel="stylesheet" href="style.css" />
   <script src="biblioteki/3.3.1/jquery.min.js"></script>
   <title>Zamowienia obiadowe</title>
   <script>
		function walidajaLoginu(formularz, idKomunikatu)
		{
			var wynik = true;
			var login = document.forms[formularz]["LOGIN"].value;
				
			if (login == "") {
				document.getElementById(idKomunikatu).innerHTML = "Login nie może być pusty";
				//alert("Name must be filled out");
				wynik = false;
			}
			else if(/[^a-zA-Z]/.test(login)) {
				document.getElementById(idKomunikatu).innerHTML = "Login może zawierać tylko litery";
				wynik = false;
			}
			else
			{
				document.getElementById(idKomunikatu).innerHTML = "";
			}
			return wynik;
		}
		
		function walidajaHasla(formularz, idKomunikatu)
		{
			var wynik = true;
			var haslo = document.forms[formularz]["HASLO"].value;
			
			if (haslo == "") {
				document.getElementById(idKomunikatu).innerHTML = "Haslo nie może być puste";
				//alert("Name must be filled out");
				wynik = false;
			}
			else if(haslo.length < 10) {
				document.getElementById(idKomunikatu).innerHTML = "Haslo musi mieć co najmniej 10 znakow";
				wynik = false;
			}
			else
			{
				document.getElementById(idKomunikatu).innerHTML = "";
			}

			return wynik;
		}
		
		function walidajaPowtorzonegoHasla(formularz, idKomunikatu)
		{
			var wynik = true;
			var powtHaslo = document.forms[formularz]["POWT_HASLO"].value;
			var haslo = document.forms[formularz]["HASLO"].value;
			
			if (powtHaslo == "") {
				document.getElementById(idKomunikatu).innerHTML = "Powtrozone haslo nie może być puste";
				//alert("Name must be filled out");
				wynik = false;
			}
			else if(powtHaslo != haslo) {
				document.getElementById(idKomunikatu).innerHTML = "Powtorzone hasło jest różne od hasła";
				wynik = false;
			}
			else
			{
				document.getElementById(idKomunikatu).innerHTML = "";
			}
		
			return wynik;
		}
				
		function walidacjaZakladaniaKonta() {
			var wynik = true;
			var nazwaFormularza = "zakladanieKonta";
			wynik = walidajaLoginu(nazwaFormularza, "KomunikatLogin") && wynik;
			wynik = walidajaHasla(nazwaFormularza, "KomunikatHaslo") && wynik; 
			wynik = walidajaPowtorzonegoHasla(nazwaFormularza, "KomunikatPowt") && wynik;
						
			return wynik;
		}
		
		function walidacjaLogowania() {
			var wynik = true;
			var nazwaFormularza = "logowanie";
			wynik = walidajaLoginu(nazwaFormularza, "LogowanieKomunikatLogin") && wynik  ;
			wynik = walidajaHasla(nazwaFormularza, "LogowanieKomunikatHaslo") && wynik  ;
			
			return wynik;
		}
		
</script>
   
</head>
<body>
 <?php
require("funkcje.php");
 ?>
 
 

   <div id="header">
      <div id="logo">
	  
	  <?php
	  panelInformacyjny();		
?>
	  
	  <h1>Logowanie</h1></div>
   </div>
 
   <div id="wrapper">
      <div id="content">
	  
	  <div id="formularzZakladaniaKonta">
				<form name="zakladanieKonta" method='post' action='index.php' onsubmit="return walidacjaZakladaniaKonta()" enctype="multipart/form-data">
						<table>
							<tr><td>Login</td><td><input name="LOGIN" type='text' size='15' maxlength='20' VALUE=''><div id="KomunikatLogin" class="komunikat"></div> </td></tr>
							<tr><td>Haslo</td><td><input name="HASLO" type='password' size='15' maxlength='20' VALUE=''><div id="KomunikatHaslo" class="komunikat"></div></td></tr>
							<tr><td>Powtórz hasło</td><td><input name="POWT_HASLO" type='password' size='15' maxlength='20' VALUE=''><div id="KomunikatPowt" class="komunikat"></div></td></tr>
							<tr><td>Awatar</td><td><input type="file" name="AWATAR" id="AWATAR"></td></tr>
						
						</table>
						
				<input type='submit' name='przyciskZakladaniaKonta' value='Stworz konto'>
				<br/><br/>
				</form>
		</div>

		
		
		<div id="formularzLogowania">
				<form name="logowanie" method='post' action='index.php' onsubmit="return walidacjaLogowania()">
						<table>
							<tr><td>Login</td><td><input name="LOGIN" type='text' size='15' maxlength='20' VALUE=''><div id="LogowanieKomunikatLogin" class="komunikat"></div> </td></tr>
							<tr><td>Haslo</td><td><input name="HASLO" type='password' size='15' maxlength='20' VALUE=''><div id="LogowanieKomunikatHaslo" class="komunikat"></div></td></tr>
						</table>
						
						<input type='submit' name='przyciskLogowania' value='Zaloguj'>
				</form>
		</div>
	  
	  
	  	   <script>
	
document.forms["zakladanieKonta"]["LOGIN"].addEventListener("change", 
 function(){
	walidajaLoginu("zakladanieKonta", "KomunikatLogin");
 });
 
 document.forms["zakladanieKonta"]["HASLO"].addEventListener("change", 
 function(){
	walidajaHasla("zakladanieKonta", "KomunikatHaslo");
 });
 
 document.forms["zakladanieKonta"]["POWT_HASLO"].addEventListener("change", 
 function(){
	walidajaPowtorzonegoHasla("zakladanieKonta", "KomunikatPowt");
 });
	
	 
	 
 document.forms["logowanie"]["LOGIN"].addEventListener("change", 
 function(){
	walidajaLoginu("logowanie", "LogowanieKomunikatLogin");
 });
 
document.forms["logowanie"]["HASLO"].addEventListener("change", 
 function(){
	walidajaHasla("logowanie", "LogowanieKomunikatHaslo");
 });
 
 
 
 
</script>
	  
	  
	  
	  </div>
      <div id="menu">
         <h5>Menu główne</h5>
         <ul>
<?php
    //INDEX, WYLOGUJ, ZALOGUJ, MENU, ZAPIS, START, STOP
	menu("ZALOGUJ");
?>
         </ul>
      </div>
   </div>
</body>
</html>