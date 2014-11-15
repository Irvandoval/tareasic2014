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
		
	   $inserta="insert into productoproceso(orden,producto,fecha) values(".$orden.",'".$producto."', now())";
       mysql_query($inserta) or die(mysql_error()); 
	   
       echo "<script type=\"text/javascript\" >
               alert('Los datos se han introducido correctamente.');
               setTimeout(\"location.href='ordenfabricacion.php'\",1);
            </script>"; 	
       		
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

// esta funcion cerramos la orden y la terminamos para poder realizar la venta
function cerrarOrden()  
{
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
		
		$productoTerminado="insert into productoterminado(orden,producto,costoproduccion, costoadministracion, costoventa, costofinanciero,costototal, numerokilos, preciounitario) values('".$id."','".$producto."','".$costopro."','".$costoadm."','".$costoven."','".$costofin."', '".$costoTotal."', '".$kilos."', '".$precioUnitario."')";
		$consultaProdcutoTerminado=mysql_query($productoTerminado) or die(mysql_error());
	
		$eliminaOrden="DELETE FROM productoproceso WHERE orden =".$id;
		$consultaEliminaOrden=mysql_query($eliminaOrden) or die(mysql_error());
		
		//srand(time());
        //$aleatorio = rand(0,100);
        //$salario=($aleatorio/100)*3500;
		
		
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
