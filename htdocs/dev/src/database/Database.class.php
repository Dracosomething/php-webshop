<?php
// include("../../../../pass.php");
include_once(__DIR__ . "/../helpers/array.helper.php");
class Database extends PDO
{
    // database values
    private $host = "localhost";
    private $pass = "";
    private $user = "root";
    private $dbname = "stoelensleepers";

    public function __construct()
    {
        // constructs a new PDO with our values
        parent::__construct("mysql:host=" . $this->host . "; dbname=" . $this->dbname . "; charset=utf8", $this->user, $this->pass);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Runs some sql code on the database.
     * @param string $sql the string with the sql code that should be executed on the database
     * @param array $params parameters that need to be used in the sql code
     * @return array the data that the sql targeted
     */
    public function runSql(string $sql, array $params = []): array
    {
        $query = $this->prepare($sql); // prepares our sql code
        $query->execute($params); // executes the sql code on the database with our provided parameters
        return $query->fetchAll(PDO::FETCH_ASSOC); // fetches the data from the database
    }

    /**
     * Used to grab some data from the database
     * @param string $table the name of the targeted table
     * @param array $selectors the columns that should be selected - defaults to selecting everything
     * @param array $conditions the conditions that the data should abide to - defaults to an empty array
     * @param array $params the required parameters - defaults to an empty array 
     * @return array the data selected from the array
     */
    public function select(string $table, array $selectors = ["*"], array $conditions = [], array $params = []): array
    {
        $ArrayHelper = new ArrayHelper(); // constructs a new array helper
        // converts the selectors and conditions to a string
        $selectString = $ArrayHelper->arrayToString($selectors);
        $sql = "SELECT $selectString FROM $table";
        if (!empty($conditions)) {
            $conditionString = $ArrayHelper->arrayToString($conditions);
            $conditionString = str_replace(",", " AND", $conditionString); // makes sure every , becomes AND
            $sql .= " WHERE $conditionString";
        }

        // creates our sql statement
        return $this->runSql($sql, $params); // runs our sql code on the database
    }

    /**
     * insert new data into the database
     * @param string $table the name of the targeted table
     * @param array $values the values to be added
     * @param array $columns the targeted columns
     * @param array $params the paramenters required for the sql code - defaults to an empty array
     * @return array the updated data
     */
    public function insert(string $table, array $data, array $params = []): array
    {
        $ArrayHelper = new ArrayHelper(); // constructs a new array helper
        $array = $ArrayHelper->splitArrayKeysAndValues($data); // splits the data
        $columns = $array["keys"]; // grabs the keys
        $values = $array["values"]; // grabs the values
        // converts the columns array and the values array to strings
        $columnString = $ArrayHelper->arrayToString($columns);
        $valueString = $ArrayHelper->arrayToString($values);

        $sql = "INSERT INTO $table($columnString) VALUES ($valueString)"; // creates the sql statement

        return $this->runSql($sql, $params); // runs our sql statement
    }

    /**
     * Updates the database by changing data currently in the database
     * @param string $table - the name of the targeted table
     * @param array $data - the data to be updated
     * @param array $conditions - the conditions that the data should abide to - defaults to an empty array
     * @param array $params the required parameters - defaults to an empty array 
     * @return array the updates data
     */
    public function update(string $table, array $data = [], array $conditions = [], array $params = []): array
    {
        $ArrayHelper = new ArrayHelper(); // constructs a new array helper
        $dataString = $ArrayHelper->arrayToString($data); // converts the data to a string
        $dataString = str_replace(",", " AND", $dataString); // makes sure every " ," becomes " AND"

        $conditionString = $ArrayHelper->arrayToString($conditions); // converts the conditions to a string
        $conditionString = str_replace(",", " AND", $conditionString); // makes sure every " ," becomes " AND"

        $sql = "UPDATE $table SET $dataString WHERE $conditionString"; // creates the sql statement

        return $this->runSql($sql, $params);
    }

    /**
     * Remove data from the database
     * @param string $table - the name of the targeted table
     * @param array $conditions - the conditions for what should get removed
     * @param array $params the required parameters - defaults to an empty array 
     * @return array the updated data - probably an empty array
     */
    public function remove(string $table, array $conditions, array $params = []): array
    {
        $ArrayHelper = new ArrayHelper(); // creates a new array helper
        $conditionString = $ArrayHelper->arrayToString($conditions); // converts the conditions to a string
        $conditionString = str_replace(",", " AND", $conditionString); // makes sure every " ," becomes " AND"

        $sql = "DELETE FROM $table WHERE $conditionString"; // creates the sql code

        return $this->runSql($sql, $params);
    }
}