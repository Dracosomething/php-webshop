<?php 
include_once(__DIR__ . "/../database/Database.class.php");
include_once(__DIR__ . "/../helpers/array.helper.php");


try {
    $ArrayHelper = new ArrayHelper();
    $dbconn = new Database(); // conects to the database

    if ($ArrayHelper->anyNotSetOrEmpty($_POST)) { // checks if any of the variables are set
        $errorMsg = "value was invalid";
        header('Location: ../../index.php'); // redirects us back to the index page
        exit(); // stops the rest of the code from running
    }

    

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}