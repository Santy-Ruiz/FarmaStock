<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/css/style.css">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<?php
session_start();
if(!empty($_SESSION['id_tipo_usuario'])){
    header('location: controlador/LoginController.php');
}
else{
session_destroy();
?>
<body>
    <img class="wave" src="img/login1.png" alt="">
    <div class="contenedor">
        <div class="img">
            <img src="img/medicine.svg" alt="">
        </div>
        <div class="contenido-login">
            <form action="controlador/LoginController.php" method="post">
                <img src="img/doctor.png" alt="Doctor">
                <h2>FarmaStock</h2>
                <div class="input-div documento_identidad">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Documento de identidad</h5>
                        <input type="text" name="user" class="input" required>
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Contraseña</h5>
                        <input type="password" name="pass" class="input" required>
                    </div>
                </div>
                <input type="submit" class="btn" value="Iniciar Sesion">
            </form>
        </div>
    </div>

    <script>
        // Leemos la URL buscando la variable "error"
        const urlParams = new URLSearchParams(window.location.search);
        const error = urlParams.get('error');

        if (error == '1') {
            Swal.fire({
                icon: 'error',
                title: 'Acceso Denegado',
                text: 'El documento de identidad o la contraseña son incorrectos.',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Intentar de nuevo'
            }).then(() => {
                
                window.history.replaceState(null, null, window.location.pathname);
            });
        }
    </script>

    <script src="js/login.js"></script>
</body>
</html>
<?php
}
?>