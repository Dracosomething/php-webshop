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

    public function querySql(string $sql, array $params = []): array {
        $query = $this->prepare($sql);
        $query->execute($params);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function select(string $table, array $selectors = ["*"], array $conditions = [], array $params = []): array {
        $ArrayHelper = new ArrayHelper();
        $selectString = $ArrayHelper->arrayToString($selectors);
        $conditionString = $ArrayHelper->arrayToString($conditions);
        $sql = "SELECT $selectString FROM $table WHERE $conditionString";
        return $this->querySql($sql, $params);
    }

    public function insert(string $table, array $values, array $columns, array $params = []): array {
        $ArrayHelper = new ArrayHelper();
        $columnString = $ArrayHelper->arrayToString($columns);
        $valueString = $ArrayHelper->arrayToString($values);
        $sql = "INSERT INTO $table($columnString) VALUES ($valueString)";
        return $this->querySql($sql, $params);
    }
}