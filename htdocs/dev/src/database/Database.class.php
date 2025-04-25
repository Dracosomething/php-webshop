<?php
// include("../../../../pass.php");

class Database extends PDO
{
    public static $host = "localhost";
    public static $pass = "";
    public static $user = "root";
    public static $dbname = "stoelensleepers";
    public function __construct()
    {
        parent::__construct("mysql:host=" . $this::$host . "; dbname=" . $this::$dbname . "; charset=utf8", $this::$user, $this::$pass);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function select($sql) {
        $query = $this->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}