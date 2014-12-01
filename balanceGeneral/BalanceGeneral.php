<?php
require_once('../Ajustes/ajustesFunciones.php');
require_once("../Conexion/Login.php");
if(isset($_SESSION["id"]))
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
      Aqui va ir el logotivo de la empresa
    </header>

    

<?php 
require_once("../Conexion/Conexion.php");
Conexion::conectar();
require_once "BalanceGeneralFunciones.php";

include('../menu.php');
menu2();
  
echo "<table border='1' class='tabla'>";

       echo "<tr> 
	       <th colspan='5'  class='modo7'>
			    <div align= 'center' >
				   <p> IndustriMILK S.A de C.V </p>
				   <p> Balance de General </p>
				   <p> Del 1 de enero al 30  diciembre de 2014 </p>
				   
				</div>	
		    </th> 
	  </tr>"; 
	  //----------------------- ACTIVO CORRIENTE --------------------------
	  echo "<tr> 
				<th colspan='3' class='modo7'>ACTIVO </th> 
			</tr>";   
	  echo "<tr class='modo2'> 
				<th> Activo Corriente</th> 
				<th> </th>
				<th> ".number_format($sumaAC,2)."</th>		   
			</tr>";  
	
	  while($activoCorriente=mysql_fetch_assoc($activoCo))
	  {	  
		echo "<tr class='modo1'>
				<th class='modo1'>".$activoCorriente['cuenta']."</th>
				<th class='modo1'>".number_format($activoCorriente['saldo'],2)."</th>
				<th> </th>
			 </tr>";
	  }

	  //---------------------- ACTIVO NO CORRIENTE --------------------------
      echo "<tr class='modo2'> 
				<th> Activo No Corriente</th> 
				<th> </th>
				<th> ".$sumaANC."</th>		   
		    </tr>";  
	
	  while($activoNoCorriente=mysql_fetch_assoc($activoNoC))
	  {	  
		echo "<tr class='modo1'>
				<th class='modo1'>".$activoNoCorriente['cuenta']."</th>
				<th class='modo1'>".number_format($activoNoCorriente['saldo'],2)."</th>
				<th> </th>
			 </tr>";
	  }
	  echo "<tr class='modo2'> 
			<th class='modo2'> Total Activo </th> 
			<th class='modo2' > </th>
			<th class='modo2'> ".number_format($totalActivo,2)."</th>					
		</tr>";  

	  //-------------------------- PASIVO CORRIENTE --------------------------
	  echo "<tr> 
			<th colspan='3' class='modo7'>PASIVO + CAPITAL </th> 
		  </tr>"; 
	  echo "<tr class='modo2'> 
			  <th class='modo2'> Pasivo Corriente</th> 
			  <th class='modo2'> </th>
			  <th class='modo2'> ".number_format($sumaPC,2)."</th>		   
		    </tr>";  
	
	  while($pasivoCorriente=mysql_fetch_assoc($pasivoCo))
	  {	  
		echo "<tr class='modo1'>
				<th class='modo1'>".$pasivoCorriente['cuenta']."</th>
				<th class='modo1'>".number_format($pasivoCorriente['saldo'],2)."</th>
				<th> </th>
			 </tr>";
	  }
	  echo "</td>";
	  //----------------------- PASIVO NO CORRIENTE --------------------------
 	  echo "<tr class='modo2'> 
			<th class='modo2'> Pasivo No Corriente</th> 
			<th class='modo2'> </th>
			<th class='modo2'> ".number_format($sumaPNC,2)."</th>		   
		    </tr>";  
	
	  while($pasivoNoCorriente=mysql_fetch_assoc($pasivoNoC))
	  {	  
		echo "<tr class='modo1'>
				<th class='modo1'>".$pasivoNoCorriente['cuenta']."</th>
				<th class='modo1'>".number_format($pasivoNoCorriente['saldo'],2)."</th>
				<th> </th>
			  </tr>";
	  }
	  echo "</td>";

      echo "<tr class='modo2'> 
			   <th class='modo2'> Total PASIVO </th> 
			   <th class='modo2'> </th>
			   <th class='modo2'> $".number_format($totalPasivo,2)."</th>		   
		   </tr>"; 
      //--------------------------- CAPITAL -------------------------------
      echo "<tr class='modo2'> 
			   <th> Capital Contable</th> 
			   <th> </th>
			   <th> ".number_format($capitalContable,2)."</th>		   
		     </tr>";  
	
	  while($CapitalContable=mysql_fetch_assoc($pasivoNoC))
	  {	  
		 echo "<tr>
				<th class='modo1'>".$CapitalContable['cuenta']."</th>
				<th class='modo1'>".number_format($CapitalContable['saldo'],2)."</th>
				<th> </th>
			 </tr>";
	  }
	   echo "<tr class='modo2'> 
			   <th class='modo2'> Total Pasivo + Participaciones </th> 
			   <th class='modo2' > </th>
			   <th class='modo2'> $".number_format($totalPyC,2)."</th>					
		    </tr>"; 
		
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