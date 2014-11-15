<?php

require_once("../Conexion/Login.php");
Conexion::conectar();
if($_SESSION['nivel']=='1')
{

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" type="text/css" href="../Css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="../Css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="../Css/steel.css" />
    <script type="text/javascript" src="../JavaScript/jscal2.js"></script>
    <script type="text/javascript" src="../JavaScript/es.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/estilo.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../css/menu.css" media="screen" />
</head>
<body>

<body>

<div id="wrapper">
<div id="pagina">

<header> 
</header>


<?php
  
include('../menu.php');
menu2();
?>

<div id="derecha">
<fieldset> 
<legend>Iniciar Periodo</legend>
<?php
include('usuariosFunciones.php'); 
mostrarPeriodo();
?> 

<br>
<input type="submit" class="boton purpura formaBoton" value="actualizar" name="actualizar" /> 
<input  type="hidden" name="cambiar"  value="si" />
</form> 
</fieldset>   
</div>

<div id="izquierda">
<fieldset> 
<legend>Periodo Contable</legend>
   <div  align="justify">      
   <?php intro(); ?>
   </div>
</fieldset>   
</div>

<footer>
</footer>

</div>
</div>
 
</body>


<?php

}
else{
    echo "<script type='text/javascript'>
            alert('Acceso denegado!!');
            window.location = '../inicio.php';
          </script>";
    }

?>
