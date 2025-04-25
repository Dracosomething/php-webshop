<?php
class DescriptionHelper {
    public function writeShortDescription(string $description) {
        return substr($description,0,60) . "...";
    }
}