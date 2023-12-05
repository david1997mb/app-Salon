<?php include("../../db.php");
if (isset($_GET['id'])) {
    $id = (isset($_GET['id'])) ? $_GET['id'] : "";
    $sentencia = $conexion->prepare("DELETE FROM `cliente` WHERE `cliente`.`id_cliente` = :id");
    $sentencia->bindParam(":id", $id);
    if ($sentencia->execute()) {
        $mensaje = "Eliminado! Se eliminó el registro ".$id;
        header("location:index.php?mensaje=".$mensaje);
    } else {
        $mensaje = "Error al intentar eliminar el registro.";
        // También podrías imprimir detalles del error con $sentencia->errorInfo()
    }
}
$consulta = $conexion->prepare("SELECT *,
(SELECT `usuario`.`nom_usuario` FROM `usuario` WHERE `usuario`.`id_usuario`= `cliente`.`id_usuario` LIMIT 1)as usuario FROM `cliente`");
$consulta->execute();
$lista_cliente = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include("../../templates/header.php"); ?>
<h4 class="h2">Lista Clientes</h4>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar registro</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-borderless table-dark align-middle" id="tabla_id">
                <thead class="table-light">
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Nombre Completo</th>
                        <th class="text-center">Telefono</th>
                        <th class="text-center">Correo</th>
                        <th class="text-center">Direccion</th>
                        <th class="text-center">Administrador</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach ($lista_cliente as $registro) { ?>
                        <tr class="table-primary text-center">
                            <td scope="row"><?php echo $registro['id_cliente']; ?></td>
                            <td><?php echo $registro['nombres']. " " .$registro['apePat'] . " " . $registro['apeMat']; ?></td>
                            <td><?php echo $registro['tel']; ?></td>
                            <td><?php echo $registro['correo']; ?></td>
                            <td><?php echo $registro['direc']; ?></td>
                            <td><?php echo $registro['usuario']; ?></td>
                            <td>
                                <a class="btn btn-info" href="editar.php?Id_cliente=<?php echo $registro['id_cliente']; ?>" role="button">Editar</a>
                                <a class="btn btn-danger" href="javascript:borrar(<?php echo $registro['id_cliente'];?>);" role="button">Eliminar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- <div class="card-footer">
        <a name="" id="" class="btn btn-primary" href="../informes/crear.php" role="button">Agregar Contrato</a>
    </div> -->
</div>
<?php include("../../templates/footer.php"); ?>