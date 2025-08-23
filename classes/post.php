<?php

class Post
{
    private $error = "";



    public function create_post($userid, $data)
    {
        if (!empty($data['post'])) {
            $post = addslashes($data['post']);
            $postid = $this->create_postid();

            $query = "INSERT INTO posts (postid, userid, post, date) VALUES ('$postid', '$userid', '$post', NOW())";

            $DB = new Database();
            $DB->save($query);
        } else {
            // Here you would typically save the post to the database
            // For now, we will just return true for demonstration purposes
            $this->error = 'Please enter some content for your post.<br>';
        }
        return $this->error;
    }
    public function get_posts($id)
    {
        $query = "select * from posts where userid = '$id' order by date desc limit 10";
        $DB = new Database();
        $result = $DB->read($query);

        if ($result) {
            return $result; // Return the posts
        } else {
            return false; // No posts found
        }
    }
    private function create_postid()
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