<?php

require_once("../Conexion/Login.php");
Conexion::conectar();
if($_SESSION['nivel']=='1')
{

?>

<html>
<head>
  <link rel="stylesheet" type="text/css" href="../css/estilo.css" media="screen" />
    <link rel='stylesheet' href='../css/menu.css' type='text/css' />
</head>

<body>


<div id="wrapper">
  <div id="pagina">
  
   <header> 
     
  </header>

 
  <?php
   include('../menu.php');
	menu2();
  echo "<table class='tabla'>";
      echo "<tr class='modo3'><td><a href='../libroDiario/libroDiarioAnual.php'> <font color='gray'> Ver Libro Diario </font></a></td></tr>"; 
	  echo "<tr class='modo3'><td><a href='../balanceComprobacion/balanceComprobacionAnual.php'> <font color='gray'> Ver Balance de Comprobacion </font></a></td></tr>";
      echo "<tr class='modo3'><td><a href='../estadoResultados/EstadoResultado.php'> <font color='gray'> Ver Estado de Resultado </font></a></td></tr>";
      echo "<tr class='modo3'><td><a href='../estadoCapital/EstadoCapital.php'> <font color='gray'> Ver Estado de Capital </font></a></td></tr>";
      echo "<tr class='modo3'><td><a href='../balanceGeneral/BalanceGeneral.php'> <font color='gray'> Ver Balance General </font></a></td></tr>";
   echo "</table>";
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
            window.location = '../inicio.php';
          </script>";
    }

?>
