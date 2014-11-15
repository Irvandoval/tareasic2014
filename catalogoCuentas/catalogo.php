<?php

require_once("../Conexion/Login.php");
Conexion::conectar();
if(isset($_SESSION["id"]))
{


?>

<html>
<head>
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
 ?>   

<?php


$query=" SELECT elemento.elemento, rubro.rubro, mayor.codigom, mayor.mayo
         FROM elemento, mayor, rubro
         WHERE elemento.codigoe = mayor.codigoe AND rubro.codigor = mayor.codigor";		 
$resultado=mysql_query($query) or die(mysql_error());

echo "<br><b> <a href=\"CatalogoNuevo.php\"> AGREGAR NUEVA CUENTA </a> </b>";
echo "<table border='1' class='tabla'>
        <tr class='modo1'>
            <th>Cuenta</th>
			<th>Rubro</th>
			<th>Codigo</th>
			<th>Mayor </th>
		</tr>";
		while($r=mysql_fetch_assoc($resultado))
		{
		echo "<tr class='modo2'>";
			echo "
			<td>".$r['elemento']."
			<td>".$r['rubro']."
			<td>".$r['codigom']."
			<td>".$r['mayo']."
			</tr>";
	    };
echo "</table>";



?>

  <footer>
  </footer>
  </div>
</div>
 
</body>


<?php

}
else{
    echo "<script type='text/javascript'>
            alert('Acceso denegado!!');
            window.location = '../index.php';
          </script>";
    }
?>
