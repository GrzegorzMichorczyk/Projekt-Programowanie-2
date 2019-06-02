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
			
			zamow($idUzytkownika, $danieGlowne, $dodatek, $idSorowki);
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
		
		uzupelnijSelect(daniaGlowne, "danieGlowne");
		document.getElementById("danieGlowne").selectedIndex = -1;
		
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
			var value = document.getElementById("danieGlowne").value;  
			var danieGlowne =  dajDanieGlowneOId(value);
			
			document.getElementById("dodatek").innerHTML = "";
			if(danieGlowne.czyDodatek == 1)
			{
				uzupelnijSelect(dodatki, "dodatek");
				document.getElementById("dodatek").selectedIndex = -1;
			}
			
			document.getElementById("surowka").innerHTML = "";
			if(danieGlowne.czySurowka == 1)
			{
				uzupelnijSelect(surowki, "surowka");
				document.getElementById("surowka").selectedIndex = -1;
			}
			
		}
		
		
		
		
		
		
		
//for (var i=0; i < jsonDataDanieGlowne.daniaGlowne.length; i++)
//{
	//var option = document.createElement("option");
	//option.value = jsonDataDanieGlowne.daniaGlowne[i].id;
	//option.innerHTML = jsonDataDanieGlowne.daniaGlowne[i].nazwa;
	//document.getElementById('danieGlowne').appendChild(option);
//}
		
		
		
		
		//var option = document.createElement("option");
		//option.id = obj.States[i].id;
		//option.value = obj.States[i].code;
		//option.innerHTML = obj.States[i].stateName;
		//select.appendChild(option);
		
		
		
</script>
   
	  
	  
	  
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