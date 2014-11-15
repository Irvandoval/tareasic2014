
$(document).ready(function()
{ 
	 $("#nfila").val(0);
});  
 
function checnum(as)
{
	  var a = as.value;
	  as.value = a.replace(/[^\d.]/g, "");	  
}

function campo_entrada(val) 
{
	  var nfila = parseFloat($("#nfila").val());
	  var ind = nfila+val;
	  $("#selec").append("<select id=sel"+ind+" onchange=calculo_inventario(this)> <option value=suma>Compra</option> <option value=resta>Venta</option> </select> <br> <span style='float:right; font-weight:bold;'> Unidades </span> <br> <br> ");
	  $("#unidad").append("<input type=text id=uni"+ind+" onkeyup=checnum(this);metodoCostoPromedio(); size=5> <br> <input type=text id=balu"+ind+" readonly size=5> <br> <br>");
	  $("#costou").append("<input type=text id=cos"+ind+" onkeyup=checnum(this);metodoCostoPromedio(); size=5> <br> &nbsp; <br> <br>");
	  $("#saldo").append("<input type=text id=tot"+ind+" size=5 readonly> <br> <input type=text id=balt"+ind+" size=5 readonly> <br> <br>");
	  $("#costop").append("<br> <input type=text id=avg"+ind+" size=5 readonly> <br> <br>");
	  $("#nfila").val(ind);
}

function calculo_inventario(obj)
{
	  var curid = obj.id;
	  var sval = curid.replace("sel","");
	  var curval = obj.value;
	  if(curval=="resta")
	  {
		    $("#cos"+sval).attr("readonly", "true");
	  }
	  else
	  {
		    $("#cos"+sval).removeAttr("readonly");
	  }
	  metodoCostoPromedio();
}

function metodoCostoPromedio()
{ 
	var unidadi = isnotnum(parseFloat($("#unidadi").val()));  
	var costoi = isnotnum(parseFloat($("#costoi").val()));
	var saldoi = unidadi * costoi;
	$("#saldoi").val(saldoi);
	$("#costoproi").val(costoi);
	
	var nfila = $("#nfila").val();  
	var len = nfila + 1;
        var opcion, unidades, costounitario, saldo, costopromedio;
	var baluni = unidadi;
	var baltot = saldoi;
	
	for(i=0;i<len;i++)
	{
		    opcion = $("#sel"+i).val();
		    unidades = isnotnum(parseFloat($("#uni"+i).val()));
		    if(opcion=="suma")
		    {
		 	      costounitario = isnotnum(parseFloat($("#cos"+i).val()));
			      saldo = unidades * costounitario;
			      baluni = baluni + unidades;
			      baltot = baltot + saldo;
			      costopromedio = redondear(baltot / baluni);
			      $("#tot"+i).val(saldo);
			      $("#balu"+i).val(baluni);
			      $("#balt"+i).val(baltot);
			      $("#avg"+i).val(isnotnum(costopromedio));
		    }
		    else
		    {
			      if(i==0)
			      {
					costounitario = costoi;
			      }
			      else
			      {
					costounitario = isnotnum(parseFloat($("#avg"+(i-1)).val()));
			      }
			      saldo = unidades * costounitario;
			      baluni = baluni - unidades;
			      baltot = baltot - saldo;
			      costopromedio = redondear(baltot / baluni);
			      $("#tot"+i).val(saldo);
			      $("#balu"+i).val(baluni);
			      $("#balt"+i).val(baltot);
			      $("#avg"+i).val(isnotnum(costopromedio));
		    }
	}
}

function isnotnum(obj)
{
	  if(isNaN(obj) || obj==Infinity)
	  {
		    return 0;
	  }
	  else
	  {
		    return obj;
	  }
}

function redondear(val)
{
      return Math.round(100 * val) / 100;
}

function limpiar()
{
         $("#selec").html("");
         $("#unidad").html("");
         $("#costou").html("");
         $("#saldo").html("");
         $("#costop").html("");
}