<?php
session_start();
//session_unregister("id");
session_destroy();
header("Location: ../index.php");  
?>