<?php include("../../db.php");
    $sentencia = $conexion->prepare("SELECT `usuario`.`id_usuario`, `usuario`.`nom_usuario`
    FROM `usuario`;");
    $sentencia->execute();
    $lista_usuario=$sentencia->fetchAll(PDO::FETCH_ASSOC) ; 
    if ($_POST) {
        $nombre1=(isset($_POST["nombre1"])?$_POST["nombre1"]:"");
        $nombre2=(isset($_POST["nombre2"])?$_POST["nombre2"]:"");
        $nombres="$nombre1 $nombre2";
        $apellido1=(isset($_POST["apellido1"])?$_POST["apellido1"]:"");
        $apellido2=(isset($_POST["apellido2"])?$_POST["apellido2"]:"");
        $telefono=(isset($_POST["telefono"])?$_POST["telefono"]:"");
        $correo=(isset($_POST["correo"])?$_POST["correo"]:"");
        $direccion=(isset($_POST["direccion"])?$_POST["direccion"]:"");
        $usuario=(isset($_POST["id_usuario"])?$_POST["id_usuario"]:"");
        //
        $sentencia = $conexion->prepare("INSERT INTO `cliente` (`id_cliente`, `nombres`, `apePat`, `apeMat`, `tel`, `correo`, `direc`,`id_usuario`) 
        VALUES (NULL, :nombres, :apellido1, :apellido2, :telefono, :correo, :direccion, :id_usuario);");        
        $sentencia->bindParam(":nombres",$nombres);
        $sentencia->bindParam(":apellido1",$apellido1);
        $sentencia->bindParam(":apellido2",$apellido2);
        $sentencia->bindParam(":telefono",$telefono);
        $sentencia->bindParam(":correo",$correo);
        $sentencia->bindParam(":direccion",$direccion);
        $sentencia->bindParam(":id_usuario",$usuario);
        $sentencia->execute();
        $mensaje="Agregado! se agrego el registro ";
        header("location:index.php?mensaje=".$mensaje);
    }
?>
<?php include("../../templates/header.php");?>
<script>
// Función para mostrar u ocultar el input de texto según la selección del radio
function mostrarOcultarInput() {
    var radioSi = document.getElementById("si");
    var inputTexto = document.getElementById("inputTexto");

    if (radioSi.checked) {
        inputTexto.style.display = "block"; // Mostrar el input de texto
    } else {
        inputTexto.style.display = "none"; // Ocultar el input de texto
    }
}
</script>
<div class="card">
    <div class="card-header">
        <h5 class="h4 text-center">Datos Del Cliente</h5>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <div class="mb-3">
                <label for="" class="form-label">Primer Nombre</label>
                <input type="text" class="form-control" name="nombre1" id="" aria-describedby="helpId"
                    placeholder="Primer Nombre">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Tiene Segundo Nombre</label>
                <label for="si">Sí</label>
                <input type="radio" name="opcion" id="si" value="si" onclick="mostrarOcultarInput()">
                <label for="no">No</label>
                <input type="radio" name="opcion" id="no" value="no" onclick="mostrarOcultarInput()">
                <div id="inputTexto" style="display: none;">
                    <label for="" class="form-label">Segundo Nombre</label>
                    <input type="text" class="form-control" name="nombre2" id="" aria-describedby="helpId"
                        placeholder="Segundo Nombre">
                </div>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Primer Apellido</label>
                <input type="text" class="form-control" name="apellido1" id="" aria-describedby="helpId"
                    placeholder="Primer Apellido">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Segundo Apellido</label>
                <input type="text" class="form-control" name="apellido2" id="" aria-describedby="helpId"
                    placeholder="Segundo Apellido">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Telefono Celular</label>
                <input type="text" class="form-control" name="telefono" id="" aria-describedby="helpId"
                    placeholder="Telefono Celular">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Correo Electronico</label>
                <input type="email" class="form-control" name="correo" id="" aria-describedby="helpId"
                    placeholder="Correo Electronico">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Direccion Vivienda</label>
                <input type="text" class="form-control" name="direccion" id="" aria-describedby="helpId"
                    placeholder="Direccion Vivienda">
            </div>
            <div class="mb-3">
                <label for="id_usuario" class="form-label">Usuario</label>
                <select class="form-select form-select-lg" name="id_usuario" id="id_usuario" required>
                    <option selected>Seleccione Al Usuario</option>
                    <?php foreach ($lista_usuario as $registro ) {?>
                    <option value="<?php echo $registro['id_usuario'];?>"><?php echo $registro['nom_usuario']; ?>
                    </option>
                    <?php } ?>
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