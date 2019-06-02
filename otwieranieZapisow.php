<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
 <head>
   <meta http-equiv="content-type" content="text/html; charset=utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link rel="stylesheet" href="style.css" />
   <script src="biblioteki/3.3.1/jquery.min.js"></script>
   <script src="biblioteki/jquery.maskedinput.min.js"></script>
  
   <title>Zamowienia obiadowe</title>
</head>
<body>
<?php

require("funkcje.php");
session_start();
if($_POST["otworzZapisy"] == "Otworz zapisy")
{
	$data = $_POST["DATA"];
	$czas = $_POST["CZAS"];
	polaczZBaza();
	otwieranieZapisow($data." ".$czas.":00");
	
	$dataICzas=$_POST["DATA"]."T".$_POST["CZAS"].":00.000";
	$_SESSION['zapisy']=true;
	$_SESSION['dataICzas']=$dataICzas;
	//$test=$_SESSION['dataICzas'];
	//print("dziala zapisy otwarte3 $test");
}

?>
 

   <div id="header">
      <div id="logo">
	  
	  <?php
	 panelInformacyjny();
?>
	  
	  <h1>Otwieranie zapisów</h1></div>
   </div>
 
   <div id="wrapper">
      <div id="content">Witam w serwisie obiadowym<br><br>
		
		
		
		<div id="koniecZapisow"> </div>

		
		
		<h3>Mona tutaj zamawiac wspolnie obiady.</h3><br>
		
		<?php
	
	
	
	if($_SESSION['zapisy'])
	  {
		print("zapisy otwarte: $dataICzas");
		$dataICzas=$_SESSION['dataICzas'];
		require("odliczanie.html");
		print("<script>");
		print("start(\"$dataICzas\");");
		print("</script>");		
		   	
	  }
	  else
	  {
		print("Zapisy zamknięte | ");	
	  }	
	
?>
		
		<div id="formularzOtwieranieZapisow">
				<form name="otwieranieZapisow" method='post' action='otwieranieZapisow.php' onsubmit="return walidacjaLogowania()">
						
						<table>
							<tr><td>Mask DateTimePicker</td><td><input type="text" value=""  name="DATA" id="date"/></td></tr>
							<tr><td>TimePicker</td><td><input type="text" name="CZAS" id="time"/></td></tr>
						
						</table>
												
						<input type='submit' name='otworzZapisy' value='Otworz zapisy'>
				</form>
		</div>
	  
	  
<script>


        $("#date").mask("9999-99-99");
		$("#time").mask("99:99");
				//.datepicker({ nextText: "", prevText: "", changeMonth: true, changeYear: true })
				//.mask("99/99/9999");
    
 
 
 
</script>
	  
	  
	  
	  </div>
      <div id="menu">
         <h5>Menu główne</h5>
         <ul>
<?php
			//INDEX, WYLOGUJ, ZALOGUJ, MENU, ZAPIS, START, STOP
	menu("START");
?>
         </ul>
      </div>
   </div>
</body>
</html>