<?php include("../../db.php");
    if (isset($_GET['id'])) {
        print_r($_POST);
        $id=(isset($_GET['id']))?$_GET['id']:"";
        $sentencia = $conexion->prepare("DELETE FROM `usuario` WHERE id_usuario=:id;");
        $sentencia->bindParam(":id",$id);
        $sentencia->execute();
        $mensaje="Eliminado! se elimino el registro ".$id;
        header("location:index.php?mensaje=".$mensaje);
    }
    $consulta= $conexion->prepare("SELECT * FROM `usuario`");
    $consulta->execute();
    $lista_usuario=$consulta->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include("../../templates/header.php");?>
<h4 class="h4">Lista Usuarios</h4>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar registro</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped
            table-hover	
            table-borderless
            table-dark
            align-middle" id="tabla_id">
                <thead class="table-light">
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Nombre Usuario</th>
                        <th class="text-center">Password</th>
                        <th class="text-center">Cargo</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider text-center"">
                    <?php foreach ($lista_usuario as $registro) {?>
                    <tr class="table-primary">
                        <td scope="row"><?php echo $registro['id_usuario'];?></td>
                        <td><?php echo $registro['nom_usuario'];?></td>
                        <td>********</td>
                        <td><?php echo $registro['rol'];?></td>
                        <td>
                            <a class="btn btn-info" href="editar.php?id_usuario=<?php echo $registro['id_usuario'];?>" role="button">Editar</a>
                            <a class="btn btn-danger" href="javascript:borrar(<?php echo $registro['id_usuario']; ?>);" role="button">Eliminar</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot>

                </tfoot>
            </table>
        </div>

    </div>
</div>

<?php include("../../templates/footer.php");?>