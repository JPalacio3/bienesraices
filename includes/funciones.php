<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', __DIR__ . '/../imagenes/');


// función para incluir el archivo de html en el documento de php. Usamos los types (string y bool) para el tipo de dato que devuelve la función

function incluirTemplates(string $nombre, bool $inicio = false)
{
    include TEMPLATES_URL . "/${nombre}.php";
}

function autenticado()
{
    session_start();

    if (!$_SESSION['login']) {
        header('location: /');
    }
}
function debuggear($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    exit;
}

// Escapar/Sanitizar el HTML:

function s($html): string
{
    $s = htmlspecialchars($html);
    return $s;
}

// Validar tipo de contenido:

function validarTipoContenido($tipo)
{
    $tipos = ['vendedor', 'propiedad'];

    return in_array($tipo, $tipos);
}

// Muestra los mensajes de alerta:

function mostrarNotificacion($codigo)
{
    $mensaje = '';

    switch ($codigo) {
        case 1:
            $mensaje = 'Creado Correctamente';
            break;

        case 2:
            $mensaje = 'Actualizado Correctamente';
            break;

        case 3:
            $mensaje = 'Eliminado Correctamente';
            break;
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}
