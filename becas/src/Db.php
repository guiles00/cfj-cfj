<?php 
class Db
{
   private static $instancia;
   private $connection;
   

   private function __construct()
   {
      //@TODO traer de archivo de configuracion
      $username = "guiles";
      $password = "guiles";
      $hostname = "localhost";
      $dbname = "sitio_cfj";
 //     $dbname = "uv_test";

      $this->connection = mysqli_connect($hostname,$username,$password,$dbname);
      mysqli_set_charset($this->connection, 'utf8');
      
      // Check connection
      if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }

      return $this->connection;
   }

   public static function getInstance()
   {
      if (  !self::$instancia instanceof self)
      {
         self::$instancia = new self;
      }
      return self::$instancia;
   }
   
   public function getConnection()
   {
      return $this->connection;
   }
   
   public function exec_query($query)
   {
      
      $result =  mysqli_query($this->connection,$query);

      //check for error
      if (!$result)
      {
         echo mysqli_error($this->connection);
         return $result;
      }

      return $result;
   }
}
?>
