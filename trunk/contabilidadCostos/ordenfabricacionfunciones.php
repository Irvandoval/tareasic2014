<?php
require_once("../Conexion/Login.php");
if(isset($_SESSION["id"]))
{

?>

<?php
// busco la orden por producto
function producto()
{
   $producto="SELECT orden, producto FROM costoproceso";
   $consulta=mysql_query($producto) or die(mysql_error());
   echo "<select name='buscarProducto'>";
         echo "<option value='0'>Seleccione un Producto</option>";
		 while($ver = mysql_fetch_array($consulta))
		 {
		     echo "<option value=".$ver['orden'].">".$ver['producto']."</option>";
	 	 }
   echo "</select>"; 
}

// aqui le paso el id de la orden que quiero que se me vaya a insertar a la tabla productoproceso
function insertarProducto()
{
  if(isset($_GET['buscarProducto']))
	{ 
	   $id=htmlentities($_GET['buscarProducto']);
	   $o="SELECT orden, producto FROM costoproceso WHERE orden=".$id;
	   $consulta=mysql_query($o) or die(mysql_error());
	    while($ver = mysql_fetch_array($consulta))
		{
		    $orden=$ver['orden'];
			$producto=$ver['producto'];
		}
       $invfinal = obtenerQ(12);// obtenemos la cantidad de leche disponible para empezar una orden
        if ($invfinal<= 0){
               echo "<script type=\"text/javascript\" >
               alert('".$invfinal."');
               setTimeout(\"location.href='ordenfabricacion.php'\",1);
            </script>"; 
        }else{
               
	   $inserta="insert into productoproceso(orden,producto,fecha) values(".$orden.",'".$producto."', now())";
       mysql_query($inserta) or die(mysql_error()); 
	   
       echo "<script type=\"text/javascript\" >
               alert('Los datos se han introducido correctamente.');
               setTimeout(\"location.href='ordenfabricacion.php'\",1);
            </script>"; 
        }
   
   	
       		
	} 
}

// esta funcion me seleciona las ordenes actuales que deseo cerrar
function buscarOrden()
{
    $cerrar="select DISTINCT  orden , producto from productoproceso order by orden";
	$consulta=mysql_query($cerrar) or die(mysql_error());
	 echo "<select name='buscarOrden'>";
            echo "<option value='0'>Orden a Cerrar</option>";
		while($ver = mysql_fetch_array($consulta))
		{
		    $or=$ver['orden'];
			$e='-';
			echo "<option value=".$ver['orden'].">".$or." ".$e." ".$ver['producto']." </option>";
		}
   echo "</select>"; 
}

// esta funcion me calcula la diferencia en dias entre dos fechas, la primera es la inicial , la segunda es la final
function DiferenciaDias($fecha_inicio, $fecha_fin)
{ 
  $fecha_i = strtotime($fecha_inicio); 
  $fecha_f = strtotime($fecha_fin); 
  $diferencia = $fecha_f - $fecha_i; 
  return round($diferencia / 86400); 
} 

// ejemplo para llamarla:  echo DiferenciaDias("2013-11-30", "2013-12-31");


// busca la funcion que se va a procesar
function buscarOrdenProceso()
{
    $cerrar="select  orden , producto from productoproceso order by orden";
	$consulta=mysql_query($cerrar) or die(mysql_error());
	 echo "<select name='buscarOrdenProceso'>";
            echo "<option value='0'>Orden a Cerrar</option>";
		while($ver = mysql_fetch_array($consulta))
		{
			echo "<option value=".$ver['orden'].">".$ver['producto']." </option>";
		}
   echo "</select>"; 
}

// muestra los costos de la funcion a procesar
function verOrdenProceso()
{
  if(isset($_GET['buscarOrdenProceso']))
	{
	     $o=htmlentities($_GET['buscarOrdenProceso']);
         $orden= "SELECT 
            productoproceso.orden, 
            productoproceso.producto, 
			productoproceso.fecha, 
			costoproceso.costoproduccion, 
			costoproceso.costoadministracion, 
			costoproceso.costoventa, 
			costoproceso.costofinanciero, 
			costoproceso.costototal
            FROM productoproceso, costoproceso
            WHERE productoproceso.orden = costoproceso.orden and  productoproceso.orden='".$o."' ";
				  
		$consulta=mysql_query($orden) or die(mysql_error());
        echo "<table border='0'  class='tabla'>";
	    while($ver = mysql_fetch_array($consulta))
	    {
		  echo" <tr class='modo3'>
		            <td> Orden </td> 
			   	    <td> Producto </td>
				    <td> Fecha </td>
				    <td> Costo Produccion </td>
				    <td> costo Administracion </td>
		            <td> Costo Venta </td>
				    <td> costo Financiero </td>
				    <td> Costo Total </td>
                </tr>";  
          echo"<tr class='modo2'> 
		           <td>".$ver['orden']."</td>  
                   <td>".$ver['producto']."</td>
                   <td>".$ver['fecha']."</td>
                   <td>".number_format($ver['costoproduccion'],2)."</td>
                   <td>".number_format($ver['costoadministracion'],2)."</td>
                   <td>".number_format($ver['costoventa'],2)."</td>
                   <td>".number_format($ver['costofinanciero'],2)."</td>
                   <td>".number_format($ver['costototal'],2)."</td>	 				   
               </tr>";  				 
	   }
	   echo "</table>"; 
    }		
	
	

}
   
  // obtenes el valor actual de unidades en inventario
    
function obtenerQ($s){
    

$k="SELECT producto from transaccion where producto=".$s;
$pk=mysql_query($k) or die(mysql_error());
while($prok=mysql_fetch_assoc($pk)) 
{
    $kardex=$prok['producto'];
}

$cuenta="SELECT count( id ) AS n FROM transaccion";
$n=mysql_query($cuenta) or die(mysql_error());
while($r=mysql_fetch_assoc($n)) 
{
	  
	$qi=0;
    $saldoi=0;	
	$inventario="SELECT  id,fecha, descripcion ,codigo, cantidad, preciou, saldo FROM transaccion where codigo=0 and producto='".$s."' ";
	$invenIni=mysql_query($inventario) or die(mysql_error());
    while($inv=mysql_fetch_assoc($invenIni))
	{
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

	   	$transa="SELECT  distinct codigo, fecha, descripcion, id, cantidad, preciou ,saldo  FROM transaccion  where codigo>0 and producto='".$s."' order by id";
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
              $bandera=$bandera+$i;		 
			}
			else
			{
			 
			  $saldo=$costopro*$cp['cantidad'];  
			  $uni=$uni-$cp['cantidad']; 
              $total=$total-$saldo;              
			  $costopro=$total/$uni;
			  $bandera=$bandera+$i;	
			
			}
        } 
		}
    }
    }	


    return $uni;
    
}

