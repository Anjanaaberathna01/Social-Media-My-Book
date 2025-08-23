<?php
class User
{
    public function get_user_data($id)
    {
        // Assuming you have a Database class from connect.php
        $query = "SELECT * FROM users WHERE userid = '$id' LIMIT 1";
        $DB = new Database();
        $result = $DB->read($query);

        if ($result) {
            $row = $result[0]; // Assuming the first row is the user
            return $row; // Return the first row of the result
        } else {
            return false; // No user found
        }
    }
    public function get_user($id)
    {
        $DB = new Database();
        $result = $DB->read($query = ("SELECT * FROM users WHERE userid = '$id' LIMIT 1"));

        if ($result) {
            return $result[0]; // Return the first row of the result
        } else {
            return false; // No user found
        }
    }

    public function get_friends($id)
    {
        $DB = new Database();
        $result = $DB->read($query = ("SELECT * FROM users WHERE userid = '$id'"));

        if ($result) {
            return $result; // Return the first row of the result
        } else {
            return false; // No user found
        }
    }

}