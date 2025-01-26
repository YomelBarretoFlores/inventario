<?php
class CategoryData {
    public static $tablename = "category";

    // Constructor actualizado para versiones modernas de PHP
    public function __construct() {
        $this->name = "";
        $this->lastname = "";
        $this->email = "";
        $this->image = "";
        $this->password = "";
        $this->created_at = date("Y-m-d H:i:s"); // Inicializa con la fecha y hora actuales
    }

    public function add() {
        // Escapar valores para evitar problemas de inyección SQL
        $name = addslashes($this->name);
        $sql = "INSERT INTO " . self::$tablename . " (name, created_at) ";
        $sql .= "VALUES (\"$name\", \"$this->created_at\")";
        Executor::doit($sql);
    }

    public static function delById($id) {
        $sql = "DELETE FROM " . self::$tablename . " WHERE id=$id";
        Executor::doit($sql);
    }

    public function del() {
        $sql = "DELETE FROM " . self::$tablename . " WHERE id=$this->id";
        Executor::doit($sql);
    }

    public function update() {
        // Escapar valores para evitar problemas de inyección SQL
        $name = addslashes($this->name);
        $sql = "UPDATE " . self::$tablename . " SET name=\"$name\" WHERE id=$this->id";
        Executor::doit($sql);
    }

    public static function getById($id) {
        $sql = "SELECT * FROM " . self::$tablename . " WHERE id=$id";
        $query = Executor::doit($sql);
        $found = null;
        $data = new CategoryData();
        while ($r = $query[0]->fetch_array()) {
            $data->id = $r['id'];
            $data->name = $r['name'];
            $data->created_at = $r['created_at'];
            $found = $data;
            break;
        }
        return $found;
    }

    public static function getAll() {
        $sql = "SELECT * FROM " . self::$tablename;
        $query = Executor::doit($sql);
        $array = array();
        $cnt = 0;
        while ($r = $query[0]->fetch_array()) {
            $array[$cnt] = new CategoryData();
            $array[$cnt]->id = $r['id'];
            $array[$cnt]->name = $r['name'];
            $array[$cnt]->created_at = $r['created_at'];
            $cnt++;
        }
        return $array;
    }

    public static function getLike($q) {
        $sql = "SELECT * FROM " . self::$tablename . " WHERE name LIKE '%$q%'";
        $query = Executor::doit($sql);
        $array = array();
        $cnt = 0;
        while ($r = $query[0]->fetch_array()) {
            $array[$cnt] = new CategoryData();
            $array[$cnt]->id = $r['id'];
            $array[$cnt]->name = $r['name'];
            $array[$cnt]->created_at = $r['created_at'];
            $cnt++;
        }
        return $array;
    }
}
?>
