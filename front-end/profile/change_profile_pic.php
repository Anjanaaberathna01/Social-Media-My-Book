<?php
session_start();
include("c:/xampp/htdocs/Social-Media-My-Book/classes/connect.php");
include("c:/xampp/htdocs/Social-Media-My-Book/classes/login.php");
include("c:/xampp/htdocs/Social-Media-My-Book/classes/user.php");
include("c:/xampp/htdocs/Social-Media-My-Book/classes/post.php");


$login = new Login();
$user_data = $login->check_login($_SESSION['nexnet_userid']);
//post start here
if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
    $allowed_types = ['image/jpeg', 'image/jpg']; // only jpg
    $file_type = mime_content_type($_FILES['file']['tmp_name']);
    $file_size = $_FILES['file']['size'];

    // 1. Check file type
    if (!in_array($file_type, $allowed_types)) {
        die("<div style='color:red; text-align:center; margin:10px;'>Only JPG images are allowed!</div>");
    }

    // 2. Check file size (max 2MB = 2 * 1024 * 1024)
    if ($file_size > 5 * 1024 * 1024) {
        die("<div style='color:red; text-align:center; margin:10px;'>File too large! Max 5MB allowed.</div>");
    }

    // 3. Check dimensions
    list($width, $height) = getimagesize($_FILES['file']['tmp_name']);
    if ($width < 100 || $height < 100) {
        die("<div style='color:red; text-align:center; margin:10px;'>Image too small! Minimum 100x100px.</div>");
    }
    if ($width > 2000 || $height > 2000) {
        die("<div style='color:red; text-align:center; margin:10px;'>Image too large! Maximum 2000x2000px.</div>");
    }

    // 4. Uploads folder
    $folder = "C:/xampp/htdocs/Social-Media-My-Book/uploads/";
    if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
    }

    // 5. Rename file
    $new_filename = $user_data['userid'] . "_" . time() . ".jpg";
    $filename = $folder . $new_filename;

    if (move_uploaded_file($_FILES['file']['tmp_name'], $filename)) {
        $db_filename = "uploads/" . $new_filename;

        $userid = $user_data['userid'];
        $DB = new Database();
        $DB->save("UPDATE users SET profile_image = '$db_filename' WHERE userid = '$userid' LIMIT 1");

        header("Location: ../profile/profile.php");
        exit();
    } else {
        die("<div style='color:red; text-align:center; margin:10px;'>Failed to upload file.</div>");
    }
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


                        <input type="submit" value="Change" name="post"
                            style="background-color: #3b5998; color: white; border: none; padding: 4px 10px; font-size: 14px; border-radius: 2px; float: right; cursor:pointer;">
                        <br>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>

</html>