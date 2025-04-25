<?php
class PriceHelper
{
    public function parseFloatToPrice($float)
    {
        $stringFloat = (string) $float;
        if (!str_contains($stringFloat, ".")) {
            $stringFloat .= ",-";
        }
        $stringFloat = str_replace(".", ",", $stringFloat);
        $decimals = preg_split("/,/", $stringFloat);
        $decimals = (string) $decimals[1];
        if (!str_ends_with($decimals, "0") && !str_ends_with($decimals, "-") && strlen($decimals) < 2) {
            $stringFloat .= "0";
        }
        return $stringFloat;
    }
}