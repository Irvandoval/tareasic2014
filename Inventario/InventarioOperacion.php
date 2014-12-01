 
<?php
require_once("../Conexion/Login.php");
Conexion::conectar();
if(isset($_SESSION["id"]))
{


if(isset($_POST['operacion']) &&  isset($_POST['descripcion']) && isset($_POST['f_rangeStart']) && !empty($_POST['f_rangeStart']) && isset($_POST['cantidad']) && isset($_POST['precio']) && isset($_POST['buscarProductoKardex']) && !empty($_POST['buscarProductoKardex']) )
{ 
	$operacion=$_POST['operacion'];  
    $descripcion=$_POST['descripcion'];    
    $fecha=$_POST['f_rangeStart'];
    $cantidad=$_POST['cantidad'];
    $precio=$_POST['precio'];
	$saldo=$cantidad*$precio;
	$producto=$_POST['buscarProductoKardex'];  
	
	if($_POST['operacion']=='1' or  $_POST['operacion']=='0') 
	{
	  $transaccion="insert into transaccion(codigo,descripcion,fecha,cantidad,preciou,saldo, producto) values(".$operacion.",'".$descripcion."','".$fecha."','".$cantidad."','".$precio."', '".$saldo."' , '".$producto."')";
      mysql_query($transaccion) or die(mysql_error());  
	  echo "<script type=\"text/javascript\" >
               alert('Los datos se han introducido correctamente.');
               setTimeout(\"location.href='Inventario.php'\",1);
           </script>";
    }else
	{
	  $transaccion="insert into transaccion(codigo,descripcion,fecha,cantidad,preciou,saldo, producto) values(".$operacion.",'".$descripcion."','".$fecha."','".$cantidad."','".$precio."','1', '".$producto."')";
      mysql_query($transaccion) or die(mysql_error());  
	  echo "<script type=\"text/javascript\" >
               alert('Los datos se han introducido correctamente.');
               setTimeout(\"location.href='Inventario.php'\",1);
           </script>";
	}
	
	
} 
else {
     echo "<script type=\"text/javascript\" >
               alert('Error en la transaccion');
               setTimeout(\"location.href='Inventario.php'\",1);
           </script>";

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
