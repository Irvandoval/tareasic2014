<?php
require_once('../Ajustes/ajustesFunciones.php');
require_once("../Conexion/Login.php");
if(isset($_SESSION["id"]) )
{

 periodo();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html >
  <head>
    <title> Industrialización de la Leche para obtener Lácteos de Especialidad</title>
    <meta name="keywords" content="" />
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
	<link href="../css/estilo.css" rel="stylesheet" type="text/css" media="all"/> 
	<link href="../css/menu.css" rel="stylesheet" type="text/css" media="all"/> 
 </head>

<body>

<div id="wrapper">   
<div id="pagina">
	<header> 
 
    </header>

    

<?php 
Conexion::conectar();
require_once "EstadoResultadoFunciones.php";

include('../menu.php');

menu2();
  
echo "<br>";
echo "<table border='1' class='tabla'>";
	  //-----------------------Ingresos --------------------------
	  echo "<tr> 
	            <th colspan='3'  class='modo7'>
				<div align= 'center' >
				   <p> IndustriMILK S.A de C.V </p>
				   <p> Estado de Resultados </p>
				   <p> Del 01 de enero al 30 noviembre 2014 </p>
				   
				</div>	
				</th> 
			</tr>";   
	  echo "<tr class='modo2'> 
				<th> Ingresos</th> 
				<th> </th>
				<th>".number_format($sumaI,2)."</th>		   
			</tr>";  
	
	  while($ing=mysql_fetch_assoc($i))
	  {	  
		echo "<tr class='modo1'>
				<th class='modo1'>".$ing['cuenta']."</th>
				<th class='modo1'>".number_format($ing['saldo'],2)."</th>
				<th> </th>
			 </tr>";
	  }
	  //-----------------------Egresos --------------------------  
	  echo "<tr class='modo2'> 
				<th> Egresos</th> 
				<th> </th>
				<th>".number_format($sumaCG,2)."</th>		   
			</tr>";  
			
	  while($cost=mysql_fetch_assoc($c))
	  {	  
		echo "<tr class='modo1'>
				<th class='modo1'>".$cost['cuenta']."</th>
				<th class='modo1'>".$cost['saldo']."</th>
				<th> </th>
			 </tr>";
	  } 

     perdidaGanancia($sumaI, $sumaCG);
			

echo "</table>"; 

?>
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