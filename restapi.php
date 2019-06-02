
 <?php
	session_start();
	require("funkcje.php");
	
	$method = $_SERVER['REQUEST_METHOD'];
	$request = explode('/', trim($_SERVER['PATH_INFO'],'/'))[0];

	if($method == "GET" && $request == "daniaGlowne"){
		polaczZBaza();	
	//print("getBooks();");
		wypiszDaniaGlownejakoJson();
	}
	elseif ($method == "GET" && $request == "dodatki"){
		polaczZBaza();	
		wypiszDaneJakoJson("SELECT * FROM GDodatek");
	}
	elseif ($method == "GET" && $request == "surowki"){
		polaczZBaza();	
		wypiszDaneJakoJson("SELECT * FROM GSurowka");
	}
	
	elseif ($method == "POST" && $request == "books"){
	//	print("addBooks();");
	}elseif ($method == "PUT" && $request == "books"){
		//print("updateBooks();");
	}elseif ($method == "DELETE" && $request == "books"){
		//print("deleteBooks();");
}
	
	
 ?>
 