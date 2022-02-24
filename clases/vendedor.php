<?php

namespace App;

class Vendedor extends ActiveRecord
{

    protected static $tabla = 'vendedores';

    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];
    // creamos un arreglo en el que incluimos todos los datos para acceder y sanitizar a ellos.

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }


    public function validar()
    {
        // Validador de errores al enviar el formulario:
        if (!$this->nombre) {
            self::$errores[] = 'El Nombre es Obligatorio';
        }
        if (!$this->apellido) {
            self::$errores[] = 'El Apellido es Obligatorio';
        }
        if (!$this->telefono) {
            self::$errores[] = 'Por favor registre el teléfono de contacto';
        }

        if(!preg_match('/[0-9]{10}/', $this->telefono)) {
            self::$errores[] = 'El teléfono debe contener 10 dígitos';
        }

        return self::$errores;
}
}