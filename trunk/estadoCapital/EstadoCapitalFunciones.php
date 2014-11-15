<?php
require_once("../Conexion/Login.php");
if(isset($_SESSION["id"]))
{

?>


 <?php 
//-------------------- Costos y Gastos ------------------------------
$sumaCG=0;
$costos="SELECT mayo AS cuenta, (sum( debe ) - sum( haber ) ) AS saldo
          FROM librodiario
		  INNER JOIN mayor ON ( mayor.codigom = librodiario.codigom ) 
		  INNER JOIN libro ON ( librodiario.id = libro.id ) 
		  INNER JOIN elemento ON ( elemento.codigoe = mayor.codigoe ) 
		  WHERE year =2013
		  AND elemento.codigoe =4
		  GROUP BY mayor.codigom
		  ORDER BY mayor.codigom
		  ";
		  
 $c=mysql_query($costos) or die(mysql_error());
 
 $costoT=mysql_query($costos) or die(mysql_error());
  while($CyG=mysql_fetch_assoc($costoT))
  {
     $sumaCG=$sumaCG+$CyG['saldo'];
  }
//-----------------------------------------------------------

//-------------------- Ingresos ------------------------------
$sumaI=0;
$ingresos="SELECT mayo AS cuenta, ( sum( haber ) - sum( debe )  ) AS saldo
          FROM librodiario
		  INNER JOIN mayor ON ( mayor.codigom = librodiario.codigom ) 
		  INNER JOIN libro ON ( librodiario.id = libro.id ) 
		  INNER JOIN elemento ON ( elemento.codigoe = mayor.codigoe ) 
		  WHERE year =2013
		  AND elemento.codigoe =5
		  GROUP BY mayor.codigom
		  ORDER BY mayor.codigom
		  ";
		  
 $i=mysql_query($ingresos) or die(mysql_error());
 
 $ingresoT=mysql_query($ingresos) or die(mysql_error());
  while($ing=mysql_fetch_assoc($ingresoT))
  {
     $sumaI=$sumaI+$ing['saldo'];
  }
//-----------------------------------------------------------------------	


$utilidad = $sumaI-$sumaCG;

function perdidaGanancia($ingreso, $egreso)
{  
   $utilidad=$ingreso-$egreso;
   if($utilidad >0 )
      {
	       echo "<tr class='modo1'> 
	            <th >Utilidad</th>
                <th >".number_format($utilidad,2)."</th>
                <th ></th>   				
			</tr>";   	  
	  }
	else 
	{ 
	      echo "<tr class='modo1'> 
	            <th >Perdida</th>
                <th >".number_format($utilidad,2)."</th>
                 <th ></th>    				
			</tr>";   

    }	
}



//-----------------------Capital Contable ------------------------------
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
		   
$CapitalConta=mysql_query($capital) or die(mysql_error());
$CapitalT=mysql_query($capital) or die(mysql_error());
 while($CapitalContable=mysql_fetch_assoc($CapitalT))
 {
     $sumaC=$sumaC+$CapitalContable['saldo'];
 }

 $inversion=$sumaC+$utilidad;

 $capitalContable= $inversion;
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
