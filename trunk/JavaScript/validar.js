 
 limpiarLogin()
{
    document.getElementById("login").reset();
    document.getElementById("usuario").focus();
}

function limpiarRegistro()
{
    document.getElementById("registro").reset();
    document.getElementById("nombre").focus();
}


function validaLogin()
{
    var log = document.getElementById("login");
    
    
    if(log.usuario.value == 0){
        alert("Ingrese su Login, Por Favor !!!");
        log.usuario.value = "";
        log.usuario.focus();
        
        return false;
    }
    
    if(log.password.value == 0){
        alert("Ingrese su Password, Por Favor !!!");
        log.password.value = "";
        log.password.focus();
        
        return false;
    }
    
    log.submit();
}



