<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
if ($_POST) {
    include("db.php");
    $usuario = $_POST['nom_usuario'];
    $contraseña = $_POST['contra'];
    // Obtener el hash de la contraseña desde la base de datos
    $sentencia = $conexion->prepare("SELECT `usuario`.`contra` FROM `usuario` WHERE `usuario`.`nom_usuario` = :nom_usuario;");
    $sentencia->bindParam(":nom_usuario", $usuario);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_ASSOC);
    echo $usuario."<br>".$contraseña."<br>";
    echo $registro['contra'];
    // Verificar la contraseña usando password_verify
    if (password_verify($contraseña,$registro['contra'])) {
        // La contraseña es correcta
        $_SESSION['nom_usuario'] = $usuario;
        $_SESSION['logeado'] = true;
        header("location:index.php");
    } else {
        // La contraseña es incorrecta
        $mensaje = "Error: El usuario o la contraseña son incorrectos";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="Css/Style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <div class="wrapper">
        <!-- <?php /*if (isset($mensaje)) { ?>
            <div class="alert alert-danger" role="alert">
                <strong><?php echo $mensaje; ?></strong>
            </div>
        <?php } */?> -->
        <form action="" method="post" class="form">
            <h1 class="title">Inicio</h1>
            <div class="inp">
                <input type="text" class="input" name="nom_usuario" id="nom_usuario" placeholder="Ingrese Su Usuario">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="inp">
                <input type="password" class="input" name="contra" id="contra" placeholder="Ingrese Su Contraseña">
                <i class="fa-solid fa-lock"></i>
            </div>
            <button type="submit" class="submit">Ingresar al Sistema</button>
            <p class="footer"> No tienes Cuenta?
                <a href="registro.php" class="link"> Por Favor, Registrate</a>
            </p>
        </form>
        <div></div>
        <div class="banner">
            <h1 class="wel_text">Bienvenido</h1>
            <p class="para">Gracias por usar el sistema</p>
        </div>
    </div>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>