<?php include("../../db.php");
     if (isset($_GET['id_usuario'])) {
        $id=(isset($_GET['id_usuario']))?$_GET['id_usuario']:"";
        $sentencia = $conexion->prepare("SELECT * FROM `usuario` WHERE id_usuario=:id;");
        $sentencia->bindParam(":id",$id);
        $sentencia->execute();
        $registro=$sentencia->fetch(PDO::FETCH_LAZY);
        $nom_usuario=$registro["nom_usuario"];
        $contra=$registro["contra"];
        $rol=$registro["rol"];  
    }
    if ($_POST) {
        print_r($_POST);
        $nom_usuario=(isset($_POST["nom_usuario"])?$_POST["nom_usuario"]:"");
        $contraseña=md5((isset($_POST["contra"])?$_POST["contra"]:""));
        $rol=(isset($_POST["rol"])?$_POST["rol"]:"");
        $contraseña_hasheada = password_hash($contraseña, PASSWORD_DEFAULT);
        //
        $sentencia = $conexion->prepare("UPDATE `usuario` SET `nom_usuario` = :nom_usuario, `contra` = :contra, `rol` = :rol WHERE `usuario`.`id_usuario` = :id;");        
        $sentencia->bindParam(":id",$id);
        $sentencia->bindParam(":nom_usuario",$nom_usuario);
        $sentencia->bindParam(":contra",$contraseña_hasheada);
        $sentencia->bindParam(":rol",$rol);
        $sentencia->execute();
        $mensaje="Actualizado! se actualizo el registro ".$id;
        header("location:index.php?mensaje=".$mensaje);
    }
?>
<?php include("../../templates/header.php");?>
<div class="card">
    <div class="card-header">
        <h5 class="h5">Datos Del Cliente</h5>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <div class="mb-3">
                <label for="id_usuario" class="form-label">ID</label>
                <input type="text" class="form-control" name="id_usuario" id="id_usuario" value="<?php echo$id; ?>">
            </div>
            <div class="mb-3">
                <label for="nom_usuario" class="form-label">Nombre Usuario</label>
                <input type="text" class="form-control" name="nom_usuario" id="nom_usuario"
                    value="<?php echo$nom_usuario; ?>">
            </div>
            <div class="mb-3">
                <label for="contra" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="contra" id="contra" value="<?php echo$contra; ?>">
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Roles</label>
                <select class="form-select" name="rol" id="rol">
                    <option value="administrador" <?php echo ($rol == 'administrador') ? 'selected' : ''; ?>>
                        Administrador</option>
                    <option value="superadministrador" <?php echo ($rol == 'superadministrador') ? 'selected' : ''; ?>>
                        Superadministrador</option>
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