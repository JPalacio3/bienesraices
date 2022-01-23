<?php
date_default_timezone_set('America/Mexico_City');


require '../../includes/app.php';

use App\Propiedad;

autenticado();

$db = conectarDB();

// CONSULTAR A LA BASE DE DATOS LOS NOMBRES DE LOS VENDEDORES:

$consulta = 'SELECT * FROM vendedores';
$resultado = mysqli_query( $db, $consulta );

// Arrego con mensajes de errores
$errores = propiedad::getErrores();

// Evitar que se borren los valores escritos en los campos del formulario cuando se refresque la página:
$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedorId = '';
// $imagen = '';

// var_dump( $db );

// La superglobal $_SERVER contiene toda la información del servidor HTTP y es muy útil para saber la dirección IP del cliente, el nombre del host, el agente del cliente, etc.
// echo '<pre>';
// var_dump( $_SERVER['REQUEST_METHOD'] );
// echo '</pre>';

// La superglobal $_GET contiene toda la información GET enviada por el cliente.
// La superglobal $_POST contiene toda la información POST enviada por el cliente.

// Ejecutar el  código después de que el usuario completa el formulario:

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

$propiedad = new Propiedad( $_POST );
$errores = $propiedad->validar();


    if ( empty( $errores ) ) {

        $propiedad->guardar();

        // Asignar files ( archivos ) a variable
        $imagen = $_FILES['imagen'];

    // Revisar que el array de errores está vacío por medio de la función empty():

        // // SUBIDA DE ARCHIVOS AL SERVIDOR:

        // // Crear carpeta para guardar las imágenes:
        $carpetaImagenes = '../../imagenes/';

        // // Validar que la carpeta exista, si no existe la crea, si existe, la usa como carpeta de imágenes, pero no la vuelve a crear:
        if ( !is_dir( $carpetaImagenes ) ) {
            mkdir( $carpetaImagenes );
        }

        // // Generar un nombre único para cada imágen:
        $nombreImagen = md5( uniqid( rand(), true ) ) . '.webp';

        // // Subir archivo a la carpeta creada:
        move_uploaded_file( $imagen['tmp_name'], $carpetaImagenes . $nombreImagen );

    
        // echo $query;
        // $resultado = mysqli_query( $db, $query );

        if ( $resultado ) {
            // REDIRECCIONAR AL USUARIO UNA VEZ QUE SE HAYAN ENVIADO LOS DATOS DEL FORMULARIO A LA BASE DE DATOS:

            header( 'location: /admin?resultado=1' );

        }

    }
}

// FORMULARIO PARA CREAR UNA PROPIEDAD

incluirTemplates( 'header' );
?>

<main class = 'contenedor seccion'>
<h1>Crear propiedad</h1>

<a href = '/admin/index.php' class = 'btn btn-verde'> Volver</a>

<?php
// Insertar el mensaje de error cuando falten datos para validar el formulario
foreach ( $errores as $error ):?>
<!-- div contenedor para darle estilos al error-->
<div class = 'alerta error'> <?php echo $error;
?> </div>

<?php endforeach;
?>

<form class = 'formulario' method = 'POST' action = '/admin/propiedades/crear.php' enctype = 'multipart/form-data'>
<fieldset>
<legend> Información General </legend>

<label for = 'titulo'> Título </label>
<input type = 'text' name = 'titulo' id = 'titulo' placeholder = 'Título de la Propiedad' require value = "<?php echo $titulo; ?>">

<label for = 'precio'> Precio </label>
<input type = 'number' name = 'precio' id = 'precio' placeholder = 'Precio de la Propiedad' min = 1000000 require value = "<?php echo $precio; ?>">

<label for = 'imagen'> Imagen </label>
<input type = 'file' name = 'imagen' id = 'imagen' accept = 'image/jpeg, image/png, image/jpg' value = "<?php echo $imagen; ?>"> <!-- permite seleccionar el tipo de archivo que se puede subir -->

<label for = 'descripcion'> Descripción </label>
<textarea name = 'descripcion' id = 'descripcion' ><?php echo $descripcion;
?> </textarea>
</fieldset> <!--Información General -->

<fieldset>
<legend> Información de la Propiedad </legend>

<label for = 'habitaciones'> Habitaciones </label>
<input type = 'number' name = 'habitaciones' id = 'habitaciones' placeholder = 'Ejm: 3' require min = 1 max = 9 value = "<?php echo $habitaciones; ?>">

<label for = 'wc'> Baños </label>
<input type = 'number' name = 'wc' id = 'wc' placeholder = 'Ejm: 3' require min = 1 max = 9 value = "<?php echo $wc; ?>">

<label for = 'estacionamiento'> Estacionamiento </label>
<input type = 'number' name = 'estacionamiento' id = 'estacionamiento' placeholder = 'Ejm: 3' require min = 1 max = 9 value = "<?php echo $estacionamiento; ?>">
</fieldset> <!--Información de la propiedad -->

<fieldset>
<legend> Vendedor </legend>
<select name = 'vendedorId' id = 'vendedorId'>
<option selected disabled> Seleccione vendedor </option>
<?php while( $vendedorId = mysqli_fetch_assoc( $resultado ) ) : ?>
<option <?php echo $vendedorId == $vendedorId['id'] ? 'selected' : '';
?>
value = " <?php echo $vendedorId['id']; ?> ">
<?php echo $vendedorId['nombre']. ' ' . $vendedorId['apellido'];
?>
<!-- insertamos los valores de los vendedores con los valores de la base de datos -->
</option>
<?php endwhile;
?>

</select>
</fieldset> <!--Vendedor -->

<input type = 'submit' value = 'Crear Propiedad' class = 'btn btn-verde'>

</form> <!--Formulario -->
</main>

<?php
incluirTemplates( 'footer' );
?>