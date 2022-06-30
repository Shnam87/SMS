<?php
require_once __DIR__ . "/DatabaseConnection.php";
require_once __DIR__ . "/Support.php";

class DatabaseSupport extends DatabaseConnection
{
    public function save_contact(Support $support)
    {
        $query = "INSERT INTO `support` (`user_id`, `sent_by`, `message`) VALUES (?, ?, ?);";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("iss", $support->user_id, $support->sent_by, $support->message);
        $success = $stmt->execute();

        $contact_id = ($this->conn->insert_id);

        if ($success) {
            return $contact_id;
        } else {
            return false;
        }
    }

    public function get_all()
    {
        /*
        $query = "SELECT support.`id`, `user_id`, users.`username`, `sent_by`, `message`, `date` 
                    FROM support JOIN users ON users.`id` = support.`user_id`; ";
        
        $query = 
        "SELECT support.`id` as `support_id`, `user_id`, users.`username`, `sent_by`, `message`, `date` 
        FROM support JOIN users ON users.`id` = support.`user_id`;";
        */

        $query = "SELECT support.`id` as `support_id`, `user_id`, 
                    users.`username` as `user`, `sent_by`, `message`, `date` 
                    FROM support JOIN users ON users.`id` = support.`user_id`;";
        $result = mysqli_query($this->conn, $query);
        $db_supports = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $supports = [];

        foreach ($db_supports as $db_support) {
            $db_support_id = (int)$db_support[`support_id`];
            $db_support_user_id = (int)$db_support[`user_id`];
            $db_support_sent_by = $db_support[`sent_by`];
            $db_support_message = $db_support[`message`];
            $db_support_date = $db_support[`date`];

            $support = new Support(
                $db_support_user_id,
                $db_support_sent_by,
                $db_support_message,
                $db_support_date,
                $db_support_id
            );

            $supports[] = $support;
        }
        return $supports;
    }

    public function get_all_by_user_id($user_id)
    {
        $query = "SELECT * FROM `support` WHERE `user_id` = ? ORDER BY support.`id` DESC ";

        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        $result = $stmt->get_result();
        $messages = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $messages;
    }
}
