<?php
require_once("Conexion/Login.php");
if(isset($_SESSION["id"]))
{
    $conectar = new Login();
    $conectar-> acceso();
	
?>

<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/estilo.css" media="screen" />
  <link rel='stylesheet' href='css/menu.css' type='text/css' />
</head>

 
<body>
<div id="wrapper">
  <div id="pagina">

  <header> 
     
  </header>

  <?php
    include('menu.php');
	menu();
  ?> 

 <br><br> <br><br>  <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> <br><br> 
 
  </div>  
</div> 
</body>

</html>


<?php

}
else{
    echo "<script type='text/javascript'>
            alert('Acceso denegado!!');
            window.location = 'index.php';
          </script>";
    }
?>



