<?php
require_once("../Conexion/Login.php");
if(isset($_SESSION["id"]))
{

?>

 <?php 
//-------------------- Activo Corriente ------------------------------
$sumaAC=0;
$activoC="SELECT 
          mayo AS cuenta, (sum( debe ) - sum( haber ) ) AS saldo
          FROM librodiario
          INNER JOIN mayor ON ( mayor.codigom = librodiario.codigom ) 
		  INNER JOIN libro ON ( librodiario.id = libro.id ) 
		  INNER JOIN elemento ON ( elemento.codigoe = mayor.codigoe ) 
		  WHERE year =2013
		  AND elemento.codigoe =1
	      AND mayor.codigor =11
		  GROUP BY mayor.codigom
		  ORDER BY mayor.codigom";
		  
 $activoCo=mysql_query($activoC) or die(mysql_error());
 $activoT=mysql_query($activoC) or die(mysql_error());
  while($activoCorriente=mysql_fetch_assoc($activoT))
  {
     $sumaAC=$sumaAC+$activoCorriente['saldo'];
  }
//-----------------------------------------------------------------------	


//-------------------- Activo No Corriente ------------------------------
$sumaANC=0;
$activoNC="SELECT 
          mayo AS cuenta, (sum( debe ) - sum( haber ) ) AS saldo
          FROM librodiario
          INNER JOIN mayor ON ( mayor.codigom = librodiario.codigom ) 
		  INNER JOIN libro ON ( librodiario.id = libro.id ) 
		  INNER JOIN elemento ON ( elemento.codigoe = mayor.codigoe ) 
		  WHERE year =2013
		  AND elemento.codigoe =1
	      AND mayor.codigor =12
		  GROUP BY mayor.codigom
		  ORDER BY mayor.codigom";
		  
 $activoNoC=mysql_query($activoNC) or die(mysql_error());
 $activoTNC=mysql_query($activoNC) or die(mysql_error());
  while($activoNoCorriente=mysql_fetch_assoc($activoTNC))
  {
     $sumaANC=$sumaANC+$activoNoCorriente['saldo'];
  }
  
  $totalActivo=$sumaAC+$sumaANC;
//-----------------------------------------------------------------------


//-----------------------Pasivo Corriente ------------------------------
$sumaPC=0;
$pasivoC="SELECT 
          mayo AS cuenta, (sum( haber)-sum( debe ) ) AS saldo
          FROM librodiario
          INNER JOIN mayor ON ( mayor.codigom = librodiario.codigom ) 
		  INNER JOIN libro ON ( librodiario.id = libro.id ) 
		  INNER JOIN elemento ON ( elemento.codigoe = mayor.codigoe ) 
		  WHERE year =2013
		  AND elemento.codigoe =2
	      AND mayor.codigor =21
		  GROUP BY mayor.codigom
		  ORDER BY mayor.codigom";
		   
$pasivoCo=mysql_query($pasivoC) or die(mysql_error());	
$pasivoTC=mysql_query($pasivoC) or die(mysql_error());
 while($pasivoCorriente=mysql_fetch_assoc($pasivoTC))
 {
     $sumaPC=$sumaPC+$pasivoCorriente['saldo'];
 }
  	
//-----------------------Pasivo No Corriente ------------------------------
$sumaPNC=0;	
$pasivoNC="SELECT  
           mayo AS cuenta, (sum( haber)-sum(debe) ) AS saldo
           FROM librodiario
           INNER JOIN mayor ON ( mayor.codigom = librodiario.codigom ) 
		   INNER JOIN libro ON ( librodiario.id = libro.id ) 
		   INNER JOIN elemento ON ( elemento.codigoe = mayor.codigoe ) 
		   WHERE year =2013
		   AND elemento.codigoe =2
	       AND mayor.codigor =22
	       GROUP BY mayor.codigom
	       ORDER BY mayor.codigom";
		   
$pasivoNoC=mysql_query($pasivoNC) or die(mysql_error());
$pasivoTNC=mysql_query($pasivoNC) or die(mysql_error());
 while($pasivoNoCorriente=mysql_fetch_assoc($pasivoTNC))
 {
     $sumaPNC=$sumaPNC+$pasivoNoCorriente['saldo'];
 }
$totalPasivo=$sumaPC+$sumaPNC;

//-----------------------Capital Contable ------------------------------
/*
$sumaC=0;
$totalPyC=0;
$capital="SELECT  
          mayo AS cuenta, (sum(haber)-sum( debe )  ) AS saldo
          FROM librodiario
          INNER JOIN mayor ON ( mayor.codigom = librodiario.codigom ) 
		  INNER JOIN libro ON ( librodiario.id = libro.id ) 
    	  INNER JOIN elemento ON ( elemento.codigoe = mayor.codigoe ) 
		  WHERE year =2013
		  AND elemento.codigoe =3
	      AND mayor.codigor =31
	      GROUP BY mayor.codigom
		  ORDER BY mayor.codigom";
		   
$CapitalContable=mysql_query($capital) or die(mysql_error());
$CapitalT=mysql_query($capital) or die(mysql_error());
 while($CapitalContable=mysql_fetch_assoc($CapitalT))
 {
     $sumaC=$sumaC+$CapitalContable['saldo'];
 }
 */
 include ('../estadoCapital/EstadoCapitalFunciones.php');
$totalPyC=$totalPasivo+ $capitalContable;   

?> 

<?php

}
else{
    echo "<script type='text/javascript'>
            alert('Acceso denegado!!');
            window.location = '../index.php';
          </script>";
    }
?>

