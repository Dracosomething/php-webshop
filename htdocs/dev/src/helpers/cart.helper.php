<?php
include_once(__DIR__ . "/../database/Database.class.php");
include_once(__DIR__ . "/login.helper.php");
include_once(__DIR__ . "/price.helper.php");

class Carthelper
{
    // attributes
    private Database $dbconn;
    private LoginHelper $login;
    private PriceHelper $PriceHelper;

    /**
     * constructs a new CartHelper
     * @param Database $dbconn makes sure we dont have 2 connections open to the database
     */
    public function __construct(Database $dbconn)
    {
        $this->dbconn = $dbconn; // assigns the connection
        $this->login = new LoginHelper(); // constructs a new LoginHelper
        $this->PriceHelper = new PriceHelper();
    }

    /**
     * grabs the current users cart
     * @return array the carts data
     */
    public function getCart(): array
    {
        if (!$this->login->isLoggedIn() || !$this->doesCartExist())
            return [];
        $userID = $this->login->getUser()["ID"]; // grabs the current users id
        if (is_null($userID) || is_nan($userID) || empty($userID) || !isset($userID))
            return []; // makes sure the user id exists
        $cart = $this->dbconn->select(
            "carts", // grabs the cart associated with the user
            ["*"],
            ["customer_id = :CustomerID", ""],
            [":CustomerID" => $userID]
        );
        return $cart[0];
    }

    /**
     * checks if the current user already has a cart
     * @return bool if the user has a cart
     */
    public function doesCartExist(): bool
    {
        if (!$this->login->isLoggedIn())
            return false;
        $userID = $this->login->getUser()["ID"]; // grabs the current users id
        if (is_null($userID) || is_nan($userID) || empty($userID) || !isset($userID))
            return false; // makes shure the user id exists
        $cart = $this->dbconn->select(
            "carts", // grabs the current users cart
            ["ID"],
            [
                "customer_id = :CustomerID",
                "ordered = 0"
            ],
            [":CustomerID" => $userID]
        );
        return (!is_null($cart) || !empty($cart)) && sizeof((array) $cart) > 0; // checks if the cart is not null or empty;
    }

    /**
     * gets the current users items in their cart
     * @return array an array of all items the current user has in their cart
     */
    public function getCartItems(): array
    {
        $cartID = $this->getCartID(); // grabs the current carts id
        if (is_null($cartID) || is_nan($cartID) || empty($cartID) || !isset($cartID) || $cartID === 0)
            return []; // checks if the id exists
        $items = $this->dbconn->select(
            "cart_items", // selects the items in the "cart_items" table where the "order_id" column is the same aas the current carts id
            ["*"],
            ["order_id = :id"],
            [":id" => $cartID]
        );
        foreach ($items as $item) {
            $product = $this->dbconn->select(
                "products", // selects the items in the "cart_items" table where the "order_id" column is the same aas the current carts id
                ["*"],
                ["ID = :id"],
                [":id" => $item["product_id"]]
            );
            $index = array_search($item, $items);
            if (!is_null($product[0]) || !empty($product[0])) 
                $item["product"] = $product[0];
            else 
                $item["product"] = $product;
            $items[$index] = $item;
        }
        return $items;
    }

    /**
     * gets the current users cart id
     * @return int the id of the cart or 0 if they dont have a cart
     */
    public function getCartID(): int
    {
        if (!$this->doesCartExist())
            return 0; // checks if the current user has a cart
        $cart = $this->getCart(); // grabs the current users cart
        if (!key_exists("ID", $cart))
            return 0;
        $cartID = $cart["ID"]; // grabs the current carts "ID" value
        return $cartID;
    }

    /**
     * gets the current users cart including produts
     * @return array an array of everything the current users cart has
     */
    public function getFullCart(): array
    {
        if (!$this->doesCartExist())
            return []; // checks if the current user has a cart
        $cart = $this->getCart(); // grabs the current users cart
        $cart["items"] = $this->getCartItems(); // adds the current users cart items to the array under the "items" key
        return $cart;
    }

    /**
     * gets the current users cart size
     * @return int the size of the cart
     */
    public function getCartSize(): int
    {
        $amount = 0; // defaults to 0

        if ($this->login->isLoggedIn()) { // makes sure the user is logged in
            $items = $this->getCartItems(); // grabs all items in the cart

            foreach ($items as $item) {
                $amount += $item["amount"]; // increments the amount by 1 for every item in the cart
            }
        }

        return $amount;
    }

    public function getCartPrize(): string
    {
        $price = 0;

        if ($this->login->isLoggedIn()) { // makes sure the user is logged in
            $items = $this->getCartItems(); // grabs all items in the cart


            foreach ($items as $item) {
                for ($i = 1; $i <= $item["amount"]; $i++) {
                    $price += $item["product"]["price"];
                }
            }
        }


        $priceString = $this->PriceHelper->parseFloatToPrice($price);
        return $priceString;
    }
}