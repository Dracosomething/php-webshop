<?php
include_once(__DIR__ . "/../database/Database.class.php");
include_once(__DIR__ . "/login.helper.php");

class Cartelper {
    private Database $dbconn;
    private LoginHelper $login;

    public function __construct(Database $dbconn) {
        $this->dbconn = $dbconn;
        $this->login = new LoginHelper();
    }

    public function getCart(): array {
        $userID = $this->login->getUser()["ID"];
        $cart = $this->dbconn->select("carts", ["*"], ["customer_id = :CustomerID", ""], [":CustomerID" => $userID]);
        return $cart;
    }

    public function doesCartExist(): bool {
        $userID = $this->login->getUser()["ID"];
        $cart = $this->dbconn->select("carts", ["id"], [
            "customer_id = :CustomerID", 
            "ordered = 0"], 
            [":CustomerID" => $userID]);
        return is_null($cart) || empty($cart);
    }

    public function getCartItems(): array {
        $cart = $this->getCart();
    }
}