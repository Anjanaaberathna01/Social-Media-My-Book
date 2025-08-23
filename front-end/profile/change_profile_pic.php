<?php
session_start();
include("c:/xampp/htdocs/Social-Media-My-Book/classes/connect.php");
include("c:/xampp/htdocs/Social-Media-My-Book/classes/login.php");
include("c:/xampp/htdocs/Social-Media-My-Book/classes/user.php");
include("c:/xampp/htdocs/Social-Media-My-Book/classes/post.php");


$login = new Login();
$user_data = $login->check_login($_SESSION['nexnet_userid']);
//post start here
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post'])) {

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Change profile</title>
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
</style>

<body>
    <!--top bar-->
    <?php include("header.php"); ?>
    <!--cover bar-->
    <div style="width: 800px;min-height: 400px; margin: auto;">

        <!--below cover bar-->
        <div style="display: flex;">
            <!--post area-->
            <div style="min-height: 400px; flex:2.5; padding: 20px;">
                <!--text are-->
                <form action="" method="post" enctype="multipart/form-data">
                    <div style="border: solid 1px #aaa; padding: 10px; background-color:white; width:100%">

                        <input type="file" name="file"><br>


                        <input type="submit" value="Post"
                            style="background-color: #3b5998; color: white; border: none; padding: 4px 10px; font-size: 14px; border-radius: 2px; float: right; cursor:pointer;">
                        <br>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>

</html>