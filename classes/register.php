<?php

class Register
{
    private $error = "";

    /**
     * Evaluates the submitted registration data.
     */
    public function evaluate($data)
    {
        foreach ($data as $key => $value) {
            if (empty($value)) {
                $this->error .= ucfirst(str_replace("_", " ", $key)) . " is empty!<br>";
            }

            if ($key == "email") {
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->error .= "Invalid email address!<br>";
                }
            }

            if ($key == "frist_name" || $key == "last_name") {
                if (is_numeric($value)) {
                    $this->error .= ucfirst(str_replace("_", " ", $key)) . " can't be a number!<br>";
                }
                if (strstr($value, " ")) {
                    $this->error .= ucfirst(str_replace("_", " ", $key)) . " can't have spaces!<br>";
                }
            }
        }

        if ($this->error == "") {
            // No errors, proceed to create user
            $this->create_user($data);
        }

        return $this->error;
    }

    /**
     * Inserts the new user into the database.
     */
    public function create_user($data)
    {
        $first_name = ucfirst($data['first_name']); // Corrected from 'frist_name'
        $last_name = ucfirst($data['last_name']);
        $gender = $data['gender'];
        $email = $data['email'];
        $password = $data['password'];

        // It's crucial to hash passwords before storing them.
        $hashed_password = hash("sha1", $password);

        // Create a unique user ID and URL address
        $userid = $this->create_userid();
        $url_address = strtolower($first_name) . "." . strtolower($last_name);

        // IMPORTANT: Use prepared statements to prevent SQL injection
        $query = "INSERT INTO users 
                (userid, first_name, last_name, gender, email, password, url_address) 
                VALUES 
                ('$userid', '$first_name', '$last_name', '$gender', '$email', '$hashed_password', '$url_address')";

        $DB = new Database();
        $DB->save($query);
    }

    /**
     * Generates a random numeric user ID.
     */
    private function create_userid()
    {
        $length = rand(4, 19);
        $number = "";
        for ($i = 0; $i < $length; $i++) {
            $new_rand = rand(0, 9);
            $number .= $new_rand;
        }
        return $number;
    }
}