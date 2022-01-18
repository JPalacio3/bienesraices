<?php 
// crear un usuario para acceder como administrador:

// IMPORTAR LA CONEXIÓN:
require 'includes/app.php';
$db = conectarDB();


// CREAR UN EMAIL Y UN PASSWORD:
$email = 'joelpalacio630@gmail.com';
$password = 'joel';

// LA FUNCIÓN pasword_hash() DE PHP ES PARA HASHEAR EL PASSWORD, toma dos parámetros, el password y el algoritmo de encriptado, en este caso es el algoritmo de bcrypt.
$hash = password_hash($password, PASSWORD_BCRYPT);

// QUERY PARA CREAR EL USUARIO EN LA BASE DE DATOS:
$query = "INSERT INTO usuarios (email, password) VALUES ('${email}', '${hash}');";

// AGREGARLO A LA BASE DE DATOS:
mysqli_query($db, $query);
?> 
 
