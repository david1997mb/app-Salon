<?php
include("../../db.php");
if (isset($_GET['id'])) {
    $id=(isset($_GET['id']))?$_GET['id']:"";
    $sentencia = $conexion->prepare("-- Eliminar registros relacionados en la tabla areas_reserva
    DELETE FROM areas_reserva WHERE id_reserva = :id;
    
    -- Eliminar registros relacionados en la tabla servicios_reserva
    DELETE FROM servicios_reserva WHERE id_reserva = :id;
    
    -- Ahora puedes eliminar el registro en la tabla reserva
    DELETE FROM reserva WHERE id_reserva = :id;
    ");
    $sentencia->bindParam(":id",$id);
    $sentencia->execute();
    $mensaje="Eliminado! se elimino el registro ".$id;
    //header("location:index.php?mensaje=".$mensaje);
}
$consulta= $conexion->prepare("SELECT `reserva`.*, 
(SELECT `cliente`.`nombres` FROM `cliente` WHERE `cliente`.`id_cliente`= `reserva`.`id_cliente` LIMIT 1)as cliente,
(SELECT `usuario`.`nom_usuario` FROM `usuario` WHERE `usuario`.`id_usuario`= `reserva`.`id_usuario` LIMIT 1)as usuario
 FROM `reserva`;");
$consulta->execute();
$lista_reserva=$consulta->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include("../../templates/header.php"); ?>
<h4 class="h4">Lista de Clientes que Realizaron Reservas</h4>
<div class="card">
    <div class="card-header">
       <a class="btn btn-primary" href="crear.php" role="button">Agregar Registro</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-borderless table-darkp align-middle" id="tabla_id">
                <thead class="table-light text-center">
                    <tr>
                        <th>ID</th>
                        <th>Fecha Reserva</th>
                        <th>Tipo Evento</th>
                        <th>Fecha Evento</th>
                        <th>Hora Evento</th>
                        <th>Invitados</th>
                        <th>Costo</th>
                        <th>Cliente</th>
                        <th>Usuario</th>
                        <th>Pago</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider text-center">
                    <?php foreach ($lista_reserva as $cliente) { ?>
                        <tr class="table-primary">
                            <td><?php echo $cliente['id_reserva']; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($cliente['fechareserva'])); ?></td>
                            <td><?php echo $cliente['tipoevento']; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($cliente['fechaevento'])); ?></td>
                            <td><?php echo $cliente['inicio']." | ".$cliente['final'];?></td>
                            <td><?php echo $cliente['invitados']; ?></td>
                            <td><?php echo $cliente['costototal']; ?></td>
                            <td><?php echo $cliente['cliente']; ?></td>
                            <td><?php echo $cliente['usuario']; ?></td>
                            <td><?php echo $cliente['id_pago']; ?></td>
                            <td>
                            <a class="btn btn-info" href="editar.php?Id_reserva=<?php echo $cliente['id_reserva'];?>" role="button">Editar</a>
                            <a class="btn btn-danger" href="javascript:borrar(<?php echo $cliente['id_reserva']; ?>);" role="button">Borrar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include("../../templates/footer.php"); ?>
