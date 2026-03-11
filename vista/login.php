<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">

</head>
<body>
    <img class="wave" src="../img/login1.png" alt="">
    <div class = "contenedor">
        <div class = "img" >
            <img src="../img/medicine.svg" alt="">
        </div>
        <div class="contenido-login">
            <form action="">
                <img src="../img/doctor.png" alt="Doctor">
                <h2>Farmacia</h2>
                <div class="input-div documento_identidad">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Documento de identidad</h5>
                        <input type="documento" name = "user" class="input">
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Contraseña</h5>
                        <input type="Passsword" name = "pass" class="input">
                    </div>
                </div>
                <a href="">Create warpiece</a>
                <input type="sumbit" class = "btn" value="Iniciar sesion">
            </form>
        </div>
    </div>
</body>
<script src="../js/login.js"></script>
</html>