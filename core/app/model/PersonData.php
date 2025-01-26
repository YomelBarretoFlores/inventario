<?php
class PersonData {
    public static $tablename = "person";

    // Constructor actualizado para PHP moderno
    public function __construct() {
        $this->name = "";
        $this->lastname = "";
        $this->email = "";
        $this->image = "";
        $this->password = "";
        $this->created_at = date("Y-m-d H:i:s"); // Inicializa con la fecha y hora actual
    }

    public function add_client() {
        $sql = "INSERT INTO " . self::$tablename . " (name, lastname, address1, email1, phone1, kind, created_at) ";
        $sql .= "VALUES (\"" . addslashes($this->name) . "\", \"" . addslashes($this->lastname) . "\", \"" . addslashes($this->address1) . "\", \"" . addslashes($this->email1) . "\", \"" . addslashes($this->phone1) . "\", 1, \"" . $this->created_at . "\")";
        Executor::doit($sql);
    }

    public function add_provider() {
        $sql = "INSERT INTO " . self::$tablename . " (name, lastname, address1, email1, phone1, kind, created_at) ";
        $sql .= "VALUES (\"" . addslashes($this->name) . "\", \"" . addslashes($this->lastname) . "\", \"" . addslashes($this->address1) . "\", \"" . addslashes($this->email1) . "\", \"" . addslashes($this->phone1) . "\", 2, \"" . $this->created_at . "\")";
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
        $sql = "UPDATE " . self::$tablename . " SET name=\"" . addslashes($this->name) . "\", email1=\"" . addslashes($this->email1) . "\", address1=\"" . addslashes($this->address1) . "\", lastname=\"" . addslashes($this->lastname) . "\", phone1=\"" . addslashes($this->phone1) . "\" WHERE id=$this->id";
        Executor::doit($sql);
    }

    public function update_client() {
        $sql = "UPDATE " . self::$tablename . " SET name=\"" . addslashes($this->name) . "\", email1=\"" . addslashes($this->email1) . "\", address1=\"" . addslashes($this->address1) . "\", lastname=\"" . addslashes($this->lastname) . "\", phone1=\"" . addslashes($this->phone1) . "\" WHERE id=$this->id";
        Executor::doit($sql);
    }

    public function update_provider() {
        $sql = "UPDATE " . self::$tablename . " SET name=\"" . addslashes($this->name) . "\", email1=\"" . addslashes($this->email1) . "\", address1=\"" . addslashes($this->address1) . "\", lastname=\"" . addslashes($this->lastname) . "\", phone1=\"" . addslashes($this->phone1) . "\" WHERE id=$this->id";
        Executor::doit($sql);
    }

    public function update_passwd() {
        $sql = "UPDATE " . self::$tablename . " SET password=\"" . addslashes($this->password) . "\" WHERE id=$this->id";
        Executor::doit($sql);
    }

    public static function getById($id) {
        $sql = "SELECT * FROM " . self::$tablename . " WHERE id=$id";
        $query = Executor::doit($sql);
        $found = null;
        $data = new PersonData();
        while ($r = $query[0]->fetch_array()) {
            $data->id = $r['id'];
            $data->name = $r['name'];
            $data->lastname = $r['lastname'];
            $data->address1 = $r['address1'];
            $data->phone1 = $r['phone1'];
            $data->email1 = $r['email1'];
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
            $array[$cnt] = new PersonData();
            $array[$cnt]->id = $r['id'];
            $array[$cnt]->name = $r['name'];
            $array[$cnt]->lastname = $r['lastname'];
            $array[$cnt]->email1 = $r['email1'];
            $array[$cnt]->phone1 = $r['phone1'];
            $array[$cnt]->address1 = $r['address1'];
            $array[$cnt]->created_at = $r['created_at'];
            $cnt++;
        }
        return $array;
    }

    public static function getClients() {
        $sql = "SELECT * FROM " . self::$tablename . " WHERE kind=1 ORDER BY name, lastname";
        $query = Executor::doit($sql);
        $array = array();
        $cnt = 0;
        while ($r = $query[0]->fetch_array()) {
            $array[$cnt] = new PersonData();
            $array[$cnt]->id = $r['id'];
            $array[$cnt]->name = $r['name'];
            $array[$cnt]->lastname = $r['lastname'];
            $array[$cnt]->email1 = $r['email1'];
            $array[$cnt]->phone1 = $r['phone1'];
            $array[$cnt]->address1 = $r['address1'];
            $array[$cnt]->created_at = $r['created_at'];
            $cnt++;
        }
        return $array;
    }

    public static function getProviders() {
        $sql = "SELECT * FROM " . self::$tablename . " WHERE kind=2 ORDER BY name, lastname";
        $query = Executor::doit($sql);
        $array = array();
        $cnt = 0;
        while ($r = $query[0]->fetch_array()) {
            $array[$cnt] = new PersonData();
            $array[$cnt]->id = $r['id'];
            $array[$cnt]->name = $r['name'];
            $array[$cnt]->lastname = $r['lastname'];
            $array[$cnt]->email1 = $r['email1'];
            $array[$cnt]->phone1 = $r['phone1'];
            $array[$cnt]->address1 = $r['address1'];
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
            $array[$cnt] = new PersonData();
            $array[$cnt]->id = $r['id'];
            $array[$cnt]->name = $r['name'];
            $array[$cnt]->email1 = $r['email1'];
            $array[$cnt]->created_at = $r['created_at'];
            $cnt++;
        }
        return $array;
    }
}
?>
