<?php
include_once(__DIR__ . "/../database/Database.class.php");

class CardHelper {
    private Database $dbconn;

    public function __construct(Database $dbconn) {
        $this->dbconn = $dbconn;
    }

    
}