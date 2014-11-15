<?php

function isr($ingresos)
{  
 
  switch($ingresos)
  {
    case ($ingresos>=0.01 && $ingresos<=4064.00);
	      $isr=0; 
	break;
	
    case ($ingresos>=4064.01 && $ingresos<=9142.86):
		  $isr= (($ingresos-4064.00)*0.10)+212.12;
    break;		  
    case ($ingresos>=9142.87 && $ingresos<=22857.14);
          $isr= (($ingresos-9142.86)*0.20)+720.00;
    break;
	
	case $ingresos>=22857.15;
          $isr= (($ingresos-22857.14)*0.30)+3462.86;
    break;
	
    default;
        echo 'Error...';
    break;
  }  
   return  $isr;
}

function isss($ingresos)
{
  switch($ingresos)
  {
    case ($ingresos>=0.01 && $ingresos<=685.71);
	      $isss=$ingresos*0.30; 
	break;
	case $ingresos>=685.72;
          $isss=20.57;
    break;
	
    default;
        echo 'Error...';
    break;
  }
  return $isss;
}	  
 
function afp($ingresos)
{
  return ($ingresos*0.0625);
}	 

?>  
 

