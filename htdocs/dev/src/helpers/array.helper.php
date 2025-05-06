<?php
class ArrayHelper {
    public function arrayToString(array $array): string {
        $returnVal = "";
        foreach ($array as $val) {
            $returnVal .= $val;
            if (next($array) != null) {
                $returnVal .= ", ";
            }
        }
        return $returnVal;
    }
}