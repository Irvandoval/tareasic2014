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
  ?> 

<?php
Conexion::conectar();

    $balanceAnual="SELECT partida AS n, fecha AS fecha, mayor.codigom AS codigo, mayo AS cuenta, sum( debe ) 
            AS debe, sum( haber ) AS haber FROM librodiario INNER JOIN mayor ON ( mayor.codigom = librodiario.codigom ) 
		    INNER JOIN libro ON ( librodiario.id = libro.id ) WHERE year=2013
            GROUP BY mayor.codigom ORDER BY codigoe, partida";
			      
	 $result=mysql_query($balanceAnual) or die(mysql_error());

	 echo "<table border='0' class='tabla'>";
	 
	 echo "<tr> 
	       <th colspan='6'  class='modo9'>
			    <div align= 'center' >
				   <p> IndustriMILK S.A de C.V </p>
				   <p> Balance de Comprobacion </p>
				   <p> Del 1 de enero al  30 diciembre de 2014 </p>
				   
				</div>	
		    </th> 
	  </tr>"; 
	 
	 echo"
	 <tr class='modo1'>
		<th>N</th>
		<th>Fecha</th>
		<th>Codigo</th>
		<th>Cuenta</th>
		<th>Deber</th>
		<th>Haber</th>
	 </tr>";
	 while($r=mysql_fetch_assoc($result))
	 {
		echo "<tr class='modo1'>
				<td>".$r['n']."</td>
				<td>".$r['fecha']."</td>
				<td>".$r['codigo']."</td>
				<td>".$r['cuenta']."</td>
				<td>".number_format($r['debe'],2)."</td>
				<td>".number_format($r['haber'],2)."</td>
			</tr>";	
	 }
	 
	 $suma="SELECT sum( debe ) AS debe, sum( haber ) AS haber
            FROM librodiario
			INNER JOIN mayor ON ( mayor.codigom = librodiario.codigom ) 
			INNER JOIN libro ON ( librodiario.id = libro.id ) 
			WHERE year =2013
			GROUP BY mayor.codigom ORDER BY codigoe, partida";
			
	$res=mysql_query($suma) or die(mysql_error());
	$total=0;
	$total2=0;
	while($row=mysql_fetch_assoc($res))
	{
      $total+= $row['debe'];
	  $total2+= $row['haber'];
	} 
	echo"
		<tr class='modo1'> 
			<th colspan='4'> total</th> 	  
			<th>$ ".number_format($total,2)."</th> 
			<th>$ ".number_format($total2,2)."</th> 
		</tr>";
     echo "<tr class='modo1'><td colspan='3' > <a href='balanceComprobacion.php'> <font color='gray'> Ver Balance de Comprobacion Detallado </font></a></td></tr>"; 
			
    echo "</table>";
?>

  <footer>
      
  </footer>
  </div>
</div>
 
</body>

<?php

}
else
{
    echo "<script type='text/javascript'>
            alert('Acceso denegado!!');
            window.location = '../index.php';
          </script>";
}
	
?>
