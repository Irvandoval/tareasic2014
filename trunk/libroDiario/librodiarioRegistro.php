<?php
require_once("../Conexion/Login.php");
Conexion::conectar();
if(isset($_SESSION["id"]))
{

?>

<?php


if(isset($_POST['n']) && !empty($_POST['n']) && isset($_POST['cuenta']) && !empty($_POST['cuenta']) && isset ($_POST['deber']) && !empty($_POST['deber'])&&isset($_POST['haber']) && !empty($_POST['haber']) &&isset($_POST['f_rangeStart']) && !empty($_POST['f_rangeStart']) &&isset($_POST['partida']) && !empty($_POST['partida']) &&isset($_POST['descripcion']) && !empty($_POST['descripcion']) ) 
{
$registros=$_POST['n'];
$cuentas=($_POST['cuenta']);
$deber=$_POST['deber'];
$haber=$_POST['haber'];
$fecha=($_POST['f_rangeStart']);
list($ano, $mes, $dia) = explode("-",$fecha); 
$partida=$_POST['partida'];
$descripcion=$_POST['descripcion'];

$id="select id from libro where dia=".$dia." and mes=".$mes." and year=".$ano." and partida=".$partida;
 if(mysql_num_rows(mysql_query($id))!=0)
   {
	echo "<script type=\"text/javascript\" >
            alert('El numero de partida ".$partida." con fecha ".$fecha." ya existe en el registro');
            setTimeout(\"location.href='librodiarioPartida.php'\",1);
          </script>";
   }
 else
	{
	  $sumad=0; 
	  $sumah=0;
      for($i=0;$i<$registros;$i++)
	  {  
   		 $sumad=$sumad+$deber[$i];
         $sumah=$sumah+$haber[$i];
	  }
	  if($sumad==$sumah)
	  {
        $libro="insert into libro(partida,fecha,dia,mes,year,descripcion) values(".$partida.", "."'".$fecha."'".",".$dia.",".$mes.",".$ano.",'".$descripcion."')";
        mysql_query($libro) or die(mysql_error());
        $movimiento=mysql_result(mysql_query($id) ,0);
        for($i=0;$i<$registros;$i++)
	    {		
	      $librodiario="insert into librodiario(id,codigom,debe,haber) values(".$movimiento.",".$cuentas[$i].",".$deber[$i].",".$haber[$i].")";
	       mysql_query($librodiario) or die(mysql_error());
        } 
		echo "<script type=\"text/javascript\" >
		        alert('Transacción realizada con exito');
                setTimeout(\"location.href='librodiario.php'\",1);
              </script>";
	  }
	  else 
	     {
		    echo "<script type=\"text/javascript\" >
		   alert('No cumple partida doble');
           setTimeout(\"location.href='librodiario.php'\",1);
           </script>";
		}

    }
}
else
{
 echo "<script type=\"text/javascript\" >
		   alert('Error, el registro de partida debe ir completo sin ningun campo vacio');
           setTimeout(\"location.href='librodiario.php'\",1);
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
