<?php
class ArrayHelper
{
    public function arrayToString(array $array): string
    {
        $returnVal = "";
        foreach ($array as $val) {
            if (is_array($val)) {
                $returnVal .= $this->arrayToString($val);
            } else {
                $returnVal .= $val;
                if (next($array) != null) {
                    $returnVal .= ", ";
                }
            }
        }
        return $returnVal;
    }

    public function anyNotSetOrEmpty(array $array): bool
    {
        $returnVal = false;
        foreach ($array as $value) {
            $returnVal = !isset($value) || empty($value);
        }
        return $returnVal;
    }

    public function stringToArray(string $string): array
    {
        $string = str_replace("[", "", $string);
        $string = str_replace("]", "", $string);
        return preg_split("/, /", $string);
    }
}