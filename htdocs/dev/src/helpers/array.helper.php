<?php
class ArrayHelper
{
    /**
     * Converts an array to a string usable in sql statements
     * @param array $array the target array
     * @return string the array converted to a string
     */
    public function arrayToString(array $array): string
    {
        $returnVal = "";
        foreach ($array as $val) { // loop through all values in the array
            if (is_array($val)) { // checks if the value is an array
                $returnVal .= $this->arrayToString($val); // calls this method on the array
            } else {
                $returnVal .= $val; // add our value to the string
                if (next($array) != null) { // checks if the next item isnt null
                    $returnVal .= ", "; // adds ", " to the end
                }
            }
        }
        return $returnVal;
    }

    /**
     * Checks if any value in the targeted array is not set or is empty
     * @param array $array the target array
     * @return bool false if the array has a value that is not set or is empty
     */
    public function anyNotSetOrEmpty(array $array): bool
    {
        $returnVal = false;
        foreach ($array as $value) {
            $returnVal = !isset($value) || empty($value); // sets the return value to if the array is not set or is empty
            if (!$returnVal) { // checks if the return value is false
                break; // stops the loop
            }
        }
        return $returnVal;
    }

    /**
     * convert a string to an array, string has to be formatted like a string returned from the ArrayHelper->arrayToString() method
     * @param string $string the target string
     * @return array the array from the string
     */
    public function stringToArray(string $string): array
    {
        $string = str_replace("[", "", $string); // replaces the "[" if present
        $string = str_replace("]", "", $string); // replaces the "]" if present
        return preg_split("/, /", $string); // splits the string by ", " 
    }

    /**
     * splits an array into a 2D array that contains the values of the array using the "values" key and the keys of the array using the "keys" key
     * @param array $array the array that should get split
     * @return array{keys: array, values: array} the split array, "keys" is the key for the arrays keys, "values" is the key for the values
     */
    public function splitArrayKeysAndValues(array $array): array
    {
        $values = array_values($array); // grabs the arrays values
        $keys = array_keys($array); // grabs the arrays keys
        $returnVal = [ // constructs the array
            "values" => $values,
            "keys" => $keys
        ];
        return $returnVal;
    }
}