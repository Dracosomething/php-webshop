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
        if (!str_ends_with($stringFloat, "0") && !str_ends_with($stringFloat, "-")) {
            $stringFloat .= "0";
        }
        return $stringFloat;
    }
}