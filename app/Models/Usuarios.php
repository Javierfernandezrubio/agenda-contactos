<?php

namespace App\Models;

require 'DBAbstractModel.php';

class Usuarios extends DBAbstractModel {
    // Modelo singleton
    private static $instancia;
    public static function getInstancia() {
        if (!isset(self::$instancia)) {

            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }
    public function ___clone()
    {
        trigger_error('La clonación no es permitida!.', E_USER_ERROR);
    }

    /* Funciones  */
    public function login($usuario,$password){
        $this->query = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND password = '$password'";
        
        // Cargamos los parametros
        $this->parametros['usuario'] = $usuario;
        $this->parametros['password'] = $password;
        
        // Ejecutamos la consulta
        $this->get_results_from_query();

        if(count($this->rows) == 1){
            foreach ($this->rows[0] as $propiedad => $valor) {
                $this->$propiedad = $valor;
            }
            $this->mensaje = 'Login correcto';
        }else{
            $this->mensaje = 'Login incorrecto';
        }

        return $this->rows[0]??null;
    }

    // Creamos los métodos pero solo dejamos las declaraciones
    public function get($id = '') {
       /*  if ($id != '') {
            $this->query = "SELECT * FROM usuarios WHERE id = :id";
            $this->parametros['id'] = $id;
            $this->get_results_from_query();
        } else {
            $this->query = "SELECT * FROM usuarios";
            $this->get_results_from_query();
        }
        if (count($this->rows) >= 1) {
            $this->mensaje = 'Usuarios encontrados';
        } else {
            $this->mensaje = 'No se encontraron usuarios';
        }
        return $this->rows; */
    }
    public function set($sh_data= array())
    {
        /* foreach ($sh_data as $key => $value) {
            $$key = $value;
        }
        $this->query = "INSERT INTO usuarios (usuario, password, nombre, apellidos, email, telefono, direccion, ciudad, provincia, cp, pais, observaciones)
            VALUES ('$usuario', '$password', '$nombre', '$apellidos', '$email', '$telefono', '$direccion', '$ciudad', '$provincia', '$cp', '$pais', '$observaciones')";
        $this->execute_single_query(); */
    }
    public function edit($sh_data= array())
    {
        /* foreach ($sh_data as $key => $value) {
            $$key = $value;
        }
        $this->query = "UPDATE usuarios SET usuario = '$usuario', password = '$password', nombre = '$nombre', apellidos = '$apellidos', email = '$email', telefono = '$telefono', direccion = '$direccion', ciudad = '$ciudad', provincia = '$provincia', cp = '$cp', pais = '$pais', observaciones = '$observaciones' WHERE id = $id";
        $this->execute_single_query(); */
    }  
    public function delete($id = '')
    {
       /*  $this->query = "DELETE FROM usuarios WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->execute_single_query(); */
    }
}