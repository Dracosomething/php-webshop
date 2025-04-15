<?php
include("../../../../pass.php");

class Database extends PDO {
    public function __construct() {
        parent::__construct("mysql:host=".pass::$host."; dbname=".pass::$dbname."; charset=utf8", pass::$user, pass::$pass);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}