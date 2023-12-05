<?php 

$servidor ="localhost";
$basedatos ="salon";
$usuario="root";
$contra="";

try {
    $conexion= new PDO("mysql:host=$servidor;dbname=$basedatos",$usuario,$contra);
} catch (Exception $th) {
    echo $th->getMessage();
}

?>