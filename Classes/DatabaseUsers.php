<?php
require_once __DIR__ . "/DatabaseConnection.php";
require_once __DIR__ . "/User.php";


class DatabaseUsers extends DatabaseConnection{

    public function addUser(User $user)
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

    public function getUser($username)
    {
        $query = "SELECT * FROM users WHERE username = ?";

        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();
        $db_user = mysqli_fetch_assoc($result);
        $user = null;

        if ($db_user) {
            $user = new User($username, $db_user['id']);
            $user->set_password_hash($db_user['password_hash']);
        }
        return $user;
    }

    public function getGoogleUser(User $user)
    {
        $db_user = $this->getUser($user->username);

        if ($db_user === null) {
            $query = "INSERT INTO users (username) VALUES ( ?)";

            $stmt = mysqli_prepare($this->conn, $query);
            $username = $user->username;

            $stmt->bind_param("s", $username);
            $success = $stmt->execute();

            if ($success) {

                $user->id = $stmt->insert_id;
            } else {

                var_dump($stmt->error);
                die("Error");
            }
        } else {
            $user = $db_user;
        }
        return $user->id;
    }

    
}