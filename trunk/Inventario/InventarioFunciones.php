<?php
require_once("../Conexion/Login.php");
if(isset($_SESSION["id"]))
{

?>


<?php

function transaccion() 
{

$kardex=0;
$k="SELECT producto from transaccion where id=(SELECT max(id) from transaccion)";
$pk=mysql_query($k) or die(mysql_error());
while($prok=mysql_fetch_assoc($pk)) 
{
  if($prok['producto']==null){
    $kardex=0;
  }
  else 
  {
    $kardex=$prok['producto'];
  }	
}

$cuenta="SELECT count( id ) AS n FROM transaccion";
$n=mysql_query($cuenta) or die(mysql_error());
while($r=mysql_fetch_assoc($n)) 
{

echo "<table border=1 class='tabla'>
      <tr class='modo1'>
	    <th rowspan='2' class='modo1'>N</th>
	    <th rowspan='2' class='modo1'>Fecha</th>
		<td rowspan='2' class='modo1'>Descripcion</td>
        <th colspan='3' class='modo1'>Entrada</th>
        <th colspan='3' class='modo1'>Salida</th>
        <th colspan='3' class='modo1'>Saldo</th> 
      </tr>
	  <tr class='modo1'>
        <td class='modo1'>Q</td>
        <td class='modo1'>PU</td>
        <td class='modo1'>Total</td> 
		<td class='modo1'>Q</td>
        <td class='modo1'>PU</td>
        <td class='modo1'>Total</td> 
		<td class='modo1'>Q</td>
        <td class='modo1'>PU</td>
		 <td class='modo1'>Total</td> 
      </tr>
	  ";
	  
	$qi=0;
    $saldoi=0;	
	$inventario="SELECT  id,fecha, descripcion ,codigo, cantidad, preciou, saldo FROM transaccion where codigo=0 and producto='".$kardex."' ";
	$invenIni=mysql_query($inventario) or die(mysql_error());
    while($inv=mysql_fetch_assoc($invenIni))
	{
	     echo"<tr class='modo3'>
		     <td class='modo3'>".$inv['id']."</td>
		     <td class='modo3'>".$inv['fecha']."</td>
			 <td class='modo3'>".$inv['descripcion']."</td>
	         <td class='modo3'>".$inv['cantidad']."</td>
			 <td class='modo3'>".$inv['preciou']."</td>
			 <td class='modo3'>".$inv['saldo']."</td> 
			 <td class='modo3'></td>
			 <td class='modo3'></td>
			 <td class='modo3'></td> 
			 <td class='modo3'>".$inv['cantidad']."</td>
			 <td class='modo3'>".$inv['preciou']."</td>
			 <td class='modo3'>".$inv['saldo']."</td> 
		   </tr>";	 
		   $qi=$inv['cantidad']; 
	       $pui=$inv['preciou']; 
	       $saldoi=$inv['saldo']; 
	} 

    $opcion=1; 
	$precio=0;
	$total=0;   
	$bandera=0;  
	$costopro=0;
	$uni=$qi;
	$total=$saldoi;
	for($i=1; $i<=$r['n']; $i++)
	{

	   	$transa="SELECT  distinct codigo, fecha, descripcion, id, cantidad, preciou ,saldo  FROM transaccion  where codigo>0 and producto='".$kardex."' order by id";
	    $inven=mysql_query($transa) or die(mysql_error());
		$bandera=$bandera+$i;
        if($bandera==$i ) 
		{
		while($cp=mysql_fetch_assoc($inven)) 
	    {
		    if( $opcion==$cp['codigo']  )
			{
			  $saldo=$cp['cantidad']*$cp['preciou'];
			  $uni=$uni+$cp['cantidad'];
              $total=$total+$saldo;
			  $costopro=$total/$uni;
			  echo"<tr class='modo4'>
			  <th class='modo4'>".$cp['id']."</th> 
			  <th class='modo4'>".$cp['fecha']."</th>
			  <th class='modo4'>".$cp['descripcion']."</th>
	          <th class='modo4'>".$cp['cantidad']."</th>
			  <th class='modo4'>".round($cp['preciou'],2)."</th>
			  <th class='modo4'>".round($cp['saldo'],2)."</th> 
			  <th class='modo4'></th>
			  <th class='modo4'></th>
			  <th class='modo4'></th> 
			  <th class='modo4'>".$uni."</td>
			  <th class='modo4'>".round($costopro,2)."</th>
			  <th class='modo4'>".round($total,2)."</th> 
		     </tr>";
            	 $bandera=$bandera+$i;		 
			}
			else
			{
			 
			  $saldo=$costopro*$cp['cantidad'];  
			  $uni=$uni-$cp['cantidad']; 
              $total=$total-$saldo;              
			  $costopro=$total/$uni;
			  echo"<tr class='modo5'>
			  <th >".$cp['id']."</th>
			  <th >".$cp['fecha']."</th>
			  <th >".$cp['descripcion']."</th>
			  <th ></th>
			  <th ></th>
			  <th ></th> 
	          <th >".$cp['cantidad']."</th>
			  <th >".round($costopro,2)."</th>
			  <th >".round($saldo,2)."</th>  
			  <th >".$uni."</th>
			  <th >".round($costopro,2)."</th>
			  <th >".round($total,2)."</th> 
		     </tr>";	
			  $bandera=$bandera+$i;	
			
			}
        } 
		}
        		
    }	
	
echo "</table>";

}

}

function buscaProducto()
{
   $busca="SELECT orden, producto FROM costoproceso";
   $producto=mysql_query($busca) or die(mysql_error());
   echo "<select name='buscarProductoKardex'>";
   echo "<option value='0'>Seleccionar Producto</option>";
		while($ver = mysql_fetch_array($producto))
		{

			echo "<option value=".$ver['orden'].">".$ver['producto']." </option>";
		}
   
   echo "</select>"; 
   

}

function buscaProducto2()
{
   $busca="SELECT orden, producto FROM costoproceso";
   $producto=mysql_query($busca) or die(mysql_error());
   echo "<select name='buscarProductoKardex'>";
   echo "<option value='0'>Seleccionar Producto</option>";
		while($ver = mysql_fetch_array($producto))
		{

			echo "<option value=".$ver['orden'].">".$ver['producto']." </option>";
		}
   echo "<option value=12>Leche</option>";
   echo "</select>"; 
   

}


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


