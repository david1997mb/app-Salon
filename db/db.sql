create table usuario(
    id_usuario int AUTO_INCREMENT primary key,
    nom_usuario varchar (50) not null,
    contra varchar(50) not null,
    rol varchar(50)  
);
CREATE TABLE cliente (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nombres VARCHAR(50) NOT NULL,
    apePat VARCHAR(50),
    apeMat VARCHAR(50),
    tel VARCHAR(20),
    correo VARCHAR(50),
    direc VARCHAR(50),
    id_usuario INT,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario) ON DELETE CASCADE
);
CREATE TABLE pagos (
    id_pago INT AUTO_INCREMENT PRIMARY KEY,
    cuota INT,
    fecha DATE,
    monto_pagado INT,
    saldo_pendiente INT,
    id_reserva INT,
    metodo VARCHAR(50)
);
create table areas(
    id_area int AUTO_INCREMENT primary key,
    descripcion varchar(20)
);
CREATE TABLE reserva (
    id_reserva INT AUTO_INCREMENT PRIMARY KEY,
    fechareserva DATE,
    tipoevento VARCHAR(50),
    fechaevento DATE,
    invitados INT,
    inicio TIME,
    final TIME,
    costototal INT,
    id_cliente INT,
    id_pago INT,
    FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente) ON DELETE CASCADE,
    FOREIGN KEY (id_pago) REFERENCES pagos(id_pago) ON DELETE CASCADE
);
CREATE TABLE areas_reserva (
    id INT AUTO_INCREMENT,
    id_area INT,
    id_reserva INT,
    PRIMARY KEY (id),
    FOREIGN KEY (id_area) REFERENCES areas(id_area) ON DELETE CASCADE,
    FOREIGN KEY (id_reserva) REFERENCES reserva(id_reserva) ON DELETE CASCADE
);
create table servicios(
    id_servicio int AUTO_INCREMENT primary key,
    detalle varchar(20),
    costo int
);
CREATE TABLE servicios_reserva (
    id INT AUTO_INCREMENT,
    id_servicio INT,
    id_reserva INT,
    PRIMARY KEY (id),
    FOREIGN KEY (id_servicio) REFERENCES servicios(id_servicio) ON DELETE CASCADE,
    FOREIGN KEY (id_reserva) REFERENCES reserva(id_reserva) ON DELETE CASCADE
);-- Trigger en la tabla pagos
DELIMITER //
CREATE TRIGGER calcular_saldo_pendiente
AFTER INSERT ON pagos
FOR EACH ROW
BEGIN
    DECLARE total_pagado INT;

    -- Calcula el total pagado hasta ahora para la reserva
    SELECT COALESCE(SUM(monto_pagado), 0) INTO total_pagado
    FROM pagos
    WHERE id_reserva = NEW.id_reserva;

    -- Actualiza el saldo pendiente en la tabla reserva
    UPDATE reserva
    SET saldo_pendiente = reserva.costototal - total_pagado
    WHERE id_reserva = NEW.id_reserva;
END;
//
DELIMITER ;
ALTER TABLE pagos ADD FOREIGN KEY (id_reserva) REFERENCES reserva(id_reserva) ON DELETE CASCADE;
INSERT INTO `servicios` (`id_servicio`, `detalle`, `costo`) VALUES (NULL, 'Garzoneria', '1500'), (NULL, 'Seguridad', '1000'), (NULL, 'Decorado', '1500'), (NULL, 'Conjunto Musical', '5000');
INSERT INTO `areas` (`id_area`, `descripcion`) VALUES (NULL, 'Pista de Baile'), (NULL, 'Comedores De Planta Baja'), (NULL, 'Comedores De Mezanine'), (NULL, 'Cocina'), (NULL, 'Baños'), (NULL, 'Deposito Subterráneo'), (NULL, 'Cuarto de Tocador');
CREATE TABLE bitacora (
    id_bitacora INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    accion VARCHAR(255),
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    detalles TEXT
);
