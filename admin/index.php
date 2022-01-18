<?php

// Una vez autenticado, redirigir al usuario a la página de inicio:
require '../includes/funciones.php';
autenticado();


// Importar la conexión
require '../includes/config/database.php';
$db = conectarDB();

// Escribir el Query EN ORDER DESCNENDENTE

$query = "SELECT * FROM propiedades ORDER BY id DESC"; 

// Consultar la base de datos
$resultadoConsulta = mysqli_query($db, $query);


// Mensaje de registrado correctamente:
$resultado = $_GET['resultado'] ?? null;


// ELIMINACIÓN DE PROPIEDADES:
if($_SERVER['REQUEST_METHOD']=== 'POST') {

    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if($id) {
//ELIMINACIÓN DEL ARCHIVO:
        $query = "SELECT imagen FROM propiedades WHERE id = ${id}";
        $resultado = mysqli_query($db, $query);
        $propiedad = mysqli_fetch_assoc($resultado);
        unlink('../imagenes/' . $propiedad['imagen']);

// ELIMINAR LA PROPIEDAD:
        $query = "DELETE FROM propiedades WHERE id = ${id}";
        $resultado = mysqli_query($db, $query);
    }
        if($resultado) {
        header('Location: /admin?resultado=3');
    }
}



incluirTemplates('header'); ?>
<!-- incorporación de AlertifyJs y JQery -->
<link rel="stylesheet" href="../alertifyjs/css/alertify.css" >
<link rel="stylesheet" href="../alertifyjs/css/themes/default.css" >
<script src="jquery-3.6.0.min.js" ></script>
<script src="../alertifyjs/alertify.min.js" ></script>


    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raíces</h1>

<!-- Validar que exista el resultado y lo imprime como un memsaje en pantalla.
intval() se usa para convertir un VALOR DE STRING A NÚMERO. Posteriormente agrego alertify y JQery para mostrar la notificación-->
        <?php 
        if(intval($resultado) === 1) : ?> 
            <script> alertify.confirm('Anuncio creado exitosamente, ¡ Gracias !'); </script>
        <?php endif; ?>
     <?php 
        if(intval($resultado) === 2) : ?> 
            <script> alertify.confirm('Anuncio Actualizado correctamente, ¡ Gracias !'); </script>
        <?php endif; ?>
        <?php 
        if(intval($resultado) === 3) : ?> 
            <script> alertify.confirm('Anuncio Eliminado correctamente'); </script>
        <?php endif; ?>

<a href="/admin/propiedades/crear.php" class="btn btn-verde"> Nueva Propiedad</a>

<table class="propiedades">

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

<tbody> <!-- Mostrar los resultados-->
<?php
while($propiedad = mysqli_fetch_assoc($resultadoConsulta)): ?>
    <tr>
       <td class="id-color" > <?php echo $propiedad['id']?> </td>
       <td> <?php echo $propiedad['titulo']?> </td>
       <td> <?php echo $propiedad['descripcion']?> </td>
       <td> <img src="/imagenes/<?php echo $propiedad['imagen']?>" class="imagen-tabla" alt="imagen de propiedad"></td>
       <td> $ <?php echo $propiedad['precio']?> </td>
        <td> <!--Abrir ventanas tipo popUp -->
            <a href="../admin/propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">Actualizar</a>
            <form method="POST" class="w-100">
                <input type="hidden" name="id" value="<?php echo $propiedad['id']; ?>" >
                <input type="submit" class="boton-rojo-block" value="Eliminar">
            </form>
            
       </td>
    </tr> 
    <?php endwhile; ?>
        </tbody>
</table>
</main>
<?php 
// Cerrar la conexión
mysqli_close($db);
?>
<?php incluirTemplates('footer'); ?>