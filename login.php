<?php
// IMPORTAR LA CONEXIÓN DE LA BASE DE DATOS Y HACER LAS VALIDACIONES DEL FORMULARIO

// Importar la conexión a la base de datos:
require 'includes/app.php';
$db = conectarDB();

// Validar errores en caso de que ocurran:
$errores = [];

// Autenticar el usuario:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ver el arreglo con los valores de los inputs:
    // echo '<pre>';
    // var_dump($_POST);
    // echo '</pre>';

    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // Validar errores:
    if (!$email) {
        $errores[] = ' El email es obligatorio o no es válido ';
    }
    if (!$password) {
        $errores[] = ' El Password es obligatorio ';
    }

    // Al pasar la validación:
    if (empty($errores)) {
        // Revisar si el usuario existe:
        $query = "SELECT * FROM usuarios WHERE email = '${email}'";
        $resultado = mysqli_query($db, $query);
        var_dump($resultado);

        if ($resultado->num_rows) {
            // Revisar si el password es correcto:
            $usuario = mysqli_fetch_assoc($resultado);
            // var_dump($usuario);
                                                              
            //Verificar si el password es correcto o no:
            $auth = password_verify($password, $usuario['password']);
            var_dump($auth);

            if ($auth) {
                // El usuario está autenticado:
                session_start();

                //Llenar el arreglo de la sesión:
                $_SESSION['USUARIO'] = $usuario['email'];
                $_SESSION['login'] = true;

                header('Location: admin');

                // echo '<pre>';
                // var_dump($_SESSION);
                // echo '</pre>';
            } else {
                $errores[] = 'EL PASSWORD ES INCORRECTO';
            }
        } else {
            $errores[] = 'EL USUARIO NO EXISTE';
        }
    }
}


//  FORMULARIO DE LOGIN

// Incluye el archivo del header:
incluirTemplates('header');
?>

<main class='contenedor seccion contenido-centrado'>
    <h1>Iniciar Sesión</h1>

    <?php
    // Agregamos la validación de errores al formulario:
    foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class='formulario' method='POST' action="">
        <fieldset>
            <legend>Email y Password</legend>

            <label for='email'>E-mail:</label>
            <input type='email' name="email" placeholder='Tu Email' id='email' required>

            <label for='password'>Password:</label>
            <input type='password' name="password" placeholder ='Introduce un Password' id='password' required>
        </fieldset>
        <input type="submit" value="Iniciar Sesión" class="btn btn-verde">
    </form>
</main>

<?php incluirTemplates('footer');
?>