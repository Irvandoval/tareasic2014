<?php

require_once("../Conexion/Login.php");
Conexion::conectar();

if( isset($_SESSION["id"])  or ($_SESSION['nivel']=='1') )
{

?>

<?php

function periodo()
{
   // actualiza la fecha al dia actual
   $fecha=strftime( "%Y-%m-%d", time() );
   $actualiza="UPDATE periodocontable SET fechaactual = '".$fecha."' WHERE id=1";
   $hoy=mysql_query($actualiza) or die(mysql_error());
   // selecciona la fecha del periodo
   $periodo="SELECT * FROM periodocontable";
   $consulta=mysql_query($periodo) or die(mysql_error());
   while($ver = mysql_fetch_array($consulta))
   {
		  $fechai=$ver['fechainicio'];
		  $fechaf=$ver['fechafin'];
   }
   // compara la fecha actual con la del periodo a ver si coinciden
   $admin='1';
   $i = new DateTime($fecha);
   $f = new DateTime($fechaf);
   if($i==$f or $admin==$_SESSION['nivel'])
   {   /*
      echo "<script type='text/javascript'>
            alert('Bienvenido Selecione un ajuste que desea realizar');
           </script>";  */
   }
   else 
   {
	 echo "<script type='text/javascript'>
            alert('El periodo Contable no ha sido Cerrado');
            window.location = '../inicio.php';
           </script>";
   }
}


?>


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