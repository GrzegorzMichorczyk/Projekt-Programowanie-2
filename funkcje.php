<?php
function loguj($napis)
{
	//print ("$napis <BR />"); 
}

function elementMenu($czyWybrany, $plik, $nazwaElementu)
{
	if($czyWybrany)
	{
		print("<li><a class=\"wybrane\" href=\"$plik\" >$nazwaElementu</a></li>");
	}
	else
	{
		print("<li><a href=\"$plik\">$nazwaElementu</a></li>");
	}
}

function elementMenuWybor($wybor, $idElementu, $plik, $nazwaElementu)
{
	 elementMenu($wybor == $idElementu, $plik, $nazwaElementu);
}



//INDEX, WYLOGUJ, ZALOGUJ, MENU, ZAPIS, START, STOP
function menu($wybor)
{
	elementMenuWybor($wybor, "INDEX", "index.php", "Strona główna");
	
	if($_SESSION['zalogowany'])
	{
		elementMenuWybor($wybor, "WYLOGUJ", "wyloguj.php", "Wyloguj");
	}
	else
	{
		elementMenuWybor($wybor, "ZALOGUJ", "logowanie.php", "Logowanie");		
	}
	
            if($_SESSION['zalogowany'])
			{
				elementMenuWybor($wybor, "ZAPIS", "zapisNaObiad.php", "Zapis na obiad");
				if($_SESSION['admin'])
				{
					elementMenuWybor($wybor, "START", "otwieranieZapisow.php", "Otwieranie zapisow");
					elementMenuWybor($wybor, "STOP", "podsumowanieZapisow.php", "Podsumowanie zapisow");
				}
			}

}

function panelInformacyjny()
{
	print("<div id='zalogowany'> ");	
	 
	  //print("</div>");
	
	
	  
	if($_SESSION['zalogowany'])
	{
		 print("<label id='koniecZapisow'></label> |" );
		if($_SESSION['zapisy'])
		{
			$dataICzas=$_SESSION['dataICzas'];
			require("odliczanie.html");
			print("<script>");
			print("start(\"$dataICzas\"); ");
			print("</script>");	
		}
		else
		{
			print("Zapisy zamknięte | ");	
		}	
		
		if($_SESSION['awatar'] == null)
		{
			print("Jesteś zalogowany<img src=\"grafika/zalogowany.png\" style=\"width:20px;height:20px;\ alt=\"zalogowany\">");	
		}
		else
		{
			$image_data = base64_encode( $_SESSION['awatar'] );
			print("Jesteś zalogowany<img src=\"data:image/png;base64,$image_data\" style=\"width:20px;height:20px;\" alt=\"nie zalogowany\">");	
		}
	}
	else
	{
		print("Nie jesteś zalogowany<img src=\"grafika/nieZalogowany.png\" style=\"width:20px;height:20px;\" alt=\"nie zalogowany\">");	
	}
	print("</div>");
}			
			
function polaczZBaza()
{
	// nawiazujemy polaczenie 
$connection = @mysql_connect('mysql.cba.pl', 'plesniak', 'Bigdaddy20') 
// w przypadku niepowodznie wyݷietlamy komunikat 
or die('Brak połczenia z serwerem MySQL.<br />Błąd: '.mysql_error()); 
// poӹczenie nawiںane ;-) 
//loguj("Udało się połączyć serwerem!!"); 
// nawiںujemy poӹczenie z baz٠danych 
$db = @mysql_select_db('akademia_programisty', $connection) 
// w przypadku niepowodzenia wyݷietlamy komunikat 
or die('Nie mogꡰoӹczy桳i꡺ baz٠danych<br />Bӹd: '.mysql_error()); 
// poӹczenie nawiںane ;-) 
//loguj("Udaԯ siꡰoӹczy桺 baz٠dancych!"); 
// zamykamy poӹczenie 
}	
			
