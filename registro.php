<?php include("./db.php");

    if ($_POST) {
        print_r($_POST);
        $nom_usuario=(isset($_POST["nom_usuario"])?$_POST["nom_usuario"]:"");
        $contra=(isset($_POST["contra"])?$_POST["contra"]:"");
        $correo=(isset($_POST["correo"])?$_POST["correo"]:"");
        //
        $sentencia = $conexion->prepare("INSERT INTO `usuario` (`id_usuario`, `nom_usuario`, `contra`, `correo`) 
        VALUES (NULL, :nom_usuario, :contra, :correo);");        
        $sentencia->bindParam(":nom_usuario",$nom_usuario);
        $sentencia->bindParam(":contra",$contra);
        $sentencia->bindParam(":correo",$correo);
        $sentencia->execute();
        $mensaje="Agregado! se agrego el registro ";
        header("location:login.php");
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
        <form action="" method="post" class="form">
            <h1 class="title">Registro</h1>
            <div class="inp">
                <input type="text" class="input" name="nom_usuario" id="nom_usuario" placeholder="Ingrese Su Usuario">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="inp">
                <input type="password" class="input" name="contra" id="contra" placeholder="Ingrese Su Contraseña">
                <i class="fa-solid fa-lock"></i>
            </div>
            <div class="inp">
                <input type="email" class="input" name="correo" id="correo" placeholder="Ingrese Su Correo">
                <i class="fa-solid fa-envelope"></i>
            </div>
            <button type="submit" class="submit">Registrarse al Sistema</button>
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