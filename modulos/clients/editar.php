<?php include("../../db.php");
if (isset($_GET['Id_cliente'])) {
    $id=(isset($_GET['Id_cliente']))?$_GET['Id_cliente']:"";
    $sentencia = $conexion->prepare("SELECT * FROM `cliente` WHERE id_cliente=:id;");
    $sentencia->bindParam(":id",$id);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
        $nombre1=$registro["nombres"];
        $apellido1=$registro["apePat"];
        $apellido2=$registro["apeMat"];
        $telefono=$registro["tel"];;
        $correo=$registro["correo"];;
        $direccion=$registro["direc"];;  
}
if ($_POST) {
    $id=(isset($_POST['Id_cliente']))?$_POST['Id_cliente']:"";
    $nombres=(isset($_POST["nombres"])?$_POST["nombres"]:"");
    $apellido1=(isset($_POST["apellido1"])?$_POST["apellido1"]:"");
    $apellido2=(isset($_POST["apellido2"])?$_POST["apellido2"]:"");
    $telefono=(isset($_POST["telefono"])?$_POST["telefono"]:"");
    $correo=(isset($_POST["correo"])?$_POST["correo"]:"");
    $direccion=(isset($_POST["direccion"])?$_POST["direccion"]:"");
    //
    $sentencia = $conexion->prepare("UPDATE `cliente` SET nombres=:nombres, apePat=:apellido1, apeMat=:apellido2, tel=:telefono, correo=:correo, direc=:direccion WHERE id_cliente=:id;");       
    $sentencia->bindParam(":id",$id);
    $sentencia->bindParam(":nombres",$nombres);
    $sentencia->bindParam(":apellido1",$apellido1);
    $sentencia->bindParam(":apellido2",$apellido2);
    $sentencia->bindParam(":telefono",$telefono);
    $sentencia->bindParam(":correo",$correo);
    $sentencia->bindParam(":direccion",$direccion);
    $sentencia->execute();
    $mensaje="Actualizado! se actualizo el registro ".$id;
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
        <h5 class="h5">Datos Del Cliente</h5>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <div class="mb-3">
              <label for="Id_cliente" class="form-label">ID</label>
              <input type="text" value="<?php echo $id;?>"
                class="form-control" readonly name="Id_cliente" id="Id_cliente" aria-describedby="helpId" placeholder="ID">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Primer Nombre</label>
                <input type="text" class="form-control" name="nombres" id="" value="<?php echo $nombre1;?>"
                    placeholder="Nombres">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Primer Apellido</label>
                <input type="text" class="form-control" name="apellido1" id="" value="<?php echo $apellido1;?>"
                    placeholder="Primer Apellido">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Segundo Apellido</label>
                <input type="text" class="form-control" name="apellido2" id="" value="<?php echo $apellido2;?>"
                    placeholder="Segundo Apellido">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Telefono Celular</label>
                <input type="text" class="form-control" name="telefono" id="" value="<?php echo $telefono;?>"
                    placeholder="Telefono Celular">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Correo Electronico</label>
                <input type="text" class="form-control" name="correo" id="" value="<?php echo $correo;?>"
                    placeholder="Correo Electronico">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Direccion Vivienda</label>
                <input type="text" class="form-control" name="direccion" id="" value="<?php echo $direccion;?>"
                    placeholder="Direccion Vivienda">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Actualizar Registro</button>
                <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
            </div>
        </form>
    </div>
</div>
<?php include("../../templates/footer.php");?>