function otwieranieZapisow($dataICzasKoncaZapisow)
{
	$dataICzasKoncaZapisow = mysql_real_escape_string($dataICzasKoncaZapisow);
	loguj($dataICzasKoncaZapisow);
	$result = mysql_query("INSERT INTO GZapisy (id, poczatekZapisow, koniecZapisow) VALUES (NULL, NOW(), '$dataICzasKoncaZapisow');") 
	or die('Blad w zapytaniu<br />Bӹd: '.mysql_error());
}			

function czyOtwarteZapisy()
{
	$result = mysql_query("SELECT CASE WHEN MAX(koniecZapisow) > NOW() THEN 1 ELSE 0 END AS czyOtwarteZapisy FROM GZapisy;") 
	or die('Blad w zapytaniu<br />Bӹd: '.mysql_error());
	
	$row = mysql_fetch_array( $result );
	$czyOtwarteZapisy = $row['czyOtwarteZapisy'];
	return $czyOtwarteZapisy;
}
			
function odczytZapisow()
{
	if(czyOtwarteZapisy() == 1)
	{
		$result = mysql_query("SELECT DATE(MAX(koniecZapisow)) AS dataKoncaZapisow, TIME(MAX(koniecZapisow)) AS czasKoncaZapisow FROM GZapisy;") 
		or die('Blad w zapytaniu<br />Bӹd: '.mysql_error());
	
		$row = mysql_fetch_array( $result );
		$dataKoncaZapisow = $row['dataKoncaZapisow'];
		$czasKoncaZapisow = $row['czasKoncaZapisow'];
		$dataICzas=$dataKoncaZapisow."T".$czasKoncaZapisow.".000";	
		$_SESSION['zapisy']=true;
		$_SESSION['dataICzas']=$dataICzas;
	}
	else 
	{
		$_SESSION['zapisy']=false; 
	}
	

}			
			

function logowanie($login, $haslo)
{
	$login = mysql_real_escape_string($login);
	
	$result = mysql_query("SELECT * FROM GUzytkownik WHERE login='$login';") 
	or die('Blad w zapytaniu<br />Bӹd: '.mysql_error());
	
	while($row = mysql_fetch_array( $result )) {		
		if($row['haslo'] == $haslo) 
		{
			$_SESSION['zalogowany']=true;
			$_SESSION['userId'] = $row['id'];
			$_SESSION['login'] = $login;
			$_SESSION['admin']=$row['czyAdministrator'];
			$_SESSION['awatar']=$row['awatar'];
			
			//$userId = $_SESSION['userId'];
		}
	}
	
	if($_SESSION['zalogowany'])
	{
		odczytZapisow();
	}
	
   
}






function zakladanieKonta($login, $haslo)
{
	
	$login = mysql_real_escape_string($login);
	
	$result = mysql_query("SELECT COUNT(*) as ilosc FROM GUzytkownik WHERE login='$login';") 
	or die('Blad w zapytaniu<br />Bӹd: '.mysql_error());
	
	$ilosc = 0;
	while($row = mysql_fetch_array( $result )) {
		
		$ilosc = $row['ilosc'];
	}
	
	if($ilosc == 0)
	{
		$image = addslashes(file_get_contents($_FILES['AWATAR']['tmp_name'])); //SQL Injection defence!
		$result = mysql_query("INSERT INTO GUzytkownik (login, haslo, czyAdministrator, awatar) VALUES ('$login', '$haslo', b'0', '$image');") 
		or die('Blad w zapytaniu<br />Bӹd: '.mysql_error());
		
		logowanie($login, $haslo);
	}
	else
	{
		loguj("taki uzytkownik juz istnieje!"); //do ulepszenia - porzadny komunikat bledy
	}
	
}


