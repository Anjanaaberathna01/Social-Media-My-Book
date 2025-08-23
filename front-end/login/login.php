<?php
session_start();

include("c:/xampp/htdocs/Social-Media-My-Book/classes/connect.php");
include("c:/xampp/htdocs/Social-Media-My-Book/classes/login.php");

$result = "";
$email = "";
$password = ""; // It's good practice to clear password field

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == 'POST') {
    $login = new Login();
    // evaluate() does not return a value (void), so call it directly
    $result = $login->evaluate($_POST);

    // Try to read errors from the Login object if it exposes them; fall back to empty string
    $result = isset($login->errors) ? $login->errors : "";

    // On success (no errors) redirect to profile page using a proper Location header
    if ($result == "") {
        header("Location: ../profile/profile.php"); // Corrected relative path
        die;
    }

    // Repopulate email (do not repopulate password for security)
    $email = isset($_POST['email']) ?? "";
    $password = "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NexNet</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;600&display=swap');

        * {
            box-sizing: border-box;
        }

        body {
            background-color: #f0f2f5;
            font-family: 'Poppins', sans-serif;
            margin: 0;
        }

        #blue_bar {
            background-color: #3b5998;
            padding: 10px 0;
            text-align: center;
        }

        #blue_bar h1 {
            color: white;
            margin: 0;
            font-size: 30px;
        }

        .main-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 50px;
            min-height: calc(100vh - 70px);
            padding: 20px;
            flex-wrap: wrap;
        }

        .intro-text {
            max-width: 500px;
        }

        .intro-text h2 {
            font-size: 28px;
            color: #1c1e21;
            font-weight: 600;
            line-height: 1.2;
        }

        .login-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            padding: 20px;
            text-align: center;
        }

        .form input {
            width: 100%;
            padding: 14px;
            margin-bottom: 10px;
            border-radius: 6px;
            border: 1px solid #ddd;
            font-size: 16px;
        }

        .form input:focus {
            outline: none;
            border-color: #3b5998;
            box-shadow: 0 0 0 2px #e7f3ff;
        }

        .login-button {
            width: 100%;
            padding: 12px;
            background-color: #1877f2;
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 5px;
        }

        .login-button:hover {
            background-color: #166fe5;
        }

        .forgot-password {
            display: block;
            color: #1877f2;
            text-decoration: none;
            margin-top: 15px;
            font-size: 14px;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        hr {
            border: 0;
            height: 1px;
            background-color: #dadde1;
            margin: 20px 0;
        }

        .create-account-button {
            display: inline-block;
            padding: 12px 20px;
            background-color: #42b72a;
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 17px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
        }

        .create-account-button:hover {
            background-color: #36a420;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .main-container {
                flex-direction: column;
                text-align: center;
                gap: 20px;
            }

            .intro-text {
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>
    <!--top bar-->
    <div id="blue_bar">
        <h1>NexNet</h1>
    </div>

    <div class="main-container">
        <div class="intro-text">
            <h2>NexNet helps you connect and share with the people in your life.</h2>
        </div>
        <div class="login-container">
            <form method="post" id="loginForm" class="form">
                <?php
                if ($result != "") {
                    echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey; border-radius: 5px; padding: 5px; margin-bottom: 10px;'>";
                    echo "The following errors occurred:<br><br>";
                    echo $result;
                    echo "</div>";
                }
                ?>
                <input value="<?php echo $email; ?>" name="email" type="email" id="email" placeholder="Email address"
                    required>
                <input value="<?php echo $password; ?>" name="password" type="password" id="password"
                    placeholder="Password" required>
                <button type="submit" class="login-button">Log In</button>
                <a href="#" class="forgot-password">Forgotten password?</a>
                <hr>
                <a href="../register/register.php" class="create-account-button">Create new account</a>
            </form>
        </div>
    </div>
</body>

</html>