<?php
require_once("../Conexion/Login.php");
if(isset($_SESSION["id"]))
{

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es" dir="ltr">
<head>
 <meta http-equiv="content-type" content="text/html; charset=utf-8" />
 <meta http-equiv="content-language" content="es" />
 <link rel="stylesheet" type="text/css" href="../css/estilo.css" media="screen" />
 <link rel="stylesheet" type="text/css" href="../css/menu.css" media="screen" />
</head>

<body>
<div id="wrapper">
  <div id="pagina">

  <header> 
     
  </header>

<?php 
include('../menu.php');
menu2();
 

Conexion::conectar();

echo "<br> <b><a href=\"librodiarioPartida.php\">+Agregar Nueva partida</a></b>";
$query="select id,dia,mes,year,partida,descripcion from libro order by mes and year";
$result=mysql_query($query) or die(mysql_error());
echo "<table border=1 class='tabla'>
      <tr>
        <th class='Modo1'>Dia</th>
        <th class='Modo1'>Mes</th>
        <th class='Modo1'>Año</th> 
        <th class='Modo1'>Partida</th>
        <th class='Modo1'>Descripcion</th>
      </tr>";
    while($r=mysql_fetch_assoc($result)) 
	{
	  echo"<tr>
	         <td><a class='boton2 azul' href=\"librodiarioDetalle.php?m=".$r['id']."\">".$r['dia']."</td></a>
			 <td><a class='boton2 anaranjado' href=\"librodiarioDetalle.php?m=".$r['id']."\">".$r['mes']."</td></a>
			 <td><a class='boton2 rosa' href=\"librodiarioDetalle.php?m=".$r['id']."\">".$r['year']."</td></a>
			 <td><a class='boton2 purpura' href=\"librodiarioDetalle.php?m=".$r['id']."\">".$r['partida']."</td></a>
			 <td><a class='boton2' href=\"librodiarioDetalle.php?m=".$r['id']."\">".$r['descripcion']."</td></a>
		   </tr>";
	}
echo "</table>";
?>

 <footer>
  </footer>
  </div>
</div>

</body>
</html>

<?php

}
else{
    echo "<script type='text/javascript'>
            alert('Acceso denegado!!');
            window.location = '../index.php';
          </script>";
    }
?>
