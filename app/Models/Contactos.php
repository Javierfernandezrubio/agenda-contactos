<?php
/**
 * Clase Contactos
 *
 * @author Javier Fernández Rubio
 */
namespace App\Models;

//require 'DBAbstractModel.php';
class Contactos extends DBAbstractModel
{
    // Modelo singleton
    private static $instancia;
    public static function getInstancia()
    {
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

    function _construct()
    {
    }

    public function get($id = '')
    {
        $this->query = "SELECT * FROM contactos
    WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        return $this->rows;
    }

    public function getAll()
    {
        $this->query = "SELECT * FROM contactos";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function set($data_array = []){
        foreach ($data_array as $key => $value) {
            $$key = $value;
        }
        $this->query = "INSERT INTO contactos VALUES(null, :nombre, :telefono, :email)";
        $this->execute_single_query(); 
    }

    public function update($id = '', $data_array = []){
        foreach ($data_array as $key => $value) {
            $$key = $value;
        }
        $this->query = "UPDATE contactos SET nombre = :nombre, telefono = :telefono, email = :email WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->execute_single_query(); 
    }

    public function delete($id = ''){
        $this->query = "DELETE FROM contactos WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->execute_single_query(); 
    }


}
