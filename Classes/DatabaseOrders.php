<?php
require_once __DIR__ ."/DatabaseConnection.php";
require_once __DIR__ ."/Order.php";

class DatabaseOrders extends DatabaseConnection
{

     // GET ONE 
     public function get_by_id($id){
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
     public function get_all(){
        $query = "SELECT * from orders ORDER BY id DESC";
        $result = mysqli_query($this->conn, $query);
        $db_orders = mysqli_fetch_all($result, MYSQLI_ASSOC); 

        $orders = []; 

        foreach($db_orders as $db_order){ 
            $db_id = $db_order["id"];
            $db_user_id = $db_order["user_id"];
            $db_status = $db_order["status"];
            $db_date = $db_order["date"];

            $orders[] = new Order($db_user_id, $db_date, $db_status, $db_id); 
        }
        
        return $orders;
    }

    // UPDATE
    public function update(Order $order, $id){
        $query = "UPDATE orders SET `status` = ?, `date`= ? WHERE id = ?";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("ssi", $order->date, $order->status, $id);

        return $stmt->execute();
    }

     // DELETE
     public function delete($id){
        $query = "DELETE FROM orders WHERE id = ?";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    public function save(Order $order){
        $query = "INSERT INTO orders (`user_id`, `status`, `date`) VALUES (?, ?, ?)";
        
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("ssi", $order->user_id, $order->status, $order->date);

        $success = $stmt->execute();

        $order_id = ($this->conn->insert_id);
        
        if($success){
            return $order_id;
        } else{
            return false; 
        }
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
/* 
        $query = "SELECT *, loans.id AS `loan-id` FROM `loans`
            JOIN books ON books.id = loans.`book-id`
            WHERE loans.`user-id` = ?";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("i", $user_id);

        $stmt->execute();

        $result = $stmt->get_result();

        $loans = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $loans; */
    }

}