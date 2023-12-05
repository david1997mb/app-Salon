<?php include ("../../db.php");
    if (isset($_GET['Id_reserva'])) {
        $id=(isset($_GET['Id_reserva']))?$_GET['Id_reserva']:"";
        $sentencia = $conexion->prepare("SELECT * FROM `reserva` WHERE id_reserva=:id;");
        $sentencia->bindParam(":id",$id);
        $sentencia->execute();
        $registro=$sentencia->fetch(PDO::FETCH_LAZY);
        $fechareserva=$registro["fechareserva"];
        $tipoevento=$registro["tipoevento"];
        $fechaevento=$registro["fechaevento"];
        $invitados=$registro["invitados"];
        $inicio=$registro["inicio"];
        $final=$registro["final"];
        $costototal=$registro["costototal"];
        $id_cliente =$registro["id_cliente"];
        $id_usuario =$registro["id_usuario"];
        $id_pago  =$registro["id_pago"];   
    }
    //USUARIO
    $sentencia = $conexion->prepare("SELECT `usuario`.`id_usuario`, `usuario`.`nom_usuario`
    FROM `usuario`;");
    $sentencia->execute();
    $lista_usuario=$sentencia->fetchAll(PDO::FETCH_ASSOC) ;    
    //CLIENTE
    $sentencia = $conexion->prepare("SELECT `cliente`.`id_cliente`, `cliente`.`nombres`
    FROM `cliente`;");
    $sentencia->execute();
    $lista_cliente=$sentencia->fetchAll(PDO::FETCH_ASSOC) ;
    //PAGOS
    $sentencia = $conexion->prepare("SELECT `pagos`.`id_pago`, `pagos`.`metodo`
    FROM `pagos`;");
    $sentencia->execute();
    $lista_pagos=$sentencia->fetchAll(PDO::FETCH_ASSOC) ;
    if ($_POST) {
        $fechareserva = isset($_POST["fechareserva"]) ? $_POST["fechareserva"] : "";
        $tipoevento = isset($_POST["tipoevento"]) ? $_POST["tipoevento"] : "";
        $fechaevento = isset($_POST["fechaevento"]) ? $_POST["fechaevento"] : "";
        $invitados = isset($_POST["invitados"]) ? $_POST["invitados"] : "";
        $inicio = isset($_POST["inicio"]) ? $_POST["inicio"] : "";
        $final = isset($_POST["final"]) ? $_POST["final"] : "";
        $costototal = isset($_POST["costototal"]) ? $_POST["costototal"] : "";
        $id_cliente  = isset($_POST["id_cliente"]) ? $_POST["id_cliente"] : "";
        $id_usuario  = isset($_POST["id_usuario"]) ? $_POST["id_usuario"] : "";
        $id_pago   = isset($_POST["id_pago"]) ? $_POST["id_pago"] : "";
        $sentencia = $conexion->prepare("UPDATE `reserva` SET `fechareserva` = :fechareserva, `tipoevento` = :tipoevento, `fechaevento` = :fechaevento, 
        `invitados` = :invitados, `inicio` = :inicio, `final` = :final, `costototal` = :costototal,`id_cliente` = :id_cliente, `id_usuario` = :id_usuario, `id_pago` = :id_pago
         WHERE `reserva`.`id_reserva` = :id;");       
        $sentencia->bindParam(":id",$id);
        $sentencia->bindParam(":fechareserva",$fechareserva);
        $sentencia->bindParam(":tipoevento",$tipoevento);
        $sentencia->bindParam(":fechaevento",$fechaevento);
        $sentencia->bindParam(":invitados",$invitados);
        $sentencia->bindParam(":inicio",$inicio);
        $sentencia->bindParam(":final",$final);
        $sentencia->bindParam(":costototal",$costototal);
        $sentencia->bindParam(":id_cliente",$id_cliente);
        $sentencia->bindParam(":id_usuario",$id_usuario);
        $sentencia->bindParam(":id_pago",$id_pago);
        $sentencia->execute();
        $mensaje="Actualizado! se actualizo el registro ".$id;
        header("location:index.php?mensaje=".$mensaje);
    }
    print_r($_POST)    
?>
<?php include ("../../templates/header.php");?>
<div class="card">
    <div class="card-header">
        <h5 class="h5">Datos De La Reserva</h5>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <div class="mb-3">
              <label for="cuota" class="form-label">ID</label>
              <input type="number"class="form-control" name="" id="" placeholder="" value="<?php echo $id;?>" readonly>
            </div>
            <div class="mb-3">
                <label for="id_usuario" class="form-label">Usuario</label>
                <select class="form-select form-select-lg" name="id_usuario" id="id_usuario">
                    <?php foreach ($lista_usuario as $registro ) {?>
                        <option value="<?php echo $registro['id_usuario'];?>"><?php echo $registro['nom_usuario']; ?></option>
                    <?php }         ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_cliente" class="form-label">Cliente</label>
                <select class="form-select form-select-lg" name="id_cliente" id="id_cliente">

                    <?php foreach ($lista_cliente as $registro ) {?>
                        <option value="<?php echo $registro['id_cliente'];?>"><?php echo $registro['nombres']; ?></option>
                    <?php }         ?>
                </select>
            </div>
            <div class="mb-3">
              <label for="fechareserva" class="form-label">Fecha De La Reserva</label>
              <input type="date"
                class="form-control" name="fechareserva" id="fechareserva" value="<?php echo $fechareserva;?>">
            </div>
            <div class="mb-3">
                <label for="tipoevento" class="form-label">Tipo Evento</label>
                <select class="form-select form-select-lg" name="tipoevento" id="tipoevento">
                    <option value="Matrimonio" <?php if ($tipoevento === 'Matrimonio') echo 'selected'; ?>>Matrimonio</option>
                    <option value="Cumpleaños" <?php if ($tipoevento === 'Cumpleaños') echo 'selected'; ?>>Cumpleaños</option>
                    <option value="15 Años" <?php if ($tipoevento === '15 Años') echo 'selected'; ?>>15 Años</option>
                    <option value="Reuniones Familiares" <?php if ($tipoevento === 'Reuniones Familiares') echo 'selected'; ?>>Reuniones Familiares</option>
                    <option value="Promociones" <?php if ($tipoevento === 'Promociones') echo 'selected'; ?>>Promociones</option>
                    <option value="Graduaciones" <?php if ($tipoevento === 'Graduaciones') echo 'selected'; ?>>Graduaciones</option>
                    <option value="Bautizos" <?php if ($tipoevento === 'Bautizos') echo 'selected'; ?>>Bautizos</option>
                </select>
            </div>
            <div class="mb-3">
              <label for="fechaevento" class="form-label">Fecha Del Evento</label>
              <input type="date"
                class="form-control" name="fechaevento" id="fechaevento"  value="<?php echo$fechaevento; ?>">
            </div>
            <div class="mb-3">
              <label for="invitados" class="form-label">Numero Invitados</label>
              <input type="number"
                class="form-control" name="invitados" id="invitados" value="<?php echo$invitados; ?>">
            </div>  
            <div class="mb-3">
              <label for="inicio" class="form-label">Hora Inicio</label>
              <input type="time"
                class="form-control" name="inicio" id="inicio"  value="<?php echo$inicio; ?>">
            </div>
            <div class="mb-3">
              <label for="final" class="form-label">Hora Final</label>
              <input type="time"
                class="form-control" name="final" id="final"  value="<?php echo$final; ?>">
            </div>
            <div class="mb-3">
              <label for="costototal" class="form-label">Costo Total Del Alquiler</label>
              <input type="number"
                class="form-control" name="costototal" id="costototal"  value="<?php echo$costototal; ?>"> 
            </div>
            <div class="mb-3">
                <label for="id_pago" class="form-label">Pago</label>
                <select class="form-select form-select-lg" name="id_pago" id="id_pago">
                    <?php foreach ($lista_pagos as $registro ) {?>
                        <option value="<?php echo $registro['id_pago'];?>"><?php echo $registro['metodo']; ?></option>
                    <?php }         ?>
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