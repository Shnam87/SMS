<?php

class Order
{
    public $id;
    public $user_id;
    public $status;
    public $date;

    public function __construct($user_id, $date, $status, $id = 0)
    {
        if ($id > 0){
            $this->id = $id;
        }

        if($status != null){
            $this->status = $status;
        }

        $this->user_id = $user_id;
        $this->date = $date;
    }

    public function __toString()
    {
        return "{$this->user_id}, {$this->status}, {$this->date}";
    }
}

class Status
{
    public $id;
    public $status;

    public function __construct($status, $id = 0)
    {
        if($id > 0){
            $this->id = $id;
        }

        $this->status = $status;
    }

    public function __toString()
    {
        return "{$this->id} | {$this->status}";
    }
}
