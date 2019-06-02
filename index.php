<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
 <head>
   <meta http-equiv="content-type" content="text/html; charset=utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link rel="stylesheet" href="style.css" />
   <title>Zamowienia obiadowe</title>
</head>
 <body>
<?php
session_start();
require("funkcje.php");

// nawiazujemy polaczenie 
$connection = @mysql_connect('mysql.cba.pl', 'plesniak', 'Bigdaddy20') 
// w przypadku niepowodznie wyݷietlamy komunikat 
or die('Brak połczenia z serwerem MySQL.<br />Błąd: '.mysql_error()); 
// poӹczenie nawiںane ;-) 
loguj("Udało się połączyć serwerem!!"); 
// nawiںujemy poӹczenie z baz٠danych 
$db = @mysql_select_db('akademia_programisty', $connection) 
// w przypadku niepowodzenia wyݷietlamy komunikat 
or die('Nie mogꡰoӹczy桳i꡺ baz٠danych<br />Bӹd: '.mysql_error()); 
// poӹczenie nawiںane ;-) 
loguj("Udaԯ siꡰoӹczy桺 baz٠dancych!"); 
// zamykamy poӹczenie 

$result = mysql_query("SELECT * FROM Users;") 
or die('Blad w zapytaniu<br />Bӹd: '.mysql_error());

if($_POST["przyciskLogowania"] != null)
{
	$login = $_POST["LOGIN"];
	$haslo = $_POST["HASLO"];
	logowanie($login, $haslo);
}
if($_POST["przyciskZakladaniaKonta"] != null)
{
	$login = $_POST["LOGIN"];
	$haslo = $_POST["HASLO"];
	zakladanieKonta($login, $haslo);
}


//if($_POST["LOGIN"]=="Grzesiek" && $_POST["HASLO"]=="1234567890")
//{
//	
//	$_SESSION['zalogowany']=true;
//	$_SESSION['admin']=true;
//}
//if($_POST["LOGIN"]=="Piotr" && $_POST["HASLO"]=="1234567890")
//{	
//	$_SESSION['zalogowany']=true;
//	$_SESSION['admin']=false;
//}

?>

	<header></header>
  
   <div id="header">
      <div id="logo">
	  
<?php
	   panelInformacyjny();	
?>
	  
	  <h1>Serwis Obiadowy</h1></div>
   </div>
 
   <div id="wrapper">
      <div id="content">Witam w serwisie obiadowym<br><br>
		Mona tutaj zamawiac wspolnie obiady.<br><br>
		  <img src="grafika/obiad.jpg" alt="zdjęcie obiadu">
	  
	  </div>
      <div id="menu">
         <h5>Menu główne</h5>
         <ul>
<?php
			//INDEX, WYLOGUJ, ZALOGUJ, MENU, ZAPIS, START, STOP
	menu("INDEX");
?>
         </ul>
      </div>
   </div>
   
</body>
</html>