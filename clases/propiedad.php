<?php

namespace App;

class Propiedad extends ActiveRecord
{
    protected static $tabla = 'propiedades';
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];
    // creamos un arreglo en el que incluimos todos los datos para acceder y sanitizar a ellos.

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

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d') ?? '';
        $this->vendedorId = $args['vendedorId'] ?? '';
    }


    public function validar()
    {
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
        if (!$this->imagen) {
            self::$errores[] = 'La imágen es obligatoria';
        }
        return self::$errores;
    }
}
