<?php
session_start();
include("c:/xampp/htdocs/Social-Media-My-Book/classes/connect.php");
include("c:/xampp/htdocs/Social-Media-My-Book/classes/login.php");
include("c:/xampp/htdocs/Social-Media-My-Book/classes/user.php");
include("c:/xampp/htdocs/Social-Media-My-Book/classes/post.php");


$login = new Login();
$user_data = $login->check_login($_SESSION['nexnet_userid']);
//for posting

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post'])) {
    $post_content = trim($_POST['post']);
    if (!empty($post_content)) {
        $post = new Post(); // Assuming you have a Post class to handle posts
        $id = $_SESSION['nexnet_userid']; // Get the user ID from session
        $result = $post->create_post($id, $_POST);

        if ($result == "") {
            header("Location: ../profile/profile.php"); // Redirect to profile after posting
            exit();
        } else {
            echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey; border-radius: 5px; padding: 5px; margin-bottom: 10px;'>";
            echo "The following errors occurred:<br><br>";
            echo $result;
            echo "</div>";
        }


    }
}

// collect posts
$post = new Post(); // Assuming you have a Post class to handle posts
$id = $_SESSION['nexnet_userid'];
$posts = $post->get_posts($id);

// collect friends
$user = new User();
$id = $_SESSION['nexnet_userid'];
$friends = $user->get_friends($id);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Profile - NexNet</title>
</head>
<style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;400&display=swap');

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #dedede;
    }

    #blue_bar {
        background-color: #3b5998;
        height: 50px;
        width: 100%;
    }

    #searchBar {
        text-align: left;
        font-size: 16px;
        width: 400px;
        height: 20px;
        border-radius: 5px;
        border: 1px solid #ccc;
        padding: 4px;
        margin-top: 10px;
        background-image: url('/images/images.png');
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: auto 20px;
    }

    #Profile-Photo {
        width: 200px;
        height: 200px;
        margin-top: -350px;
        border-radius: 50%;
        border: #ffffff 2px solid;
    }

    #menu_bar {
        display: flex;
        justify-content: center;
        background-color: white;
        border-top: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
        padding: 4px 0;
    }

    #menu_button {
        padding: 10px 20px;
        color: #3b5998;
        cursor: pointer;
        font-size: 14px;
        font-weight: bold;
        transition: background-color 0.2s ease-in-out;
    }

    #menu_button:hover {
        background-color: #f0f2f5;
        border-radius: 6px;
    }

    #friend-bar {
        background-color: #f0f0f0;
        min-height: 500px;
        min-width: 200px;
        margin-top: 20px;
        padding: 8px;
        border-radius: 4px;
    }

    #friends {
        clear: both;
        gap: 10px;
        font-size: 15px;
        color: #4e69a2;
        font-weight: bold
    }

    #friends-img {
        width: 100px;
        height: 100px;
        margin: 8px;
        float: left;
    }

    #post-bar {
        margin-top: 20px;
        background-color: white;
        padding: 10px;
        width: 100%;
    }

    .post {
        padding: 4px;
        font-size: 14px;
        display: flex;
        margin-bottom: 20px;
    }
</style>
<!--<div id="blue_bar" style="position: relative; display: flex; align-items: center; justify-content: center;">-->

<body>
    <!--top bar-->
    <?php include("header.php"); ?>

    <!--cover bar-->
    <div style="width: 800px;min-height: 400px; margin: auto;">
        <div style=" background-color: #f0f0f0; text-align:center; color:#878787">
            <img src="/images/mountain.jpg" alt="cover photo" style="width: 100%;">
            <span style="font: size 12px;">
                <img src="/images/profile-photo.jpg" id="Profile-Photo" alt="Profile Photo"><br>
                <a href="change_profile_pic.php" style="text-decoration:none; color:#878787">Change Image</a>
            </span>
            <br>
            <div style="font-size: 20px;color: black;">
                <?php echo $user_data['first_name'] . " " . $user_data['last_name']; // <-- 3. Corrected typo ?>
            </div>
            <br>

            <div id="menu_bar">
                <a href="index.php" style="text-decoration: none;">
                    <div id="menu_button">Timeline</div>
                </a>
                <div id="menu_button">About</div>
                <div id="menu_button">Friends</div>
                <div id="menu_button">Photos || Videos</div>
                <div id="menu_button">Check-ins</div>
            </div>
        </div>
        <!--below cover bar-->
        <div style="display: flex; gap:20px; margin-top:20px;">

            <!--friends area-->
            <div style="flex:1; min-height: 200px;">
                <div id="friend-bar">
                    <h2 style="color: #878787;">Friends</h2>

                    <?php
                    if ($friends) {
                        foreach ($friends as $FRIEND_ROW) {
                            $user = new User();
                            include("../profile/user.php");
                        }
                    }
                    ?>
                </div>
            </div>

            <!--post area-->
            <div style="flex:2.5; min-height: 400px; padding: 20px;">
                <!--text area-->
                <div style="border: solid 1px #aaa; padding: 10px; background-color:white; width:100%">
                    <form method="post">
                        <textarea name="post" placeholder="What's on your mind?"
                            style="width: 100%; border:none; font-family:tahoma; font-size:14px; height: 60px;"></textarea>
                        <input type="submit" value="Post"
                            style="background-color: #3b5998; color: white; border: none; padding: 4px 10px; font-size: 14px; border-radius: 2px; float: right; cursor:pointer;">
                        <br>
                    </form>
                </div>

                <!--posts-->
                <div id="post-bar">
                    <?php
                    if ($posts) {
                        foreach ($posts as $ROW) {
                            $user = new User();
                            $ROW_USER = $user->get_user_data($ROW['userid']);
                            include("../profile/post.php");
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

    </div>

</body>

</html>