<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"W>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
 <head>
   <meta http-equiv="content-type" content="text/html; charset=utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link rel="stylesheet" href="style.css" />
   <title>Szablon responsywny!</title>
</head>
 <?php
require("funkcje.php");
 ?>
 
<body>
   <div id="header">
      <div id="logo">
	  
	  <?php
	  print("<div id='zalogowany'>");	
if($_SESSION['zalogowany'])
{
	
	print("Jesteś zalogowany<img src=\"grafika\zalogowany.png\" style=\"width:20px;height:20px;\">");	
	
}
else
{
	print("Nie jesteś zalogowany<img src=\"grafika\\nieZalogowany.png\" style=\"width:20px;height:20px;\">");	
}
print("</div>");	
?>
	  
	  <h1>Logowanie</h1></div>
   </div>
 
   <div id="wrapper">
      <div id="content">
	  
	 	<div id="formularzWylogowania">
				<form name="logowanie" method='post' action='index.php'>
						<input type='submit' name='wyloguj' value='Wyloguj'>
				</form>
		</div>
	  
	  
	  	  
	  
	  
	  </div>
      <div id="menu">
         <h5>Menu główne</h5>
         <ul>
<?php
    //INDEX, WYLOGUJ, ZALOGUJ, MENU, ZAPIS, START, STOP
	menu("WYLOGUJ");
?>
         </ul>
      </div>
   </div>
</body>
</html>