<?php

namespace App;

class Vendedor extends ActiveRecord
{

    protected static $tabla = 'vendedores';

    protected static $columnasDB = ['id', 'apellido', 'telefono'];
    // creamos un arreglo en el que incluimos todos los datos para acceder y sanitizar a ellos.

    public $id;
    public $apellido;
    public $telefono;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }
}
