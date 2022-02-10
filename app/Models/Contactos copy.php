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

   

    
/*
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
    } */



    public function edit($nombre = "", $telefono = "", $mail = "", $id = "")
    {
        $this->query = "
        UPDATE contactos
        SET nombre=:nombre,
        telefono=:telefono,
        mail=:mail
        WHERE id = :id
        ";
        $this->parametros['nombre'] = $nombre;
        $this->parametros['telefono'] = $telefono;
        $this->parametros['mail'] = $mail;
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        $this->mensaje = 'sh modificado';
    }
    public function delete($id = '')
    {
        $this->query = "DELETE FROM contactos
        WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        $this->mensaje = 'SH eliminado';
    }
    public function get($id = '')
    {
        $this->query = "SELECT * FROM contactos
    WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        return $this->rows;
    }
    public function set(){}


    public function get_all()
    {
        $this->query = "SELECT * FROM contactos";
        $this->get_results_from_query();
        return $this->rows;

    }
    public function getMensaje()
    {
        return $this->mensaje;
    }
    public function getbynombre($nombre = '')
    {
        $this->query = "SELECT * FROM contactos
    WHERE nombre = :nombre";
        $this->parametros['nombre'] = $nombre;
        $this->get_results_from_query();
        return $this->rows;
    }
    public function setEntity()
    {
        $this->query = "INSERT INTO contactos(nombre, telefono, mail)
                        VALUES(:nombre, :telefono, :mail)";
        $this->parametros['nombre'] = $this->nombre;
        $this->parametros['telefono'] = $this->telefono;
        $this->parametros['mail'] = $this->mail;
        $this->get_results_from_query();
        $this->mensaje = 'contacto añadido.';
    }
    public function getEntity()
    {
        $this->query = "SELECT * FROM contactos
                        WHERE id = :id";
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
        $this->mensaje = $this->rows;
    }
    public function editEntity()
    {
        $this->query = "UPDATE contactos
                        SET nombre=:nombre,
                        telefono=:telefono,
                        mail=:mail
                        WHERE id = :id";
        $this->parametros['nombre'] = $this->nombre;
        $this->parametros['telefono'] = $this->telefono;
        $this->parametros['mail'] = $this->mail;
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
        $this->mensaje = 'contactos modificado.';
    }
    public function deleteEntity()
    {
        $this->query = "DELETE FROM contactos
                        WHERE id = :id";
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
        $this->mensaje = 'Contactos eliminado.';
    }

}
