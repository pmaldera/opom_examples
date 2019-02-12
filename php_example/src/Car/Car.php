<?php

declare(strict_types=1); // On suit les types annoncés.

class Car
{
    private $id;
    private $color;
    private $broken;
    
    public function __construct() {
        $this->id = -1;
        $this->color = "incolore";
        $this->broken = false;
    }

    /* En php on ne peut pas faire plusieurs constructeur, on fait donc des méthodes statiques
    * pour avoir plusieurs constructeurs
    */
    public static function create(int $pId, string $pColor, bool $pBroken)
    {
        $instance = new self();
        $instance->setId($pId);
        $instance->setColor($pColor);
        $instance->setBroken($pBroken);
        return $instance;
    }

    public function getId(){
        return $this->id;
    }

    public function setId(int $pId)
    {
        $this->id = $pId;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setColor(string $pColor)
    {
        $this->color = $pColor;
    }

    public function isBroken()
    {
        return $this->broken;
    }

    public function setBroken(bool $pBroken = true) // paramètre facultatif, true si on ne le spécifie pas
    {
        $this->broken = $pBroken;
    }
}