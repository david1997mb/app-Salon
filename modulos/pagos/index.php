
<?php
include("../../db.php");
if (isset($_GET['Id_pago'])) {
    $id=(isset($_GET['id_pago']))?$_GET['id_pago']:"";
    $sentencia = $conexion->prepare("DELETE FROM `pagos` WHERE id_pago =:id;");
    $sentencia->bindParam(":id",$id);
    $sentencia->execute();
    $mensaje="Eliminado! se elimino el registro ".$id;
    header("location:index.php?mensaje=".$mensaje); 
}
$consulta= $conexion->prepare("SELECT `cliente`.`id_cliente`, `reserva`.`id_reserva`, `pagos`.*
FROM `cliente` 
	LEFT JOIN `reserva` ON `reserva`.`id_cliente` = `cliente`.`id_cliente` 
	LEFT JOIN `pagos` ON `reserva`.`id_pago` = `pagos`.`id_pago`;");
$consulta->execute();
$lista_pago=$consulta->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include("../../templates/header.php");?>
<div class="card">
    <div class="card-header">
    <h4 class="h4">Lista de Clientes que Realizaron Pago</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-borderless table-darkp align-middle" id="tabla_id">
                <thead class="table-light text-center">
                    <tr>
                        <th>ID Cliente</th>
                        <th>ID Reserva</th>
                        <th>ID Pago</th>
                        <th>Cuota Pago</th>
                        <th>Fecha Pago</th>
                        <th>Metodo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider text-center">
                    <?php foreach ($lista_pago as $cliente) { ?>
                        <tr class="table-primary">
                            <td><?php echo $cliente['id_cliente']; ?></td>
                            <td><?php echo $cliente['id_reserva']; ?></td>
                            <td><?php echo $cliente['id_pago']; ?></td>
                            <td><?php echo $cliente['cuota']; ?></td>
                            <td><?php echo $cliente['fecha']; ?></td>
                            <td><?php echo $cliente['metodo'] ?></td>
                            <td>
                            <a class="btn btn-info" href="editar.php?id_pago=<?php echo $cliente['id_pago'];?>" role="button">Editar</a>
                            <a class="btn btn-danger" href="javascript:borrar(<?php echo $cliente['id_pago']; ?>);" role="button">Borrar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include("../../templates/footer.php");?>