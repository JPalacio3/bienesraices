<?php

namespace App;

class Propiedad
{
    // Base de datos:
    protected static $db;
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];   // creamos un arreglo en el que incluimos todos los datos para acceder y sanitizar a ellos.

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
        debuggear($resultado);
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
}
