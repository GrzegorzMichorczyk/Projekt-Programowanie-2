<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
 <head>
   <meta http-equiv="content-type" content="text/html; charset=utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link rel="stylesheet" href="style.css" />
   <title>Serwis Obiadowy</title>
</head>
<body>
 <?php
	session_start();
	require("funkcje.php");
 ?>
 

   <div id="header">
      <div id="logo">
	  
	  <?php
	  panelInformacyjny();
?>
	  
	  <h1>Podsumowanie zapisow</h1></div>
   </div>
 
   <div id="wrapper">
      <div id="content">
	  
	 	<h3>Na obiad zapisały się następujące osoby:</h3>
		<table>
			<tr><td><B>Login</B></td><td><B>Awatar</B></td><td><B>Danie glowne</B></td><td><B>Dodatek</B></td><td><B>Surówka</B></td></tr>
			
			<?php
				polaczZBaza();
				$idZapisow = getIdZapisow();
				
				$result = mysql_query(
"SELECT 
	GUzytkownik.login AS login,
	GUzytkownik.awatar AS awatar,
	GDanieGlowne.nazwa AS danieGlowne,
	GDodatek.nazwa AS dodatek,
	GSurowka.nazwa AS surowka
FROM 
	GZamowienie 
	JOIN GUzytkownik ON GZamowienie.idUzytkownik = GUzytkownik.id
	JOIN GDanieGlowne ON GZamowienie.idDanieGlowne = GDanieGlowne.id
	LEFT JOIN GDodatek ON GZamowienie.idDodatek = GDodatek.id
	LEFT JOIN GSurowka ON GZamowienie.idSurowka = GSurowka.id
WHERE idZapisy = $idZapisow;") 
				or die('Blad w zapytaniu<br />Bӹd: '.mysql_error());
	
				while($row = mysql_fetch_array( $result )) {		
					$login = $row['login'];
					$danieGlowne = $row['danieGlowne'];
					$dodatek = $row['dodatek'];
					$surowka = $row['surowka'];
			
					print("<tr><td>$login</td><td>");
					$awatar =  $row['awatar'];
					if($awatar != null)
					{
						$image_data = base64_encode( $awatar );
						print("<img src=\"data:image/png;base64,$image_data\" style=\"width:50px;height:50px; \" alt=\"awatar\">");	
					}
					print("</td><td>$danieGlowne</td><td>$dodatek</td><td>$surowka</td></tr>");
			
			
//awatar
				}
			
			
			
			?>
			
		</table>
	  
	  
	  	  
	  
	  
	  </div>
      <div id="menu">
         <h5>Menu główne</h5>
         <ul>
<?php
    //INDEX, WYLOGUJ, ZALOGUJ, MENU, ZAPIS, START, STOP
	menu("STOP");
?>
         </ul>
      </div>
   </div>
</body>
</html>