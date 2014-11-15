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

if((!isset($_GET['m']))&&(!isset($_GET['a'])))
{
  header('location:balance_comprobacion.php');	
}
else
   {
     $mes=$_GET['m'];
	 $ano=$_GET['a'];
     $query=" SELECT partida AS n, fecha AS fecha, mayo AS cuenta, sum( debe ) AS debe, sum( haber ) AS haber
              FROM librodiario
			  INNER JOIN mayor ON ( mayor.codigom = librodiario.codigom ) 
			  INNER JOIN libro ON ( librodiario.id = libro.id ) 
			  WHERE mes =".$mes."
			  AND year =".$ano."
			  GROUP BY mayor.codigom
			  ORDER BY codigoe, partida";
			      
	 $result=mysql_query($query) or die(mysql_error());
	 echo "<table border='1' class='tabla'>";
	 
	   
     if($_GET['m']==1){
	    $m='enero';
	 } elseif ($_GET['m']==2){
	    $m='febrero';
	 } elseif ($_GET['m']==3){
	    $m='marzo';
	 } elseif ($_GET['m']==4){
	    $m='abril';
	 } elseif ($_GET['m']==5){
	    $m='mayo';
	 } elseif ($_GET['m']==6){
	    $m='junio';
	 } elseif ($_GET['m']==7){
	    $m='julio';
	 } elseif ($_GET['m']==8){
	    $m='agosto';
	 } elseif ($_GET['m']==9){
	    $m='septiembre';
	 } elseif ($_GET['m']==10){
	    $m='octubre';
	 } elseif ($_GET['m']==11){
	    $m='noviembre';
	 } elseif ($_GET['m']==12){
	    $m='diciembre';
	 }  
	 
	 echo "<tr> 
	       <th colspan='5'  class='modo7'>
			    <div align= 'center' >
				   <p> IndustriMILK S.A de C.V </p>
				   <p> Balance de Comprobacion </p>
				   <p> Del 01 al 30 de  ".$m." de ".$ano." </p>
				   
				</div>	
		    </th> 
	  </tr>"; 
	 
	 echo"
	 <tr class='modo1'>
		<th>Transaccion</th>
		<th>Fecha</th>
		<th>Cuenta</th>
		<th>Deber</th>
		<th>Haber</th>
	 </tr>";
	 while($r=mysql_fetch_assoc($result))
	 {
		echo "<tr class='modo1'>
				<td>".$r['n']."</td>
				<td>".$r['fecha']."</td>
				<td>".$r['cuenta']."</td>
				<td>".number_format($r['debe'],2)."</td>
				<td>".number_format($r['haber'],2)."</td>
			</tr>";	
	 }
	
	$suma="SELECT sum( debe ) AS debe , sum( haber ) AS haber
		   FROM librodiario
		   INNER JOIN mayor ON ( mayor.codigom = librodiario.codigom ) 
		   INNER JOIN libro ON ( librodiario.id = libro.id ) 
		   WHERE mes =".$mes."
		   AND year =".$ano."
		   GROUP BY mayor.codigom
		   ORDER BY codigoe, partida";
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
			<th colspan='3'> total</th> 	
		
			<th>$ ".number_format($total,2)."</th> 
			<th>$ ".number_format($total2,2)."</th> 
		</tr>";
    echo "</table>";
    }
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
