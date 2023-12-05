<?php include("../../db.php");

if ($_POST) {
    $nom_usuario = (isset($_POST["nom_usuario"]) ? $_POST["nom_usuario"] : "");
    $contraseña = isset($_POST["contra"]) ? $_POST["contra"] : "";
    $rol = (isset($_POST["rol"]) ? $_POST["rol"] : "");

    $contraseña_hasheada = password_hash($contraseña, PASSWORD_DEFAULT);
    
    $sentencia = $conexion->prepare("INSERT INTO `usuario` (`id_usuario`, `nom_usuario`, `contra`, `rol`) 
    VALUES (NULL, :nom_usuario, :contra, :rol);");

    $sentencia->bindParam(":nom_usuario", $nom_usuario);
    $sentencia->bindParam(":contra", $contraseña_hasheada);
    $sentencia->bindParam(":rol", $rol);

    $sentencia->execute();
    $mensaje = "Agregado! se agregó el registro ";
    header("location:index.php?mensaje=" . $mensaje);
}

?>
<?php include("../../templates/header.php");?>
<div class="card">
    <div class="card-header">
        <h5 class="h5">Datos Del Usuario</h5>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <div class="mb-3">
                <label for="nom_usuario" class="form-label">Nombre Usuario</label>
                <input type="text" class="form-control" name="nom_usuario" id="nom_usuario">
            </div>
            <div class="mb-3">
                <label for="contra" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="contra" id="contra">
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Roles</label>
                <select class="form-select" name="rol" id="rol">
                    <option value="administrador">Administrador</option>
                    <option value="superadministrador">Superadministrador</option>
                </select>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-success">Agregar Registro</button>
                <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<?php include("../../templates/footer.php");?>