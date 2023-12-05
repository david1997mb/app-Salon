<?php include("../../db.php");
if (isset($_GET['id_pago'])) {
    $id=(isset($_GET['id_pago']))?$_GET['id_pago']:"";
    $sentencia = $conexion->prepare("SELECT * FROM `pagos` WHERE id_pago=:id;");
    $sentencia->bindParam(":id",$id);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
        $cuota=$registro["cuota"];
        $fecha=$registro["fecha"];
        $metodo=$registro["metodo"];
}
if ($_POST) {
    $id=(isset($_POST['Id_cliente']))?$_POST['Id_cliente']:"";
    $nombres=(isset($_POST["nombres"])?$_POST["nombres"]:"");
    $apellido1=(isset($_POST["apellido1"])?$_POST["apellido1"]:"");
    $apellido2=(isset($_POST["apellido2"])?$_POST["apellido2"]:"");
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
<div class="card">
    <div class="card-header">
        <h5 class="h5">Datos Del Pago</h5>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <div class="mb-3">
              <label for="id_pago" class="form-label">ID</label>
              <input type="text" value="<?php echo $id;?>"
                class="form-control" readonly name="id_pago" id="id_pago">
            </div>
            <div class="mb-3">
                <label for="cuota" class="form-label">Monto de Pago:</label>
                <input type="text" class="form-control" name="cuota" id="" value="<?php echo $cuota;?>">
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha Pago</label>
                <input type="date" class="form-control" name="fecha" id="" value="<?php echo $fecha;?>">
            </div>
            <div class="mb-3">
                <label for="metodo" class="form-label">Metodo De Pago</label>
                <select class="form-select form-select-lg" name="metodo" id="metodo">
                    <option value="Transferencia"<?php if ($metodo === 'Transferencia') echo 'selected'; ?>>Transferencia</option>
                    <option value="Efectivo"<?php if ($metodo === 'Efectivo') echo 'selected'; ?>>Efectivo</option>
                    <option value="Deposito"<?php if ($metodo === 'Deposito') echo 'selected'; ?>>Deposito</option>
                </select>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Actualizar Registro</button>
                <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
            </div>
        </form>
    </div>
</div>
<?php include("../../templates/footer.php");?>