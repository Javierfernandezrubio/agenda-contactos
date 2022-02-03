<?php
namespace App\Models;

/**
 * Clase Contactos
 *
 * @author Javier Fernández Rubio
 */
require 'DBAbstractModel.php';
class Contactos extends DBAbstractModel {
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

    public function set($sh_data= array())
    {
        foreach ($sh_data as $key => $value) {
            $$key = $value;
        }
        $this->query = "INSERT INTO contactos (nombre, apellidos, telefono, email, direccion, ciudad, provincia, cp, pais, observaciones)
            VALUES ('$nombre', '$apellidos', '$telefono', '$email', '$direccion', '$ciudad', '$provincia', '$cp', '$pais', '$observaciones')";
        $this->execute_single_query();
    }

    private $id;
    private $nombre;
    private $telefono;
    private $email;
    private $created_at;
    private $updated_at;

    function _construct()
    {
        $this->db_name = 'bd_contactos';
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public  function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getID($id = '')
    {
        if ($id != '') {
            $this->query = "SELECT * FROM contactos WHERE id = :id";
            $this->parametros['id'] = $id;
            $this->get_results_from_query();
            if (count($this->rows) == 1) {
                foreach ($this->rows[0] as $propiedad => $valor) {
                    $this->$propiedad = $valor;
                }
                return true;
            }
        }
    }

    public function getAll()
    {
        $this->query = "SELECT * FROM contactos";
        $this->get_results_from_query();
        return $this->rows;
    }

}
