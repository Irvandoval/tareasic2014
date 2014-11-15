<?php
/*
require_once("../Conexion/Login.php");
Conexion::conectar();
if(isset($_SESSION["id"]))
{

*/
?>

<html>
<head>
  <link rel="stylesheet" type="text/css" href="../css/estilo.css" media="screen" />
</head>

<body>

<div id="wrapper">
  <div id="pagina">

  <header> 
     
  </header>

<?php

$directorio = opendir("."); //ruta actual//ruta actual
while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
{
    if (is_dir($archivo))//verificamos si es o no un directorio
    {
        echo "[".$archivo . "]<br />"; //de ser un directorio lo envolvemos entre corchetes
    }
    else
    {
        //echo $archivo . "<br />";
		echo "<a href='".$archivo."'>".$archivo."</a><br>";
    }
}




?>

  <footer>
  </footer>
  </div>
</div>
 
</body>


<?php
/*
}
else{
    echo "<script type='text/javascript'>
            alert('Acceso denegado!!');
            window.location = '../index.php';
          </script>";
    }
	*/
?>
