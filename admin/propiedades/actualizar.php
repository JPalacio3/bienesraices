 <script type="text/javascript" src="JS/index.js"></script>
 <?php

    use App\Propiedad;
    use Intervention\Image\ImageManagerStatic as Image;

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
    $errores = Propiedad::getErrores();

   

    // Ejecutar el  código después de que el usuario completa el formulario:

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Asignar los atributos:
        $args = $_POST['propiedad'];


        $propiedad->sincronizar($args);

        // Validación de errores:
        $errores = $propiedad->validar();

        // Subida de archivos:
        // // Generar un nombre único para cada imágen:
        $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

        // // Crear una instancia de la clase ImageManagerStatic:
        if($_FILES['propiedad']['tmp_name']['imagen']) {
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
            $propiedad->setImagen($nombreImagen);
        }


        if (empty($errores)) {

            // Almacenar la imagen en el disco duro:
            $image->save(CARPETA_IMAGENES . $nombreImagen);
            $propiedad->guardar();

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
         <div class='alerta error'> <?php echo $error; ?></div>
     <?php endforeach; ?>

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