function wypiszDaniaGlownejakoJson()
{
	$result = mysql_query("SELECT * FROM GDanieGlowne") 
		or die('Blad w zapytaniu<br />Bӹd: '.mysql_error());
		
		
	$arr = [];
    $inc = 0;
    while ($row = mysql_fetch_array( $result )) {
    # code...
		$jsonArrayObject = 
		(
			array(
				'id' => $row["id"], 
				'nazwa' => $row["nazwa"], 
				'czyDodatek' => $row["czyDodatek"],
				'czySurowka' => $row["czySurowka"]
			)
		);
                //$jsonArrayObject = $row;
		$arr[$inc] = $jsonArrayObject;
        $inc++;
    }
	
	wypiszObiektJakoJson($arr);
	//$jsonStr = zamienObiektNaJson($arr);
    //print ("$jsonStr");  
}

function wypiszDaneJakoJson($query)
{
	$result = mysql_query($query) 
		or die('Blad w zapytaniu<br />Bӹd: '.mysql_error());
		
		
	$arr = [];
    $inc = 0;
    while ($row = mysql_fetch_array( $result )) {
    # code...
		$jsonArrayObject = 
		(
			array(
				'id' => $row["id"], 
				'nazwa' => $row["nazwa"]
			)
		);
                //$jsonArrayObject = $row;
		$arr[$inc] = $jsonArrayObject;
        $inc++;
    }
	
    wypiszObiektJakoJson($arr);
    //return zamienObiektNaJson($arr);
}		

function wypiszObiektJakoJson($arr)
{
	
	$json_array = json_encode($arr);
	$json_obj = "{\"daniaGlowne\":".$json_array."}";
	$json_str = str_replace("\"","\\\"",$json_obj);
    print ("\"$json_str\";");  
}

function getIdZapisow()
{
	loguj("SELECT id FROM GZapisy WHERE poczatekZapisow<NOW() AND NOW()<koniecZapisow;");
	$result = mysql_query("SELECT id FROM GZapisy WHERE poczatekZapisow<NOW() AND NOW()<koniecZapisow;") 
	or die('Blad w zapytaniu<br />Bӹd: '.mysql_error());
	$idZapisow = -1;
	while($row = mysql_fetch_array( $result )) {		
			$idZapisow = $row['id'];
	}
	return $idZapisow;
}

function czyObiadZamowiony($idUzytkownika, $idZapisow)
{
	$result = mysql_query("SELECT COUNT(*) AS ilosc FROM GZamowienie WHERE idUzytkownik = $idUzytkownika AND idZapisy = $idZapisow;") 
	or die('Blad w zapytaniu<br />Bӹd: '.mysql_error());
	
	$row = mysql_fetch_array( $result );
	$ilosc = $row['ilosc'];
	if($ilosc > 0)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}

function zamow($idUzytkownika, $idDaniaGlownego, $idDodatku, $idSorowki)
{
	if($idDaniaGlownego == null)
	{
		$idDaniaGlownego = "null";
	}
	if($idDodatku == null)
	{
		$idDodatku = "null";
	}
	if($idSorowki == null)
	{
		$idSorowki = "null";
	}
	
	$idZapisow = getIdZapisow();
	
	if($idZapisow == -1)
	{
		return false;
	}
	loguj("DELETE FROM GZamowienie WHERE idUzytkownik = $idUzytkownika AND idZapisy = $idZapisow;");
	$result = mysql_query("DELETE FROM GZamowienie WHERE idUzytkownik = $idUzytkownika AND idZapisy = $idZapisow;") 
	or die('Blad w zapytaniu<br />Bӹd: '.mysql_error());
	
	loguj("INSERT INTO GZamowienie (idUzytkownik, idDanieGlowne, idDodatek, idSurowka, idZapisy) VALUES ($idUzytkownika, $idDaniaGlownego, $idDodatku, $idSorowki, $idZapisow);");
	$result = mysql_query("INSERT INTO GZamowienie (idUzytkownik, idDanieGlowne, idDodatek, idSurowka, idZapisy) VALUES ($idUzytkownika, $idDaniaGlownego, $idDodatku, $idSorowki, $idZapisow);") 
	or die('Blad w zapytaniu<br />Bӹd: '.mysql_error());
	
}



	//session_unset(); 
//		session_destroy();
?>
