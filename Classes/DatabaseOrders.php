<?php
require_once __DIR__ . "/DatabaseConnection.php";
require_once __DIR__ . "/Order.php";

class DatabaseOrders extends DatabaseConnection
{

    // GET ONE 
    public function get_by_id($id)
    {
        $query  = "SELECT * FROM orders WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $db_order = mysqli_fetch_assoc($result);

        $order = new Order($db_order["user_id"], $db_order["date"], $db_order["status"], $db_order["id"]);

        return $order;
    }

    // GET ALL 
    public function get_all()
    {
        // $query = "SELECT * from orders ORDER BY id DESC";
        $query = "SELECT orders.`id`, orders.`date`, orders.`users_id`, orders.`status`, users.`username` 
                    From orders JOIN users ON users.`id` = orders.`users_id`
                    ORDER BY orders.id DESC ";
        $result = mysqli_query($this->conn, $query);
        $db_orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $orders = [];

        foreach ($db_orders as $db_order) {
            $db_id = $db_order["id"];
            // $db_user_id = $db_order["user_id"];
            $db_username = $db_order["username"];
            $db_status = $db_order["status"];
            $db_date = $db_order["date"];

            $orders[] = new Order($db_username, $db_date, $db_status, $db_id);
        }

        return $orders;
    }

    // UPDATE
    public function update(Order $order, $order_status, $order_id)
    {
        $query = "UPDATE orders SET `date` = ?, `status`= ? WHERE id = ?";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("ssi", $order->date, $order->status, $order_id);

        return $stmt->execute();
    }

    // DELETE
    public function delete($id)
    {
        $query = "DELETE FROM orders WHERE id = ?";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    public function save(Order $order)
    {
        $query = "INSERT INTO orders (`user_id`, `status`, `date`) VALUES (?, ?, ?)";

        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("ssi", $order->user_id, $order->status, $order->date);

        $success = $stmt->execute();

        $order_id = ($this->conn->insert_id);

        if ($success) {
            return $order_id;
        } else {
            return false;
        }
    }

    public function statuses()
    {
        $query = "SELECT * FROM order_statuses";
        $result = mysqli_query($this->conn, $query);
        $db_order_statuses = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $statuses = [];

        foreach ($db_order_statuses as $db_order_status) {
            $db_id = $db_order_status["id"];
            $db_status = $db_order_status["status"];

            $statuses[] = new Status($db_status, $db_id);
        }

        return $statuses;
    }

    public function get_order_by_user_id($users_id)
    {

        $query = "SELECT * FROM orders WHERE `users_id` = ?";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("i", $users_id);

        $stmt->execute();

        $result = $stmt->get_result();

        $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);


        return $orders;
    }

}
