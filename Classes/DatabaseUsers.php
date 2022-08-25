<?php
require_once __DIR__ . "/DatabaseConnection.php";
require_once __DIR__ . "/User.php";


class DatabaseUsers extends DatabaseConnection
{

    public function add_user(User $user)
    {
        $query = "INSERT INTO users (username, password_hash) VALUES (?, ?)";

        $stmt = mysqli_prepare($this->conn, $query);

        $username = $user->username;
        $password_hash = $user->get_password_hash();

        $stmt->bind_param("ss", $username, $password_hash);

        $success = $stmt->execute();
        $user_id = $this->conn->insert_id;

        if ($success) {
            return $user_id;
        } else {
            return false;
        }
    }

    public function get_all()
    {
        $query = "SELECT * FROM `users`; ";
        $result = mysqli_query($this->conn, $query);

        $db_users = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $users = [];

        foreach ($db_users as $db_user) {
            $username = $db_user["username"];
            $role = $db_user["role"];
            $id = $db_user["id"];

            $users[] = new User($username, $role, $id);
        }
        return $users;
    }

    public function get_all_regular_users()
    {
        $query = 'SELECT * FROM `users` WHERE `role` != "admin"; ';
        $result = mysqli_query($this->conn, $query);

        $db_users = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $regular_users = [];

        foreach ($db_users as $db_user) {
            $username = $db_user["username"];
            $role = $db_user["role"];
            $id = $db_user["id"];

            $regular_users[] = new User($username, $role, $id);
        }
        return $regular_users;
    }

    public function get_one_by_id($id)
    {
        $query = "SELECT * FROM users WHERE `users`.`id` = ? ";

        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $db_user = mysqli_fetch_assoc($result);

        $user = new User($db_user["username"], $db_user["role"], $db_user['id']);
        return $user;
    }

    public function get_one_by_username($username)
    {
        $query = "SELECT * FROM users WHERE username = ?";

        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();
        $db_user = mysqli_fetch_assoc($result);
        $user = null;

        if ($db_user) {
            $user = new User($username, $db_user["role"], $db_user['id']);
            $user->set_password_hash($db_user['password_hash']);
        }
        return $user;
    }

    public function get_google_user(User $user)
    {
        $db_user = $this->get_one_by_username($user->username);

        if ($db_user === null) {
            $query = "INSERT INTO users (username) VALUES ( ?)";

            $stmt = mysqli_prepare($this->conn, $query);
            $username = $user->username;

            $stmt->bind_param("s", $username);
            $success = $stmt->execute();

            if ($success) {
                $user = $this->get_one_by_id($stmt->insert_id);
            } else {

                var_dump($stmt->error);
                die("Error");
            }
        } else {
            $user = $db_user;
        }

        return $user;
    }

    public function update_user(User $user)
    {
        $query = "UPDATE `users` SET `username` = ?, `role` = ? WHERE `users`.`id` = ? ";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("ssi", $user->username, $user->role, $user->id);

        return $stmt->execute();
    }

    public function update_my_username(User $user, $id)
    {
        $query = "UPDATE `users` SET `username` = ? WHERE `users`.`id` = ?";

        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("si", $user->username, $id);

        return $stmt->execute();
    }

    public function update_password($new_password_hash, $id)
    {
        $query = "UPDATE `users` SET `password_hash` = ? WHERE `users`.`id` = ? ";
        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("si", $new_password_hash, $id);

        return $stmt->execute();
    }

    public function delete_user($id)
    {
        $query = "DELETE FROM users WHERE id = ?";

        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param('i', $id);

        return $stmt->execute();
    }
}
