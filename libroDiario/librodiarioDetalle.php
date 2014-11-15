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

if(isset($_GET['m'])){
	$movimiento=$_GET['m'];
	
	$query="select codigom,debe,haber from librodiario where id=".$movimiento;
	$result=mysql_query($query) or die(mysql_error());
	echo "<table border=1 class='tabla' aling='center'>
	<tr class='modo1'>
	<th>Cuenta</th>
	<th>Debe</th>
	<th>Haber</th>
	</tr>";
	while($r=mysql_fetch_assoc($result)){
		echo "<tr class='modo2'><td>".mysql_result(mysql_query("select mayo from mayor where codigom=".$r['codigom']),0)."</td>
		<td>".number_format($r['debe'],2)."</td>
		<td>".number_format($r['haber'],2)."</td>
		</tr>";
		}
	echo"</table>";
	}
	else{
	header('location: libro_diario.php');		
		}

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