// esta funcion cerramos la orden y la terminamos para poder realizar la venta
function cerrarOrden()  
{
    $razonltkg = 1.033;// conversion de litros a kg de leche
    $razonkglt = 0.968;//conversion de kg a litros de leche
  if(isset($_GET['buscarOrden']))
	{
       $id=htmlentities($_GET['buscarOrden']);
	   $co="SELECT * FROM productoproceso WHERE orden=".$id; 
       $consultaCO=mysql_query($co) or die(mysql_error());	   
	
	   while($ver = mysql_fetch_array($consultaCO))
	   {
		    $fecha=$ver['fecha'];
			$producto=$ver['producto'];
	   }
       //$fecha_fin=date("d-m-Y"); 
	   $fecha_fin=date("Y-m-d H:i:s", strtotime ("next Thursday")); 
	   $dias=DiferenciaDias($fecha,$fecha_fin);
	   $cp="SELECT * FROM costoproceso WHERE producto='".$producto."' ";
	   $consultaCP=mysql_query($cp) or die(mysql_error());
	   
	    while($ver = mysql_fetch_array($consultaCP))
	    {
		    $cpro=$ver['costoproduccion'];
			$cadm=$ver['costoadministracion'];
		    $cven=$ver['costoventa'];
            $cfin=$ver['costofinanciero'];
            $k=$ver['numerokilos'];			
	    }
		$costopro=($cpro/30)*$dias;
		$costoadm=($cadm/30)*$dias;
		$costoven=($cven/30)*$dias;
        $costofin=($cfin/30)*$dias;
	    $costoTotal= $costopro + $costoadm + $costoven + $costofin ;  
	    
		if($dias<0){
		   $dias=10;
		} 

		$kilos=($k/30)*$dias;
		$costoT =round($costoTotal,2);
		
		$precioUnitario=round($costoT/$kilos,2);
         
        $minl =obtenerQ(12);// obtenemos los litros de leche disponibles
       
         if($minl*$razonltkg<$kilos){
              echo "<script type=\"text/javascript\" >
               alert('ERROR, No hay insumos suficientes en existencia, no se ha efectuado el cierre de la orden');
               setTimeout(\"location.href='ordenfabricacion.php'\",1);
            </script>";   
             
         }else{
             
		$productoTerminado="insert into productoterminado(orden,producto,costoproduccion, costoadministracion, costoventa, costofinanciero,costototal, numerokilos, preciounitario) values('".$id."','".$producto."','".$costopro."','".$costoadm."','".$costoven."','".$costofin."', '".$costoTotal."', '".$kilos."', '".$precioUnitario."')";
		$consultaProdcutoTerminado=mysql_query($productoTerminado) or die(mysql_error());
	
		$eliminaOrden="DELETE FROM productoproceso WHERE orden =".$id;
		$consultaEliminaOrden=mysql_query($eliminaOrden) or die(mysql_error());
		
      $saldo = $k*$precioUnitario;
      //mandamos la orden terminada al inventario de producto final correspondiente
      $transaccion="insert into transaccion(codigo,descripcion,fecha,cantidad,preciou,saldo, producto) values("."'1','ORDEN DE  FABRICACION "."$fecha','".$fecha."','".$kilos."','".$precioUnitario."', '".$saldo."' , '".$id."')";
      $queryTransact = mysql_query($transaccion) or die (mysql_error);
		
     $transaccion="insert into transaccion(codigo,descripcion,fecha,cantidad,preciou,saldo, producto) values("."'2','INSUMO LECHE,ORDEN DE FABRICACION "."$fecha','".$fecha."','".round($kilos*$razonkglt,0)."','".$precioUnitario."', '".$saldo."' , 12)";
      $queryTransact = mysql_query($transaccion) or die (mysql_error);
              echo "<script type=\"text/javascript\" >
               alert('La Orden ha sido cerrada y Terminada.');
               setTimeout(\"location.href='ordenfabricacion.php'\",1);
            </script>"; 
         }
      
		
		
	}
}


    
function buscarOrdenTerminada()
{
    $buscaOT="SELECT  distinct DISTINCT orden, producto FROM productoterminado  order by id";
	$consulta=mysql_query($buscaOT) or die(mysql_error());
	 echo "<select name='buscarOrdenTerminada'>";
            echo "<option value='0'>Seleccione la mostrar</option>";
		while($ver = mysql_fetch_array($consulta))
		{
		    $or=$ver['orden'];
			$e='-';
			echo "<option value=".$ver['orden'].">".$or." ".$e." ".$ver['producto']." </option>";
		}
   echo "</select>"; 
}

function verOrdenTerminada()
{
  if(isset($_GET['buscarOrdenTerminada']))
	{
	  $id=htmlentities($_GET['buscarOrdenTerminada']); 
      $selecciona="SELECT * FROM productoterminado where orden=".$id;
	  $consulta=mysql_query($selecciona) or die(mysql_error());
	  
	  echo "<table border='0'  class='tabla'>";
	  while($ver = mysql_fetch_array($consulta))
	  {
		echo" <tr class='modo3'>
		          <td> Orden </td> 
				  <td> Producto </td>
				  <td> Costo Total </td>
				  <td> Kilos </td>
				  <td> Precio Unitario </td>
              </tr>";  
        echo"<tr class='modo2'> 
		         <td>".$ver['orden']."</td>  
                 <td>".$ver['producto']."</td>
                 <td>".number_format($ver['costototal'],2)."</td>
                 <td>".$ver['numerokilos']."</td>
                 <td>".number_format($ver['preciounitario'],2)."</td>	
             </tr>";  				 
	 }
	 echo "</table>"; 
    }
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
