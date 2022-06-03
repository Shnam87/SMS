<?php

class Product
{

    public $id;
    public $title;
    public $description;
    public $price;

    public function __construct($title, $description, $price, $id = 0)
    {
        if ($id > 0) {
            $this->id = $id;
        }

        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
    }

    public function __toString()
    {
        return "{$this->title}, {$this->description}, {$this->price}";
    }
}
