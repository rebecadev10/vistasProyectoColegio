$("#frmAcceso").on('submit', function(e) {
    e.preventDefault();
    
    let nombreUsu = $("#nombreUsu").val();
    let clave = $("#clave").val();
    
    console.log("verificando usuario...");

    // Agregamos "json" al final para que jQuery convierta la respuesta automáticamente
    $.post("controlador/usuario.php?op=verificar", {
        "nombreUsu": nombreUsu,
        "clave": clave
    }, function(data) {
        console.log(data);

        // Validamos si data tiene contenido (si el login fue exitoso)
        if (data && data !== "null") { 
            console.log("usuario correcto :)");
            // Una sola forma de redirección es suficiente
            window.location.href = "index.php";
        } else {
            console.warn("ERROR intenta nuevamente");
            window.alert("Usuario y/o Password incorrectos");
        }
    }, "json"); // <--- Importante definir el tipo de dato
});

// Optimización del botón Ver Contraseña
const passwordField = document.getElementById('clave');
const viewPasswordBtn = document.getElementById('viewPassword');

viewPasswordBtn.addEventListener('click', () => {
    const isPassword = passwordField.type === 'password';
    passwordField.type = isPassword ? 'text' : 'password';
});