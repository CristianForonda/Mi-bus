<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login |Compiladores|</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <div class="contenedor-form">
        <div class="toggle">
            <span> Crear Cuenta</span>
        </div>
        
        <div class="formulario">
            <h2>Iniciar Sesión</h2>
            <form method="POST" action="index.php">
                <input type="text" placeholder="Correo Electronico" name="correo" required >
                <input type="password" placeholder="Contraseña"name="clave" required>
                <input type="submit" value="Iniciar Sesión" name="enviarlog" >
            </form>

            <?php

				if (isset($_POST['enviarlog'])) {
					include "../Controller/validar_login.php";
				}

			?>

        </div>
        
        <div class="formulario">
            <h2>Crea tu Cuenta</h2>
            <form method="POST" action="index.php">
                <input type="text" placeholder="Nombres" name="nombres" required>
                
                <input type="text" placeholder="Apellidos" name="apellidos" required>
                
                <input type="email" placeholder="Correo Electronico" name="correo" required>

                <input type="password" placeholder="Contraseña" name="clave" required>

                <input type="password" placeholder="Repetir Contraseña" name="claveConfi" required>
                
                <input type="submit" value="Registrarse" name="enviareg" >
            </form>

            <?php

				if (isset($_POST['enviareg'])) {
					include "../Controller/validar_registro.php";
				}

			?>


        </div>
        
    </div>
    <script src="js/jquery-3.1.1.min.js"></script>    
    <script src="js/main.js"></script>
</body>
</html>

