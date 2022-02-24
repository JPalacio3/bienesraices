<?php
date_default_timezone_set('America/Mexico_City');

require '../../includes/app.php';

use App\Vendedor;

autenticado();

$vendedor = new Vendedor;

// Arrego con mensajes de errores
$errores = Vendedor::getErrores();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Crear una nueva instancia de vendedor
    $vendedor = new Vendedor($_POST['vendedor']);

    // Validar que no haya camnpos vacíos
    $errores = $vendedor->validar();

    // NO hay errroes:
    if (empty($errores)) {
        $vendedor->guardar();
}
}
?>






<?php incluirTemplates('header'); ?>
<main class='contenedor seccion'>
    <h1>Registrar Vendedor(a)</h1>

    <a href='/admin/index.php' class='btn btn-verde'> Volver</a>

    <?php
    // Insertar el mensaje de error cuando falten datos para validar el formulario
    foreach ($errores as $error) : ?>
        <!-- div contenedor para darle estilos al error-->
        <div class='alerta error'> <?php echo $error; ?> </div>

    <?php endforeach;
    ?>

    <form class='formulario' method='POST'>
        <?php include '../../includes/templates/formulario_vendedores.php' ?>
        <input type='submit' value='Registrar Vendedor' class='btn btn-verde'>

    </form>
    <!--Formulario -->
</main>

<?php incluirTemplates('footer'); ?>
