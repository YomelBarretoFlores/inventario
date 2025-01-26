<?php
class Database {
    public static $db;
    public static $con;
    private $host;
    private $user;
    private $pass;
    private $ddbb;

    function __construct() {
        $this->host = "localhost"; // Servidor de la base de datos
        $this->user = "root";      // Usuario por defecto de MySQL en XAMPP
        $this->pass = "";          // Contraseña vacía por defecto
        $this->ddbb = "inventiolite"; // Nombre de la base de datos
    }

    function connect() {
        $con = new mysqli($this->host, $this->user, $this->pass, $this->ddbb);
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }
        $con->query("set sql_mode=''");
        return $con;
    }

    public static function getCon() {
        if (self::$con == null && self::$db == null) {
            self::$db = new Database();
            self::$con = self::$db->connect();
        }
        return self::$con;
    }
}
?>
