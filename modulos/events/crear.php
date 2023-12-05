<?php include ("../../db.php");
    //CLIENTE
    $sentencia = $conexion->prepare("SELECT `usuario`.`id_usuario`, `usuario`.`nom_usuario`
    FROM `usuario`;");
    $sentencia->execute();
    $lista_usuario=$sentencia->fetchAll(PDO::FETCH_ASSOC) ;    
    //CLIENTE
    $sentencia = $conexion->prepare("SELECT `cliente`.`id_cliente`, `cliente`.`nombres`
    FROM `cliente`;");
    $sentencia->execute();
    $lista_cliente=$sentencia->fetchAll(PDO::FETCH_ASSOC) ;
    //SERVICIO
    $sentencia = $conexion->prepare("SELECT `servicios`.`id_servicio`, `servicios`.`detalle`
    FROM `servicios`;");
    $sentencia->execute();
    $lista_servicio=$sentencia->fetchAll(PDO::FETCH_ASSOC) ;
    //AREA
    $sentencia = $conexion->prepare("SELECT `areas`.`id_area`, `areas`.`descripcion`
    FROM `areas`;");
    $sentencia->execute();
    $lista_areas=$sentencia->fetchAll(PDO::FETCH_ASSOC) ;
    
    if ($_POST) {
        $cuota = isset($_POST["cuota"]) ? $_POST["cuota"] : "";
        $fecha = isset($_POST["fecha"]) ? $_POST["fecha"] : "";
        $metodo = isset($_POST["metodo"]) ? $_POST["metodo"] : "";
    
        $sentencia = $conexion->prepare("INSERT INTO `pagos` (`id_pago`, `cuota`, `fecha`, `metodo`)
        VALUES (NULL, :cuota, :fecha, :metodo);");
        $sentencia->bindParam(":cuota", $cuota);
        $sentencia->bindParam(":fecha", $fecha);
        $sentencia->bindParam(":metodo", $metodo);
        
        if ($sentencia->execute()) {
            $id_pago = $conexion->lastInsertId();
    
            $fechareserva = isset($_POST["fechareserva"]) ? $_POST["fechareserva"] : "";
            $tipo = isset($_POST["tipoevento"]) ? $_POST["tipoevento"] : "";
            $fechaevento = isset($_POST["fechaevento"]) ? $_POST["fechaevento"] : "";
            $invitados = isset($_POST["invitados"]) ? $_POST["invitados"] : "";
            $inicio = isset($_POST["inicio"]) ? $_POST["inicio"] : "";
            $final = isset($_POST["final"]) ? $_POST["final"] : "";
            $costototal = isset($_POST["costototal"]) ? $_POST["costototal"] : "";
            $id_cliente = isset($_POST["id_cliente"]) ? $_POST["id_cliente"] : "";
            $id_usuario = isset($_POST["id_usuario"]) ? $_POST["id_usuario"] : "";
    
            if (isset($_POST['servicios']) && is_array($_POST['servicios'])) {
                $serviciosSeleccionados = $_POST['servicios'];
            }
            if (isset($_POST['areas']) && is_array($_POST['areas'])) {
                $areaSeleccionados = $_POST['areas'];
            }
    
            $sentencia = $conexion->prepare("INSERT INTO `reserva`(`id_reserva`,`fechareserva`,`tipoevento`,`fechaevento`,`invitados`,`inicio`,`final`,`costototal`,`id_cliente`,`id_usuario`,`id_pago`)
            VALUES(NULL,:fechareserva,:tipoevento,:fechaevento,:invitados,:inicio,:final,:costototal,:id_cliente,:id_usuario,:id_pago);");
            $sentencia->bindParam(":fechareserva", $fechareserva);
            $sentencia->bindParam(":tipoevento", $tipo);
            $sentencia->bindParam(":fechaevento", $fechaevento);
            $sentencia->bindParam(":invitados", $invitados);
            $sentencia->bindParam(":inicio", $inicio);
            $sentencia->bindParam(":final", $final);
            $sentencia->bindParam(":costototal", $costototal);
            $sentencia->bindParam(":id_cliente", $id_cliente);
            $sentencia->bindParam(":id_usuario", $id_usuario);
            $sentencia->bindParam(":id_pago", $id_pago);
            $sentencia->execute();
    
            $id_reserva = $conexion->lastInsertId();
            foreach ($serviciosSeleccionados as $id_servicios) {
                $sentencia = $conexion->prepare("INSERT INTO `servicios_reserva` (`id`, `id_servicio`, `id_reserva`)
                VALUES (NULL, :id_servicios, :id_reserva);");
                $sentencia->bindParam(":id_servicios", $id_servicios);
                $sentencia->bindParam(":id_reserva", $id_reserva);
                $sentencia->execute();
            }
            foreach ($areaSeleccionados as $id_areas) {
                $sentencia = $conexion->prepare("INSERT INTO `areas_reserva` (`id`, `id_area`, `id_reserva`)
                VALUES (NULL, :id_areas, :id_reserva);");
                $sentencia->bindParam(":id_areas", $id_areas);
                $sentencia->bindParam(":id_reserva", $id_reserva);
                $sentencia->execute();
            }
            $mensaje="Agregado! se agrego el registro ";
            header("location:index.php?mensaje=".$mensaje);
        }
    }    
?>
<?php include ("../../templates/header.php");?>
<div class="card">
    <div class="card-header">
        <h5 class="h5">Datos De La Reserva</h5>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <div class="mb-3">
                <label for="id_usuario" class="form-label">Usuario</label>
                <select class="form-select form-select-lg" name="id_usuario" id="id_usuario">
                    <option selected>Seleccione Al Usuario</option>
                    <?php foreach ($lista_usuario as $registro ) {?>
                        <option value="<?php echo $registro['id_usuario'];?>"><?php echo $registro['nom_usuario']; ?></option>
                    <?php }         ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_cliente" class="form-label">Cliente</label>
                <select class="form-select form-select-lg" name="id_cliente" id="id_cliente">
                    <option selected>Seleccione Al Cliente</option>
                    <?php foreach ($lista_cliente as $registro ) {?>
                        <option value="<?php echo $registro['id_cliente'];?>"><?php echo $registro['nombres']; ?></option>
                    <?php }         ?>
                </select>
            </div>
            <div class="mb-3">
              <label for="cuota" class="form-label">Cuota a Pagar</label>
              <input type="number"
                class="form-control" name="cuota" id="cuota" placeholder="Cuota Que Pagara">
            </div>
            <div class="mb-3">
              <label for="fecha" class="form-label">Fecha De Pago</label>
              <input type="date"
                class="form-control" name="fecha" id="fecha" placeholder="Fecha De Pago"> 
            </div>
            <div class="mb-3">
                <label for="metodo" class="form-label">Metodo De Pago</label>
                <select class="form-select form-select-lg" name="metodo" id="metodo">
                    <option selected>Seleccione El Metodo De Pago</option>
                    <option value="Transferencia">Transferencia</option>
                    <option value="Efectivo">Efectivo</option>
                    <option value="Deposito">Deposito</option>
                </select>
            </div>            
            <div class="form-check form-check-inline">
                <label  class="form-label text-center">SELECCIONE LOS SERVICIOS QUE REQUIERA</label><br>
                <?php foreach ($lista_servicio as $registro) { ?>
                    <input class="form-check-input" type="checkbox" id="servicio_<?php echo $registro['id_servicio']; ?>" name="servicios[]" value="<?php echo $registro['id_servicio'];?>">
                    <label class="form-check-label" for="servicio_<?php echo $registro['id_servicio'];?>"><?php echo $registro['detalle']; ?></label><br>
                <?php } ?>  
            </div>
            <div class="form-check form-check-inline">
                <label  class="form-label text-center">SELECCIONE LAS AREAS QUE REQUIERA</label><br>
                <?php foreach ($lista_areas as $registro) { ?>
                    <input class="form-check-input" type="checkbox" id="area_<?php echo $registro['id_area']; ?>" name="areas[]" value="<?php echo $registro['id_area'];?>">
                    <label class="form-check-label" for="area_<?php echo $registro['id_area'];?>"><?php echo $registro['descripcion']; ?></label><br>
                <?php } ?>  
            </div>
            <div class="mb-3">
              <label for="fechareserva" class="form-label">Fecha De La Reserva</label>
              <input type="date"
                class="form-control" name="fechareserva" id="fechareserva" aria-describedby="helpId" placeholder="Fecha de la Reserva">
            </div>
            <div class="mb-3">
                <label for="tipoevento" class="form-label">Tipo Evento </label>
                <select class="form-select form-select-lg" name="tipoevento" id="tipoevento">
                    <option selected>Seleccione el Tipo del Evento</option>
                    <option value="Matrimonio">Matrimonio</option>
                    <option value="Cumpleaños">Cumpleaño</option>
                    <option value="15 Años">15 Años</option>
                    <option value="Reuniones Familiares">Reuniones Familiares</option>
                    <option value="Promociones">Promocion</option>
                    <option value="Graduaciones">Graduacion</option>
                    <option value="Bautizos">Bautizo</option>
                </select>
            </div>
            <div class="mb-3">
              <label for="fechaevento" class="form-label">Fecha Del Evento</label>
              <input type="date"
                class="form-control" name="fechaevento" id="fechaevento" aria-describedby="helpId" placeholder="Fecha Del Evento">
            </div>
            <div class="mb-3">
              <label for="invitados" class="form-label">Numero Invitados</label>
              <input type="number"
                class="form-control" name="invitados" id="invitados"  placeholder="Numero De Invitados">
            </div>  
            <div class="mb-3">
              <label for="inicio" class="form-label">Hora Inicio</label>
              <input type="time"
                class="form-control" name="inicio" id="inicio"  placeholder="Hora Inicio Del Evento">
            </div>
            <div class="mb-3">
              <label for="final" class="form-label">Hora Final</label>
              <input type="time"
                class="form-control" name="final" id="final"  placeholder="Hora Final Del Evento">
            </div>
            <div class="mb-3">
              <label for="costototal" class="form-label">Costo Total Del Alquiler</label>
              <input type="number"
                class="form-control" name="costototal" id="costototal"  placeholder="Costo Total Del Alquiler"> 
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Agregar Registro</button>
                <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<?php include("../../templates/footer.php");?>