<?php
class DescriptionHelper
{

    /**
     * Method shortens the provided @var description to a length of 60 characters,
     * 
     * NOTE: spaces are included in the length of @var description
     * @param string $description the long format descriptions
     * @return string the shortened description
     */
    public function writeShortDescription(string $description): string
    {
        $shortDesc = substr($description, 0, 60); // shortens the given description to 60 characters !SPACES ARE INCLUDED IN THE LENGTH!
        $shortDesc .= "..."; // adds ... to the end of the description
        return $shortDesc; // returns the description
    }
}