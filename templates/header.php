<?php
session_start();
$urlbase = "http://localhost/app/";
if (!isset($_SESSION['nom_usuario'])) header("location:" . $urlbase . "login.php");
?>
<!doctype html>
<html lang="en">

<head>
    <title>Aplicacion Gestion de Eventos</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="../APP/Css/bootstrap.min.css">
    <link rel="stylesheet" href="../APP/Css/bootstrap.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <style type="text/css">
        body {
            background: #360033;
            /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #0b8793, #360033);
            /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #0b8793, #360033);
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        }
    </style>
    <header>
        <nav class="navbar navbar-expand-sm navbar-dark justify-content-center" style="background-color: black;">

            <ul class="nav navbar-nav">

                <li class="nav-item">
                    <a class="navbar-brand" href="<?php echo $urlbase; ?>/">
                        Salon Eventos "SEÑORIAL"
                        <img src="Img/icono.jpg" class="d-inline-block align-text-center" width="30">
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo $urlbase; ?>modulos/clients/">Clientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo $urlbase; ?>modulos/events/">Eventos</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="<?php echo $urlbase; ?>modulos/informes/">Informes</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo $urlbase; ?>modulos/pagos/">Pagos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo $urlbase; ?>modulos/usuarios/">Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo $urlbase; ?>cerar.php">Cerrar Sesion</a>
                </li>
            </ul>
        </nav>
    </header>
    <main class="container"><br>
        <?php if (isset($_GET['mensaje'])) { ?>
            <script>
                Swal.fire({
                    icon: "success",
                    title: "<?php echo $_GET['mensaje']; ?>"
                });
            </script>
        <?php } ?>