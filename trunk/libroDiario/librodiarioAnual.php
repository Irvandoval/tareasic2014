<?php
require_once("../Conexion/Login.php");
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
 
Conexion::conectar();


	
	$libro="SELECT mayor.codigom AS codigo, mayor.mayo AS cuenta, librodiario.debe AS debe, 
	        librodiario.haber AS haber FROM mayor, librodiario WHERE mayor.codigom = librodiario.codigom";
	$resultado=mysql_query($libro) or die(mysql_error());
	echo "<table border=1 class='tabla' aling='center'>
	<tr class='modo1'>
	<th>Codigo</th>
	<th>Cuenta</th>
	<th>Debe</th>
	<th>Haber</th>
	</tr>";
	while($libroAnual=mysql_fetch_assoc($resultado)){
	echo "<tr class='modo2'>
	        <td>".$libroAnual['codigo']."</td>
			<td>".$libroAnual['cuenta']."</td>
		    <td>".number_format($libroAnual['debe'],2)."</td>
		    <td>".number_format($libroAnual['haber'],2)."</td>
		</tr>";
		}
		 echo "<tr class='modo3'><td><a href='librodiario.php'> <font color='white'> Ver Libro Diario Detallado </font></a></td></tr>"; 
	echo"</table>";
	


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
