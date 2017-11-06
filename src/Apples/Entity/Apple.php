<?php

namespace App\Apples\Entity;

class Apple
{
    protected $id;

    protected $variety;

    protected $price;

    public function __construct($id, $variety, $price)
    {
        $this->id = $id;
        $this->variety = $variety;
        $this->price = $price;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setVariety($variety)
    {
        $this->variety = $variety;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getVariety()
    {
        return $this->variety;
    }
    public function getPrice()
    {
        return $this->price;
    }

    public function toArray()
    {
        $array = array();
        $array['id'] = $this->id;
        $array['price'] = $this->price;
        $array['variety'] = $this->variety;

        return $array;
    }
}
