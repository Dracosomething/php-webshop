<?php
class PriceHelper
{
    /**
     * converts a rounded float into a price by properly formatting it.
     * @param float $float The price float
     * @return string the converted float
     */
    public function parseFloatToPrice(float $float)
    {
        $stringFloat = (string) $float; // converts the given float to a string
        if (!str_contains($stringFloat, ".")) { // checks if the string does not contain a dot
            $stringFloat .= ",-"; // adds ",-" to the providen price
        }
        $stringFloat = str_replace(".", ",", $stringFloat); // replaces the dot with a comma
        $decimals = preg_split("/,/", $stringFloat); // splits the price into an array with 2 string by the comma
        $decimals = (string) $decimals[1]; // gets the second string and parses to a strring to be shure
        if (!str_ends_with($decimals, "0") && !str_ends_with($decimals, "-") 
            && strlen($decimals) < 2) { // checks if the decimals dont end in a 0, - and has a length bellow 2
            $stringFloat .= "0"; // adds a 0 to the end of the price
        }
        return $stringFloat; // returns the price
    }
}