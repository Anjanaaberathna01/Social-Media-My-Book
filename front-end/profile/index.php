<?php
session_start();
include("c:/xampp/htdocs/Social-Media-My-Book/classes/connect.php");
include("c:/xampp/htdocs/Social-Media-My-Book/classes/login.php");
include("c:/xampp/htdocs/Social-Media-My-Book/classes/user.php");
include("c:/xampp/htdocs/Social-Media-My-Book/classes/post.php");


$login = new Login();
$user_data = $login->check_login($_SESSION['nexnet_userid']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Profile - Time-line</title>
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
        border-radius: 50%;
        border: #ffffff 2px solid;
    }

    #menu_button {
        display: inline-block;
        width: 100px;
        margin: 2px;
        padding: 8px 16px;
        color: #3b5998;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        text-align: center;
    }

    #menu_button:hover {
        background-color: #4e69a2;
        color: white;
    }

    #friend-bar {
        min-height: 400px;
        min-width: 200px;
        margin-top: 20px;
        padding: 8px;
        border-radius: 4px;
        text-align: center;
        font-size: 20px;
        color: #aaa;
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

<body>
    <!--top bar-->
    <?php include("header.php"); ?>
    <!--cover bar-->
    <div style="width: 800px;min-height: 400px; margin: auto;">

        <!--below cover bar-->
        <div style="display: flex;">

            <!--friends area-->
            <div style="min-height: 400px;" flex:1;>
                <div id="friend-bar">

                    <img src="/images/profile-photo.jpg" alt="profile photo" id="Profile-Photo">
                    <br>
                    <a href="profile.php"
                        style="text-decoration:none; color: #aaa#;"><?php echo $user_data['first_name'] . " " . $user_data['last_name'] ?></a>
                </div>
            </div>
            <!--post area-->
            <div style="min-height: 400px; flex:2.5; padding: 20px;">
                <!--text are-->
                <div style="border: solid 1px #aaa; padding: 10px; background-color:white; width:100%">
                    <textarea placeholder="What's on your mind?"
                        style="width: 100%; border:none; font-family:tahoma; font-size:14px; height: 60px;">
                    </textarea>
                    <input type="submit" value="Post"
                        style="background-color: #3b5998; color: white; border: none; padding: 4px 10px; font-size: 14px; border-radius: 2px; float: right; cursor:pointer;">
                    <br>
                </div>
                <!--posts-->
                <div id="post-bar">
                    <!-- Post 1 -->
                    <div class="post">
                        <div>
                            <img src="/images/friend/1.webp" alt="user photo"
                                style="width: 75px; height: 75px;margin-right:10px;">
                        </div>
                        <div>
                            <div style="font-weight:bold; color:#4e69a2;">First Guy</div>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                commodo consequat.
                            </p>
                            <br><br>
                            <a href="">Like </a>| <a href="">Comment </a> | <a href="">share </a> | <span
                                style="color: #aaa;">20/08/2025</span>
                        </div>
                    </div>
                    <!-- Post 2 -->
                    <div class="post">
                        <div>
                            <img src="/images/profile-photo.jpg" alt="user photo"
                                style="width: 75px; height: 75px;margin-right:10px;">
                        </div>
                        <div>
                            <div style="font-weight:bold; color:#4e69a2;">Anjana Aberathna</div>
                            <p>
                                It's a beautiful day! Feeling excited to connect with everyone on MyBook. Here's a
                                picture from my recent trip.
                                <br><br>
                                <img src="/images/mountain.jpg" style="width:100%">
                            </p>
                            <br><br>
                            <a href="">Like </a>| <a href="">Comment </a> | <a href="">share </a> | <span
                                style="color: #aaa;">18/08/2025</span>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</body>

</html>