<?php
require_once("../Conexion/Login.php");
if(isset($_SESSION["id"]))
{

?>

<html>
<head>
  <link rel="stylesheet" type="text/css" href="../css/boton.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="../css/estilo.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="../css/menu.css" media="screen" />
</head>
<?php
include('empleadosFunciones.php');
Conexion::conectar();
?>
 
<body>
<div id="wrapper">
  <div id="pagina">

  <header> 
     
  </header>
  <?php
    include('../menu.php');
	menu2();
  ?> 
 
  <footer>
  </footer>
  
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
  
  </div>  
</div> 
</body>

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
