<?php
date_default_timezone_set('America/Mexico_City');

require '../../includes/app.php';
use App\Vendedor;
autenticado();

// Validar que sea un ID válido:
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id) {
    header('Location: /admin');
}

//Obtener el arreglo del vendedor desde la base de datos:
$vendedor = Vendedor::find($id);

// Arrego con mensajes de errores
$errores = Vendedor::getErrores();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

   // Asignar los valores:
   $args = $_POST['vendedor'];
  
   // Sincronizar objeto en memoria con lo que el usuario escribió:
    $vendedor->sincronizar($args);

    // Validación:
    $errores = $vendedor->validar();

    if(empty($errores)) {
        $vendedor->guardar();
    }
}
?>


<?php incluirTemplates('header'); ?>
<main class='contenedor seccion'>
    <h1>Actualizar Vendedor(a)</h1>

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
        <input type='submit' value='Guardar Cambios' class='btn btn-verde'>

    </form>
    <!--Formulario -->
</main>

<?php incluirTemplates('footer'); ?>