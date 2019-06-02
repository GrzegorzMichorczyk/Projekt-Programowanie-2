<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
 <head>
   <meta http-equiv="content-type" content="text/html; charset=utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link rel="stylesheet" href="style.css" />
   <script src="biblioteki/3.3.1/jquery.min.js"></script>
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
	  
	  <h1>Serwis Obiadowy - Zapis na obied</h1></div>
   </div>
 
   <div id="wrapper">
      <div id="content">
	  
	  <div id="formularzZapisNaObiad">
				<form name="zakladanieKonta" method='post' action='zapisNaObiad.php' onsubmit="return walidacjaZakladaniaKonta()">
						<table>
							<tr><td>Danie głowne: </td>
							<td>
								<select id='danieGlowne' name='danieGlowne' onchange="zmianaWyboruDaniaGlownego()"></select>
								
							</td></tr>
							<tr><td>Dodatek: </td>
							<td>
								<select id='dodatek' name='dodatek'></select>
								
							</td></tr>
							<tr><td>Surówka: </td>
							<td>
								<select id='surowka' name='surowka'></select>
								
							</td></tr>
				
						</table>
						
						
						
						
				<input type='submit' name='przyciskZapisuNaObiad' value='Zapisz się na obiad'>
				</form>
		</div>

		<?php
		polaczZBaza();
		if($_POST["przyciskZapisuNaObiad"] != null)
		{
			$danieGlowne = $_POST["danieGlowne"];
			$dodatek = $_POST["dodatek"];
			$surowka = $_POST["surowka"];
			
			
			
			$idUzytkownika = $_SESSION['userId'];
			
			loguj("dzanie glowne:$danieGlowne");
			loguj("dodatek:$dodatek");
			loguj("surowka:$surowka");
			loguj("userId:$idUzytkownika");
			
			zamow($idUzytkownika, $danieGlowne, $dodatek, $surowka);
		}
		
		
		
		?>
		
	  
	     <script>
		
		function uzupelnijSelect(jsonData, nazwaSelecta) {
			for (var i=0; i < jsonData.daniaGlowne.length; i++)
			{
				var option = document.createElement("option");
				option.value = jsonData.daniaGlowne[i].id;
				option.innerHTML = jsonData.daniaGlowne[i].nazwa;
				document.getElementById(nazwaSelecta).appendChild(option);
			}
		}
		
		
		
		//var obj = new Object();
	    // obj.id = 11;
		//  obj.stateName = "jakas nazwa dania";
   
		//var option = document.createElement("option");
		//option.value = obj.id;
		//option.innerHTML = obj.stateName;
		//document.getElementById('danieGlowne').appendChild(option);
		
		var jsonStrDanieGlowne = <?php
			wypiszDaniaGlownejakoJson();
		?>
		
		var jsonStrDodatek = <?php
			wypiszDaneJakoJson("SELECT * FROM GDodatek");
		?>
		
		var jsonStrSorowka = <?php
			wypiszDaneJakoJson("SELECT * FROM GSurowka");
		?>
		
		var daniaGlowne = JSON.parse(jsonStrDanieGlowne);
		var dodatki = JSON.parse(jsonStrDodatek);
		var surowki = JSON.parse(jsonStrSorowka);
		
		var dodatekKatywny = 0;
		var surowkaKatywna = 0;
		
		uzupelnijSelect(daniaGlowne, "danieGlowne");
		uzupelnijSelect(dodatki, "dodatek");
		uzupelnijSelect(surowki, "surowka");
		
		$("#danieGlowne").prop('selectedIndex', -1);
		$("#dodatek").prop('selectedIndex', -1);
		$("#surowka").prop('selectedIndex', -1);
		
		$("#dodatek").hide();
		$("#surowka").hide();
		//document.getElementById("danieGlowne").selectedIndex = -1;
		
		//uzupelnijSelect(dodatki, "dodatek");
		//uzupelnijSelect(surowki, "surowka");
		
		function dajDanieGlowneOId(id)
		{
			for (var i=0; i < daniaGlowne.daniaGlowne.length; i++)
			{
				if(id == daniaGlowne.daniaGlowne[i].id)
				{
					return daniaGlowne.daniaGlowne[i];
				}
			}
		}
		
		
		function zmianaWyboruDaniaGlownego()
		{
			var value = $("#danieGlowne").val();  
			var danieGlowne =  dajDanieGlowneOId(value);
			
			//document.getElementById("dodatek").innerHTML = "";
			
			if(danieGlowne.czyDodatek == 1 && dodatekKatywny == 0)
			{
				$("#dodatek").prop('selectedIndex', -1);
				dodatekKatywny = 1;
				$("#dodatek").show(1000);
			}
			else if(danieGlowne.czyDodatek == 0 && dodatekKatywny == 1)
			{
				$("#dodatek").hide(1000);
				dodatekKatywny = 0;
			}
			
			
			if(danieGlowne.czySurowka == 1 && surowkaKatywna == 0)
			{
				$("#surowka").prop('selectedIndex', -1);
				surowkaKatywna = 1;
				$("#surowka").show(1000);
			}
			else if(danieGlowne.czySurowka == 0 && surowkaKatywna == 1)
			{
				surowkaKatywna = 0;
				$("#surowka").hide(1000);
			}
			
			
			
		}
	
		
		
</script>
   
	  
	  <?php
				polaczZBaza();
				
				
				
				$idZapisow = getIdZapisow();
				$userId = $_SESSION['userId'];
				if(czyObiadZamowiony($userId, $idZapisow))
				{
				$result = mysql_query(
"SELECT 
	GDanieGlowne.nazwa AS danieGlowne,
	GDodatek.nazwa AS dodatek,
	GSurowka.nazwa AS surowka
FROM 
	GZamowienie 
	JOIN GUzytkownik ON GZamowienie.idUzytkownik = GUzytkownik.id
	JOIN GDanieGlowne ON GZamowienie.idDanieGlowne = GDanieGlowne.id
	LEFT JOIN GDodatek ON GZamowienie.idDodatek = GDodatek.id
	LEFT JOIN GSurowka ON GZamowienie.idSurowka = GSurowka.id
WHERE idZapisy = $idZapisow AND GUzytkownik.id = $userId;") 
				or die('Blad w zapytaniu<br />Bӹd: '.mysql_error());
	
				$row = mysql_fetch_array( $result );		
					
					$danieGlowne = $row['danieGlowne'];
					$dodatek = $row['dodatek'];
					$surowka = $row['surowka'];
					print("<H3>Jesteś zapisany na obiad:</H3>");
					print("<table>");
					
					print("<tr><td><B>Danie glowne</B></td><td>$danieGlowne</td><td>");
					print("<tr><td><B>Dodatek</B></td><td>$dodatek</td><td>");
					print("<tr><td><B>Surówka</B></td><td>$surowka</td><td>");
					
					print("</table>");
				}
				else
				{
					print("<H3>Nie zamówiłeś jeszcze obiadu</H3>");
				}
			
			?>
			
		
	  
	  
	  
	  </div>
      <div id="menu">
         <h5>Menu główne</h5>
         <ul>
<?php
    //INDEX, WYLOGUJ, ZALOGUJ, MENU, ZAPIS, START, STOP
	menu("ZAPIS");
?>
         </ul>
      </div>
   </div>
</body>
</html>