 <script type="text/javascript" src="JS/index.js"></script>
 <?php

    use App\Propiedad;

    require '../../includes/app.php';
    autenticado();



    // Validacion de que en URL por ID válido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if (!$id) {
        header('Location: index.php');
    }

    // Definir Zona horaria para la fecha
    date_default_timezone_set('America/Mexico_City');

    // Obtener los datos de la propiedad:
    $propiedad = Propiedad::find($id);
    // debuggear($propiedad);


    // CONSULTAR A LA BASE DE DATOS LOS NOMBRES DE LOS VENDEDORES:
    $consulta = 'SELECT * FROM vendedores';
    $resultado = mysqli_query($db, $consulta);

    // Arreglo con mensajes de errores
    $errores = [];

    // Evitar que se borren los valores escritos en los campos del formulario cuando se refresque la página:
    // $titulo = $propiedad['titulo'];
    // $precio = $propiedad['precio'];
    // $descripcion = $propiedad['descripcion'];
    // $habitaciones = $propiedad['habitaciones'];
    // $wc = $propiedad['wc'];
    // $estacionamiento = $propiedad['estacionamiento'];
    // $vendedorId = $propiedad['vendedorId'];
    // $imagenPropiedad = $propiedad['imagen'];

    // var_dump( $db );

    // La superglobal $_SERVER contiene toda la información del servidor HTTP y es muy útil para saber la dirección IP del cliente, el nombre del host, el agente del cliente, etc.
    // echo '<pre>';
    // var_dump( $_SERVER['REQUEST_METHOD'] );
    // echo '</pre>';

    // La superglobal $_GET contiene toda la información GET enviada por el cliente.
    // La superglobal $_POST contiene toda la información POST enviada por el cliente.

    // Ejecutar el  código después de que el usuario completa el formulario:

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // validar subida de datos al servidor
        // echo '<pre>';
        // var_dump( $_POST );
        // echo '</pre>';

        // validar subida de archivos al servidor
        // echo '<pre>';
        // var_dump( $_FILES );
        // echo '</pre>';

        $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
        $precio = mysqli_real_escape_string($db, $_POST['precio']);
        $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
        $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
        $wc = mysqli_real_escape_string($db, $_POST['wc']);
        $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
        $vendedorId = mysqli_real_escape_string($db, $_POST['vendedorId']);
        $creado = date('Y/m/d H:i:s');
        // Asignar files ( archivos ) a variable
        $imagen = $_FILES['imagen'];

        // Validador de errores al enviar el formulario:
        if (!$titulo) {
            $errores[] = 'Debes añadir un títilo';
        }
        if (!$precio) {
            $errores[] = 'El precio es obligatorio';
        }
        // if ( !$imagen ) {
        //     $errores[] = 'La imagen es obligatoria';
        // }

        if (strlen(!$descripcion) > 20) {
            $errores[] = 'Debes añadir una descripción de la propiedad y  debe contener al menos 20 caracteres';
        }
        if (!$habitaciones) {
            $errores[] = 'Debes añadir la cantidad de habitaciones';
        }
        if (!$wc) {
            $errores[] = 'Debes añadir la cantidad de baños';
        }
        if (!$estacionamiento) {
            $errores[] = 'Debes añadir la cantidad de estacionamientos';
        }
        if (!$vendedorId) {
            $errores[] = 'Es obligatorio seleccionar el vendedor de la propiedad';
        }

        // echo '<pre>';
        // var_dump( $errores );
        // echo '</pre>';

        // Revisar que el array de errores está vacío por medio de la función empty():

        if (empty($errores)) {

            // Subida de archivos al servidor:
            $carpetaImagenes = '../../imagenes/';

            // Validar que la carpeta exista, si no existe la crea, si existe, la usa como carpeta de imágenes, pero no la vuelve a crear:
            if (!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }

            $nombreImagen = ''; // Variable para almacenar el nombre de la imagen y evitar que se borre la imagen anterior si no se sube ninguna nueva.

            if ($imagen['name']) {

                // Eliminar la imagen anterior de la carpeta:
                unlink($carpetaImagenes . $propiedad['imagen']);

                // Generar un nombre único para cada imágen:
                $nombreImagen = md5(uniqid(rand(), true)) . '.webp';

                // Subir archivo a la carpeta creada:
                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
            } else {
                $nombreImagen = $propiedad['imagen'];
            }



            // INSERTAR DATOS EN LA BASE DE DATOS
            $query = "UPDATE propiedades SET  titulo='${titulo}', precio='${precio}', imagen='${nombreImagen}', descripcion='${descripcion}', habitaciones=${habitaciones}, wc=${wc}, estacionamiento=${estacionamiento}, vendedorId=${vendedorId} WHERE id = ${id}";

            // echo $query;
            $resultado = mysqli_query($db, $query);

            if ($resultado) {
                // REDIRECCIONAR AL USUARIO UNA VEZ QUE SE HAYAN ENVIADO LOS DAOS DEL FORMULARIO A LA BASE DE DATOS:

                header('location: /admin?resultado=2');
            }
        }
    }

    // FORMULARIO PARA CREAR UNA PROPIEDAD

    incluirTemplates('header');
    ?>

 <main class='contenedor seccion'>
     <h1>Actualizar propiedad</h1>

     <!-- <a href = '/admin/index.php' class = 'btn btn-verde'> Volver</a> -->

     <?php
        // Insertar el mensaje de error cuando falten datos para validar el formulario
        foreach ($errores as $error) : ?>
         <!-- div contenedor para darle estilos al error-->
         <div class='alerta error'> <?php echo $error;
                                    ?> </div>

     <?php endforeach;
        ?>

     <form class='formulario' method='POST' enctype='multipart/form-data'>

         <?php include '../../includes/templates/formulario_propiedades.php' ?>

         <input type='submit' value='Actualizar Propiedad' class='btn btn-verde'>

     </form>
     <!--Formulario -->
     <input type='submit' value='Cancelar' class='btn btn-rojo' onclick="cancelar()">
 </main>

 <?php
    incluirTemplates('footer');
    ?>