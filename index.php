<?php include("templates/header.php"); ?>
<div id="carousel" class="carousel slide carousel-fade">
    <div class="carousel-inner text-center">
        <h1 class="display-4 fw-bold" style="color: white;">Bienvenido Al Sistema</h1>
        <!-- <p class="col-md fs-2" style="color: white;">Usuario: <?php echo $_SESSION['nom_usuario']; ?></p> -->
        <div class="carousel-item active text-center">
            <img src="Img/img1.png" class="img-fluid" alt="..." width="80%">
        </div>
        <div class="carousel-item text-center">
            <img src="Img/img.png" class="" alt="..." width="80%">
        </div>
        <div class="carousel-item text-center">
            <img src="Img/img2.png" class="" alt="..." width="80%">
        </div>
    </div>
</div>
<button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
    <span class="visually-true">Anterior</span>
</button>
<button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
    <span class="visually-true">Siguiente</span>
</button><br>
<div class="card body border-danger mb-3 text-danger">
    <h1 class="h1 text-center">Salon De Eventos Señorial</h1>
    <figure class="text-center">
        <blockquote class="blockquote">
            <p>El Señorial es un salón de eventos sociales, es un edificio de 2 niveles, posee un garaje muy amplio,
                tiene una cocina amplia en la cual caben los garzones y las encargadas de administrar los alimentos
                para los invitados, posee un amplio ambiente para los invitados a las celebraciones la cual tiene una capacidad
                de 500 personas y su pista de baile al centro del salón.
            </p>
            <div class="d-inline-flex gap-1">
                <a class="btn" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Leer Mas</a>
                <div class="collapse multi-collapse" id="multiCollapseExample1">
                    <!-- Contenido colapsado -->
                    <p>
                        Se encuentra ubicado sobre la avenida Suarez Miranda y Cano Galvarro. Dos cuadras al norte del hospital de Quillacollo
                        Benigno Sánchez y 2 cuadras al sur del prado Villa Moderna.
                        El salón de eventos fue fundado en junio de 2000 por la familia Del-barco,
                        lleva más de 20 años de servicio a la población en alquiler de espacio para todo acontecimiento social.
                    </p>
                    <p>
                        En la actualidad la reserva y alquiler de eventos se realiza de manera escrita en un cuaderno de actas, de la siguiente manera,
                        se procede con la atención al cliente:
                        El cliente se presenta en la oficina ubicada dentro del salón de eventos y se lleva a cabo una reunión con el encargado.
                        La persona encargada de la reserva le presenta su servicio de alquiler de espacio para su evento social procediendo a mostrar
                        el espacio (pista, cocina, baños, recepción, etc.) donde se realizará el acontecimiento social.
                    </p>
                </div>
            </div>
            <!-- Botón transparente -->
            <style>
                .btn.transparent {
                    background-color: transparent !important;
                    border: none;
                }
            </style>
        </blockquote>
        <figcaption class="blockquote-footer">
            El Salon Pertenece <cite title="Source Title">a la Familia Del Barco</cite>
        </figcaption>
    </figure>
</div>

<div class="card" style="background-color: cornsilk;">
    <div class="card-body">
        <img src="Img/eventos.jpeg" alt="" srcset="">
        <div class="" style="float: right;">
                <div>
                    <P class="h6">PLANEA TU EVENTO CON NOSOTROS</P>
                </div>
        </div>
    </div>
</div><br>

<?php include("templates/footer.php"); ?>