<?php

class Support
{
    public $id;
    public $user_id;
    public $sent_by;
    public $message;
    public $date;

    public function __construct($user_id, $sent_by, $message, $date = false, $id = 0)
    {
        if ($date) {
            $this->date = $date;
        }

        if ($id > 0) {
            $this->id = $id;
        }

        $this->user_id = $user_id;
        $this->sent_by = $sent_by;
        $this->message = $message;
    }
}
