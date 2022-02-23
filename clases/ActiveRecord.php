<?php

namespace App;

use App\ActiveRecord as AppActiveRecord;

class ActiveRecord {

    // Base de datos:
    protected static $db;
    protected static $columnasDB = []; // Arreglo de columnas de la tabla
    protected static $tabla = '';

    // validación de errores:

    protected static $errores = [];

    // Definir la conexión a la base de datos:
    public static function setDB($database)
    {
        self::$db = $database;  // Self::$  hace referencia a los atributos estáticos de la misma clase.
    }

    public function crear()
    {
        // SANITIZAR LOS DATOS:
        $atributos = $this->sanitizarDatos();

        // INSERTAR EN LA BASE DE DATOS
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";
        // $this-> hace referencia a los atributos públicos de la misma clase.

        // Ejecutar la consulta:
        $resultado = self::$db->query($query);

        if ($resultado) {
            header('location: /admin?resultado=1');
        }
    }

    public function actualizar()
    {
        // Sanitizar los datos:
        $atributos = $this->sanitizarDatos();

        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query($query);

        if ($resultado) {
            $this->borrarImagen();

            header('location: /admin?resultado=2');
        }
    }

    public function guardar()
    {
        if (!is_null($this->id)) {
            // Actualizando:
            $this->actualizar();
        } else {
            //Creando un nuevo registro:
            $this->crear();
        }
    }

    // Eliminar un registro:
    public function eliminar()
    {
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if ($resultado) {
            header('Location: /admin?resultado=3');
        }
    }

    // identificar y unir los atributos de la base de datos:
    public function atributos()
    {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
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

    // SUBIDA DE ARCHIVOS:
    public function setImagen($imagen)
    {
        //Comprobar si existe el archivo:
        if (!is_null($this->id)) {
            $this->borrarImagen();
        } else {
            CARPETA_IMAGENES . $this->imagen;
        }
    }

    // Eliminar el archivo de imagen:
    public function borrarImagen()
    {
        //ELIMINACIÓN DEL ARCHIVO:
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    // VALIDACIÓN DE ERRORES:
    public static function getErrores()
    {
        return static::$errores;
    }

    public function validar()
    {
        static::$errores = [];
        return static::$errores;
    }

    // Lista todos los registros:
    public static function all()
    {
        $query = "SELECT * FROM " . static::$tabla . " ORDER BY id DESC";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Busca un registro por su id:
    public static function find($id)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = ${id}";
        $resultado = self::consultarSQL($query);
        return (array_shift($resultado));
    }

    public static function consultarSQL($query)
    {
        // Consultar la base de datos:
        $resultado = self::$db->query($query);

        // Iterar los resultados:
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        // Liberar la memoria:
        $resultado->free();

        // Retornar los resultados:
        return $array;
    }

    protected static function crearObjeto($registro)
    {
        $objeto = new static;

        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }


    // Sincroniza el objeto en memoria con los cambios realizados por el usuario:

    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}
