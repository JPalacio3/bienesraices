<?php

// REVISAR SI YA HAY UNA SESIÓN ACTIVA Y SI NO, CREARLA:    
if (!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION['login'] ?? false;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>😍Bienes Raíces😍</title>
    <link rel="stylesheet" href="/build/css/normalize.css">
    <link rel="stylesheet" href="/build/css/app.css">
</head>

<body>

    <header class="header <?php echo $inicio ? 'inicio' : '' ?>">
        <!-- Esta es la validación de la clase inicio con php y la agrega -->
        <div class="contenedor .contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="/build/img/logo.svg" alt="logotipo de bienes raíces">
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="icono menú responsive">
                </div>
                <!--manu hamburguesa-->
                <div class="derecha">
                    <img class="dark-mode-boton" src="/build/img/dark-mode.svg" alt="boton dark-mode-boton">
                    <nav class="navegacion navOsc">
                        <a href="nosotros.php">Nosotros</a>
                        <a href="anuncios.php">Anuncios</a>
                        <a href="blog.php">Blog</a>
                        <a href="contacto.php">Contacto</a>
                        
                        <?php if($auth):   ?>
                            <a href="contacto.php">Cerrar Sesión</a>
                            <?php endif; ?>
                    </nav>
                </div>
            </div>
            <!--.barra-->
            <?php echo $inicio ? "<h1 class='contenido-header' > Venta de Casas y Departamentos de Lujo </h1>" : ''; ?>
        </div>
    </header>