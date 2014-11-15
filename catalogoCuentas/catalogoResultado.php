<?php
require_once("../Conexion/Login.php");
if(isset($_SESSION["id"]))
{

?>
<html>
<head>  
 <meta http-equiv="Refresh" content="5;url=catalogoCuentas/catalogo.php">  
  

</head>  
<?php

   while (ob_get_level())
   {
	  ob_end_clean();
	  header("Content-Encoding: None", true);
   }
   if( isset($_POST['cuenta']) && !empty($_POST['cuenta'])&& isset($_POST['subcuenta']) && !empty($_POST['subcuenta'])&& isset($_POST['codigo']) && !empty($_POST['codigo'])&& isset($_POST['cuentat']) && !empty($_POST['cuentat']) )  
   {
	$cuenta=htmlentities($_POST['cuenta']);  
	$subcuenta=htmlentities($_POST['subcuenta']); 
	$codigo=htmlentities($_POST['codigo']); 
	$cuentat=htmlentities($_POST['cuentat']);

	$sql = "INSERT INTO mayor VALUES ('$codigo','$cuenta','$subcuenta','$cuentat')";
    Conexion::conectar();
	
	$resultado = mysql_query($sql);
  
	    echo "<script type='text/javascript'>
                    alert('Se ha creado la cuenta satisfactoriamente!');
                    window.location = 'catalogoNuevo.php';
              </script>";
   }
   else 
   {

    echo "<script type='text/javascript'>
            alert('Error no se ha podido crear la cuenta!');
            window.location = 'catalogoNuevo.php';
          </script>";

   }
				  

 ?>
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

