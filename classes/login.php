<?php

use LDAP\Result;

class Login
{
    private $error = "";

    public function evaluate($data)
    {
        // Note: addslashes is not sufficient protection. You should
        // update your Database class to use prepared statements.
        $email = addslashes($data['email']);
        $password = addslashes($data['password']);

        // Hash the submitted password to match the one in the database
        $hashed_password = hash("sha1", $password);

        $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";

        $DB = new Database();
        $result = $DB->read($query);

        if ($result) {
            $row = $result[0];

            // Compare the hashed password with the one from the database
            if ($hashed_password == $row["password"]) {
                // Correct password, create session
                $_SESSION['nexnet_userid'] = $row['userid'];
            } else {
                // Generic error for security
                $this->error = "Wrong email or password<br>";
            }
        } else {
            // Generic error for security
            $this->error = "Wrong email or password<br>";
        }

        return $this->error;
    }

    public function check_login($id)
    {
        if (is_numeric($id)) {
            // This is also vulnerable to SQL injection.
            $query = "SELECT * FROM users WHERE userid = '$id' limit 1";

            $DB = new Database();
            $result = $DB->read($query);

            if ($result) {
                $user_data = $result[0];
                return $user_data;
            } else {
                // If login check fails, redirect
                header("Location: ../login/login.php"); // Corrected path
                die;
            }
        } else {
            // If not logged in, redirect
            header("Location: ../login/login.php");
            die;
        }
    }
}