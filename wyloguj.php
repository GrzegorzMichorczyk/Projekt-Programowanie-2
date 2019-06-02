<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
 <head>
   <meta http-equiv="content-type" content="text/html; charset=utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link rel="stylesheet" href="style.css" />
   <title>Szablon responsywny!</title>
</head>
<body>
 <?php
	session_start();
	session_unset();
	session_destroy();
	 
	require("funkcje.php");
 ?>
 

   <div id="header">
      <div id="logo">
	  
	  <?php
	  panelInformacyjny();
?>
	  
	  <h1>Serwis Obiadowy</h1></div>
   </div>
 
   <div id="wrapper">
      <div id="content">
	  
	 	Dziekujemy za skorzystanie z serwisu.
	  
	  
	  	  
	  
	  
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