<?php
include_once(__DIR__ . "/../database/Database.class.php");
include_once(__DIR__ . "/login.helper.php");

class CartHelper {
    private Database $dbconn;
    private LoginHelper $login;

    public function __construct(Database $dbconn) {
        $this->dbconn = $dbconn;
        $this->login = new LoginHelper();
    }

    public function getCart(): array {
        $userID = $this->login->getUser()["ID"];
        $card = $this->dbconn->select("carts", ["*"], ["customer_id = :CustomerID"], [":CustomerID" => $userID]);
        return $card;
    }

    public function doesCartExist() {
        
    }
}