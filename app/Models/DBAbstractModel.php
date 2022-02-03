<?php
namespace App\Models;


abstract class DBAbstractModel
{
    private static $db_host = DBHOST;
    private static $db_user = DBUSER;
    private static $db_pass = DBPASS;
    private static $db_name = DBNAME;
    //private static $db_port = DBPORT;


    protected $mensaje = '';
    protected $conn; //manejador de la bd

    //manejo básico para consultas
    protected $query; //consulta
    protected $parametros = array(); //parámetro
    protected $rows = array(); //array con los datos de salida

    
    //metodos abstractos para implementar en los diferentes módulos
    abstract protected function get();
    abstract protected function set();
    abstract protected function edit();
    abstract protected function delete();

    protected function open_connection()
    {
        $dsn = 'mysql:host=' . self::$db_host . ';'
            . 'dbname=' . self::$db_name;

        try {
            $this->conn = new PDO($dsn, self::$db_user, self::$db_pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
            return $this->conn;
        } catch (PDOException $e) {
            printf("Conexión fallida:%s\n", $e->getMessage());
            exit();
        }
    }
    //Metodo que devuelve el último id introducido
    public function lastInsert()
    {
        return $this->conn->lastInsertId();
    }
    private function close_connection()
    {
        $this->conn = null;
    }
    protected function get_results_from_query() 
    {
      $this->open_connection();
      $_result = false;
      if (($_stmt = $this->conn->prepare($this->query))) {
         if (preg_match_all('/(:\w+)/', $this->query, $_named, PREG_PATTERN_ORDER)) {
            $_named = array_pop($_named);
            foreach ($_named as $_param) {
               $_stmt->bindValue($_param, $this->parametros[substr($_param, 1)]);
            }
         }

      try {
         if (! $_stmt->execute()) {
            printf("Error de consulta: %s\n", $_stmt->errorInfo()[2]);
         }
         //$_result = $_stmt->fetchAll(PDO::FETCH_ASSOC);
         $this->rows = $_stmt->fetchAll(PDO::FETCH_ASSOC);
         $_stmt->closeCursor();
      } 
      catch(PDOException $e){
            printf("Error en consulta: %s\n" , $e->getMessage());
      }
    }

    //return $_result;
   }
}
