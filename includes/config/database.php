<?php

// CONEXIÓN A BASE DE DATOS:


function conectarDB() : mysqli {

$server = "localhost";
$user = "root";
$pass = "root";
$bd = "bienes_raices";

      $db = new mysqli($server, $user, $pass, $bd); // conexión a la base de datos
      $db->set_charset("utf8"); // Para que se muestren correctamente los acentos y las ñ
      

    if (!$db) {
        echo 'Error en la conexión a la base de datos';
        exit;
    } 
    return $db;
}
?>