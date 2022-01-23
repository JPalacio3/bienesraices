<?php

namespace App;

class Propiedad
{
    // Base de datos:
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];   // creamos un arreglo en el que incluimos todos los datos para acceder y sanitizar a ellos.

// validación de errores:

protected static $errores = [];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;


    // Definir la conexión a la base de datos:
    public static function setDB($database)
    {
        self::$db = $database;  // Self::$  hace referencia a los atributos estáticos de la misma clase.
    }


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? 'imagen.jpg';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d') ?? '';
        $this->vendedorId = $args['vendedorId'] ?? '';
    }

    public function guardar()
    {
        // SANITIZAR LOS DATOS:
        $atributos = $this->sanitizarDatos();

        // INSERTAR EN LA BASE DE DATOS
        $query = " INSERT INTO propiedades ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ')";
        // $this-> hace referencia a los atributos públicos de la misma clase.

        // Ejecutar la consulta:
        $resultado = self::$db->query($query);
    }
    // identificar y unir los atributos de la base de datos:
    public function atributos()
    {
        $atributos = [];
        foreach (self::$columnasDB as $columna) {
            if ($columna == 'id') continue; // Ignorar el Id en el arreglo de atributos. 
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }
    // Sanitizar los datos:
    public function sanitizarDatos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->real_escape_string($value);
        }
        return $sanitizado;
    }

// VALIDACIÓN DE ERRORES:
public static function getErrores() {
return self::$errores;
}

public function validar() {
        // Validador de errores al enviar el formulario:
        if (!$this->titulo) {
            self::$errores[] = 'Debes añadir un títilo';
        }
        if (!$this->precio) {
            self::$errores[] = 'El precio es obligatorio';
        }
        if (strlen(!$this->descripcion) > 20) {
            self::$errores[] = 'Debes añadir una descripción de la propiedad y  debe contener al menos 20 caracteres';
        }
        if (!$this->habitaciones) {
            self::$errores[] = 'Debes añadir la cantidad de habitaciones';
        }
        if (!$this->wc) {
            self::$errores[] = 'Debes añadir la cantidad de baños';
        }
        if (!$this->estacionamiento) {
            self::$errores[] = 'Debes añadir la cantidad de estacionamientos';
        }
        if (!$this->vendedorId) {
            self::$errores[] = 'Es obligatorio seleccionar el vendedor de la propiedad';
        }
        // if (!$this->imagen['name'] || $this->imagen['error']) {
        //     self::$errores[] = 'Es obligatorio seleccionar una imagen';
        //     // validar por tamaño de la imagen ( 100kb máximo ):
        //     $this->medida = 1000 * 100;
        //     if ($this->imagen['size'] > $this->medida) {
        //         self::$errores[] = 'La imagen es muy grande';
        //     }
        // }
}
}
