<?php
date_default_timezone_set('America/Mexico_City');

require '../../includes/app.php';

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;


autenticado();

// Consulta para obtener todas las propiedades:
$propiedad = new Propiedad;

// Consulta para obtener todos los vendedores:
$vendedores = Vendedor::all();


// Arrego con mensajes de errores
$errores = Propiedad::getErrores();

// La superglobal $_SERVER contiene toda la información del servidor HTTP y es muy útil para saber la dirección IP del cliente, el nombre del host, el agente del cliente, etc.
// echo '<pre>';
// var_dump( $_SERVER['REQUEST_METHOD'] );
// echo '</pre>';

// La superglobal $_GET contiene toda la información GET enviada por el cliente.
// La superglobal $_POST contiene toda la información POST enviada por el cliente.

// Ejecutar el  código después de que el usuario completa el formulario:

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //CREAR UNA NUEVA INSTANCIA//
    $propiedad = new Propiedad($_POST['propiedad']);

    $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

    // // Crear una instancia de la clase ImageManagerStatic:
    if ($_FILES['propiedad']['tmp_name']['imagen']) {
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
        $propiedad->setImagen($nombreImagen);
    }


    // VALIDAR  
    $errores = $propiedad->validar();

    if (empty($errores)) {

        // crear carpeta para guardar las imágenes:
        if (!is_dir(CARPETA_IMAGENES)) {
            mkdir(CARPETA_IMAGENES);
        }


        //         // Almacenar la imagen en el disco duro:
        if ($_FILES['propiedad']['tmp_name']['imagen']) {
            // Almacenar la imágen:
            $image->save(CARPETA_IMAGENES . $nombreImagen);
        }
    }
    $propiedad->crear();
}

// FORMULARIO PARA CREAR UNA PROPIEDAD

incluirTemplates('header');
?>

<main class='contenedor seccion'>
    <h1>Crear propiedad</h1>

    <a href='/admin/index.php' class='btn btn-verde'> Volver</a>

    <?php
    // Insertar el mensaje de error cuando falten datos para validar el formulario
    foreach ($errores as $error) : ?>
        <!-- div contenedor para darle estilos al error-->
        <div class='alerta error'> <?php echo $error; ?> </div>

    <?php endforeach;
    ?>

    <form class='formulario' method='POST' action='/admin/propiedades/crear.php' enctype='multipart/form-data'>
        <?php include '../../includes/templates/formulario_propiedades.php' ?>
        <input type='submit' value='Crear Propiedad' class='btn btn-verde'>

    </form>
    <!--Formulario -->
</main>

<?php
incluirTemplates('footer');
?>