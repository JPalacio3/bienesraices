<?php

// Una vez autenticado, redirigir al usuario a la página de inicio:
require '../includes/app.php';
autenticado();

use App\Propiedad;
use App\Vendedor;

// Implementar un método para obtener todas las propiedades utilizando Active Record
$propiedades = Propiedad::all();
$vendedores = Vendedor::all();

// Mensaje de registrado correctamente:
$resultado = $_GET['resultado'] ?? null;


// ELIMINACIÓN DE PROPIEDADES:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if ($id) {

        $propiedad = Propiedad::find($id);

        $propiedad->eliminar();
    }
}



incluirTemplates('header'); ?>
<!-- incorporación de AlertifyJs y JQery -->
<link rel="stylesheet" href="../alertifyjs/css/alertify.css">
<link rel="stylesheet" href="../alertifyjs/css/themes/default.css">
<script src="jquery-3.6.0.min.js"></script>
<script src="../alertifyjs/alertify.min.js"></script>


<main class="contenedor seccion">
    <h1>Administrador de Bienes Raíces</h1>

    <!-- Validar que exista el resultado y lo imprime como un memsaje en pantalla.
intval() se usa para convertir un VALOR DE STRING A NÚMERO. Posteriormente agrego alertify y JQery para mostrar la notificación-->
    <?php
    if (intval($resultado) === 1) : ?>
        <script>
            alertify.confirm('Anuncio creado exitosamente, ¡ Gracias !');
        </script>
    <?php endif; ?>
    <?php
    if (intval($resultado) === 2) : ?>
        <script>
            alertify.confirm('Anuncio Actualizado correctamente, ¡ Gracias !');
        </script>
    <?php endif; ?>
    <?php
    if (intval($resultado) === 3) : ?>
        <script>
            alertify.confirm('Anuncio Eliminado correctamente');
        </script>
    <?php endif; ?>

    <a href="/admin/propiedades/crear.php" class="btn btn-verde"> Nueva Propiedad</a>

    <table class="propiedades">
        <h2>Propiedades</h2>
        <thead>
            <tr>
                <th>Id</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>imágen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <!-- Mostrar los resultados-->
            <?php foreach ($propiedades as $propiedad) : ?>

                <tr>
                    <td class="id-color"><?php echo $propiedad->id ?> </td>
                    <td> <?php echo $propiedad->titulo ?> </td>
                    <td> <?php echo $propiedad->descripcion ?> </td>
                    <td> <img src="/imagenes/<?php echo $propiedad->imagen ?>" class="imagen-tabla" alt="imagen de propiedad"></td>
                    <td> $ <?php echo $propiedad->precio ?> </td>
                    <td>
                        <!--Abrir ventanas tipo popUp -->
                        <a href="../admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Vendedores</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <!-- Mostrar los resultados-->
            <?php foreach ($vendedores as $vendedor) : ?>

                <tr>
                    <td class="id-color"><?php echo $vendedor->id; ?> </td>
                    <td> <?php echo $vendedor->nombre . ' ' . $vendedor->apellido; ?> </td>
                    <td><?php echo $vendedor->telefono; ?> </td>
                    <td>
                        <!--Abrir ventanas tipo popUp -->
                        <a href="../admin/vendedores/actualizar.php?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">Actualizar</a>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>




</main>

<?php incluirTemplates('footer'); ?>