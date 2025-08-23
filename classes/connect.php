<?php
// Database connection class
// This class handles the connection to the database and provides methods for reading and saving data.
class database
{
   private $host = "localhost";
   private $username = "root";
   private $password = "";
   private $db = "nexnet_bd";
   // Database connection and methods can be defined here
   public function connect(): mysqli|false
   {
      $connection = mysqli_connect($this->host, $this->username, $this->password, $this->db);
      return $connection;
   }


   // Example method to fetch data
   public function read($query)
   {
      $conn = $this->connect();
      $result = mysqli_query($conn, $query);
      if (!$result) {
         return false;
      } else {
         $data = [];
         while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
         }
         return $data;
      }
   }
   public function save($query)
   {
      $conn = $this->connect();
      $result = mysqli_query($conn, $query);
      if (!$result) {
         return false;
      } else {
         return true;
      }
   }
}