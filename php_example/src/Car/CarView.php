<?php
require_once(__DIR__.'/Car.php');
require_once(__DIR__.'/../Utilitaries/functions.php');
class CarView
{
    public function __construct()
    {

    }

    public function printCarList($pCarArray)
    {
        echo '<ul id="carlist">';
        foreach($pCarArray as &$car)
        {
            echo 
            '<li>'.
            'Car ('.
            $car->getId().','
            .$car->getColor().','
            ._bool($car->isBroken()).
            ')</li>';
        }
        echo '</ul>';
    }
}
?>