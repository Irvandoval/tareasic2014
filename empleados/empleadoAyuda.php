<?php

require_once("../Conexion/Login.php");
Conexion::conectar();
if(isset($_SESSION["id"]))
{


?>

<html>
<head>
  <link rel="stylesheet" type="text/css" href="../css/estilo.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="../css/menu.css" media="screen" />
</head>

<body>


<div id="wrapper">
  <div id="pagina">
   
  <header> 
     
  </header>
    <?php
	include ('../menu.php'); 
	menu2();
    ?>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br>



<?php






?>

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
            window.location = '../index.php';
          </script>";
    }
	
?>
