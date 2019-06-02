<?php
if($_POST["email"]=="kwasowy.badyl@gmail.com" && $_POST["haslo"]=="123456789")
{
	$_SESSION['zalogowany']=true;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"W>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
 <head>
   <meta http-equiv="content-type" content="text/html; charset=utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link rel="stylesheet" href="style.css" />
   <title>Szablon responsywny!</title>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      
</head>
 
<body>
   <div id="header">
      <div id="logo">
	  
<?php
if($_SESSION['zalogowany'])
{
	print("<div id='zalogowany'>");	
	print("Jesteś zalogowany<img src=\"grafika\zalogowany.png\" style=\"width:20px;height:20px;\">");	
	print("</div>");	
}

?>
	  
		<h1>Index </h1>
		
	  </div>
   </div>
 
   <div id="wrapper">
      <div id="content">
	  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue, suscipit a, scelerisque sed, lacinia in, mi. Cras vel lorem. Etiam pellentesque aliquet tellus. Phasellus pharetra nulla ac diam. Quisque semper justo at risus. Donec venenatis, turpis vel hendrerit interdum, dui ligula ultricies purus, sed posuere libero dui id orci. Nam congue, pede vitae dapibus aliquet, elit magna vulputate arcu, vel tempus metus leo non est.
	  <br>
	  <br> 
	  Etiam sit amet lectus quis est congue mollis. Phasellus congue lacus eget neque. Phasellus ornare, ante vitae consectetuer consequat, purus sapien ultricies dolor, et mollis pede metus eget nisi. Praesent sodales velit quis augue. Cras suscipit, urna at aliquam rhoncus, urna quam viverra nisi, in interdum massa nibh nec erat.
<?php
		print(" dzialam");	

?>


      
	  
	  
	  
	  
	  <div id="menu">
         <h5>Menu główne</h5>
         <ul>
            <li><a href="#">Strona główna</a></li>
            <li><a href="#">Link 1</a></li>
            <li><a href="#">Link 2</a></li>
            <li><a href="#">Link 3</a></li>
         </ul>
      </div>
   </div>
   </body>
</html>




					
					
					

