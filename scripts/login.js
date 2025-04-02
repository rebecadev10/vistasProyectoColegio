$("#frmAcceso").on('submit',function(e)
{
	e.preventDefault();
    nombreUsu=$("#nombreUsu").val();
    clave=$("#clave").val();
console.log("verificando usuario")
    $.post("controlador/usuario.php?op=verificar",
        {"nombreUsu":nombreUsu,"clave":clave},
        function(data)
        
    {
        console.log(data)
        if (data !==null)
        {
            console.log("usuario correcto :)")
            // $(location).attr("href","index.php");            
            window.location.href="./index.php";
        }
        else
        {
            console.warn("ERROR intenta nuevamente")
            window.alert("Usuario y/o Password incorrectos");
            
        }
    });
}) 
let password = document.getElementById('clave');
let viewPassword = document.getElementById('viewPassword');
let click = false;

viewPassword.addEventListener('click', (e)=>{
  if(!click){
    password.type = 'text'
    click = true
  }else if(click){
    password.type = 'password'
    click = false
  }
})

