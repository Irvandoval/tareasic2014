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
 ?> 
<?php
Conexion::conectar();

$query="select  DISTINCT mes,year from libro order by year";
$result=mysql_query($query) or die(mysql_error());
echo "<table border='1' class='tabla'>
    <tr class='modo1'>
    <th>Año</th>
    <th>Mes</th>
     </tr>";
while($r=mysql_fetch_assoc($result)) {
	$mes=$r['mes'];
	$ano=$r['year'];
	echo "<tr>
	<td><a class='boton negro formaBoton' href=\"balanceComprobacionDetallado.php?a=".$ano."&m=".$mes."\">".$ano."</a></td>
	<td><a class='boton negro formaBoton' href=\"balanceComprobacionDetallado.php?a=".$ano."&m=".$mes."\">".$mes."</a></td>";
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
