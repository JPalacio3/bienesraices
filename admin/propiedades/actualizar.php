 <script type="text/javascript" src="JS/index.js"></script>
 <?php
    require '../../includes/funciones.php';
    autenticado();



    // Validacion de que en URL por ID válido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if (!$id) {
        header('Location: index.php');
    }

    // Definir Zona horaria para la fecha
    date_default_timezone_set('America/Mexico_City');

    // CONEXIÓN A LA BASE DE DATOS
    require '../../includes/config/database.php';
    $db = conectarDB();

    // CONSUTAR LA BASE DE DATOS PARA OBTENER EL REGISTRO DE LA PROPIEDAD
    $consulta = "SELECT * FROM propiedades WHERE id = ${id}";
    $resultado = mysqli_query($db, $consulta);
    $propiedad = mysqli_fetch_assoc($resultado);
    // echo '<pre>';
    // var_dump($propiedad);
    // echo '</pre>';


    // CONSULTAR A LA BASE DE DATOS LOS NOMBRES DE LOS VENDEDORES:
    $consulta = 'SELECT * FROM vendedores';
    $resultado = mysqli_query($db, $consulta);

    // Arreglo con mensajes de errores
    $errores = [];

    // Evitar que se borren los valores escritos en los campos del formulario cuando se refresque la página:
    $titulo = $propiedad['titulo'];
    $precio = $propiedad['precio'];
    $descripcion = $propiedad['descripcion'];
    $habitaciones = $propiedad['habitaciones'];
    $wc = $propiedad['wc'];
    $estacionamiento = $propiedad['estacionamiento'];
    $vendedorId = $propiedad['vendedorId'];
    $imagenPropiedad = $propiedad['imagen'];

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
         <fieldset>
             <legend> Información General </legend>

             <label for='titulo'> Título </label>
             <input type='text' name='titulo' id='titulo' placeholder='Título de la Propiedad' require value="<?php echo $titulo; ?>">

             <label for='precio'> Precio </label>
             <input type='number' name='precio' id='precio' placeholder='Precio de la Propiedad' min=1000000 require value="<?php echo $precio; ?>">

             <label for='imagen'> Imagen </label>
             <input type='file' name='imagen' id='imagen' accept='image/jpeg, image/png, image/jpg' value="<?php echo $imagen; ?>"> <!-- permite seleccionar el tipo de archivo que se puede subir -->
             <img src="/imagenes/<?php echo $imagenPropiedad; ?>" class="imagen-small" alt="imagen de la propiedad">


             <label for='descripcion'> Descripción </label>
             <textarea name='descripcion' id='descripcion'><?php echo $descripcion;
                                                            ?> </textarea>
         </fieldset>
         <!--Información General -->

         <fieldset>
             <legend> Información de la Propiedad </legend>

             <label for='habitaciones'> Habitaciones </label>
             <input type='number' name='habitaciones' id='habitaciones' placeholder='Ejm: 3' require min=1 max=9 value="<?php echo $habitaciones; ?>">

             <label for='wc'> Baños </label>
             <input type='number' name='wc' id='wc' placeholder='Ejm: 3' require min=1 max=9 value="<?php echo $wc; ?>">

             <label for='estacionamiento'> Estacionamiento </label>
             <input type='number' name='estacionamiento' id='estacionamiento' placeholder='Ejm: 3' require min=1 max=9 value="<?php echo $estacionamiento; ?>">
         </fieldset>
         <!--Información de la propiedad -->

         <fieldset>
             <legend> Vendedor </legend>
             <select name='vendedorId' id='vendedorId'>
                 <option selected disabled> Seleccione vendedor </option>
                 <?php while ($vendedorId = mysqli_fetch_assoc($resultado)) : ?>
                     <option <?php echo $vendedorId === $vendedorId['id'] ? 'selected' : '';
                                ?> value=" <?php echo $vendedorId['id']; ?> ">
                         <?php echo $vendedorId['nombre'] . ' ' . $vendedorId['apellido'];
                            ?>
                         <!-- insertamos los valores de los vendedores con los valores de la base de datos -->
                     </option>
                 <?php endwhile;
                    ?>

             </select>
         </fieldset>
         <!--Vendedor -->

         <input type='submit' value='Actualizar Propiedad' class='btn btn-verde'>

     </form>
     <!--Formulario -->
     <input type='submit' value='Cancelar' class='btn btn-rojo' onclick="cancelar()">
 </main>

 <?php
    incluirTemplates('footer');
    ?>