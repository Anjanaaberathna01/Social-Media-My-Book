<?php
include("c:/xampp/htdocs/Social-Media-My-Book/classes/connect.php");
include("c:/xampp/htdocs/Social-Media-My-Book/classes/register.php");

$result = "";
$first_name = "";
$last_name = "";
$gender = "";
$email = "";
if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == 'POST') {
    $register = new Register();
    $result = $register->evaluate($_POST);

    if ($result != "") {
        echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey; border-radius: 5px; padding: 5px; margin-bottom: 10px;'>";
        echo "please correct the following errors:<br>";
        echo $result;
        echo "</div>";
    } else {
        // Redirect to a success page or login page
        // header("Location: ../login/login.php"); // Corrected path
        header("Location: ../profile/profile.php"); // Uncomment if you want to
        exit();
    }
    $first_name = $_POST['first_name'] ?? "";
    $last_name = $_POST['last_name'] ?? "";
    $gender = $_POST['gender'] ?? "";
    $email = $_POST['email'] ?? "";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - NexNet</title>
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;400&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }

        #blue_bar {
            background-color: #3b5998;
            height: 50px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #blue_bar h1 {
            color: white;
            margin: 0;
            font-size: 30px;
        }

        .signup-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        .signup-form {
            background-color: #fff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
        }

        .signup-form h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .form-control {
            margin-bottom: 15px;
        }

        .form-control input,
        .form-control select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
            /* Ensures padding doesn't affect width */
        }

        .form-control input:focus,
        .form-control select:focus {
            outline: none;
            border-color: #3b5998;
        }

        .name-fields {
            display: flex;
            gap: 10px;
        }

        .name-fields .form-control {
            width: 50%;
        }

        .signup-button {
            width: 100%;
            padding: 12px;
            background-color: #3498db;
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }

        .signup-button:hover {
            background-color: #2980b9;
        }

        .login-link {
            text-align: center;
            margin-top: 15px;
        }

        .login-link a {
            color: #3b5998;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .name-fields {
                flex-direction: column;
                gap: 0;
            }

            .name-fields .form-control {
                width: 100%;
            }

            .signup-form {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <!--top bar-->
    <div id="blue_bar">
        <h1>NexNet</h1>
    </div>

    <!-- Sign Up Form -->
    <div class="signup-container">
        <div class="signup-form">
            <form method="post" action="">
                <h2>Create a New Account</h2>
                <?php
                if ($result != "") {
                    echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey; border-radius: 5px; padding: 5px; margin-bottom: 10px;'>";
                    echo "<br>The following errors occured:<br><br>";
                    echo $result;
                    echo "</div>";
                }
                ?>
                <div class="name-fields">
                    <div class="form-control">
                        <input value="<?php echo $first_name ?>" name="first_name" type="text" placeholder="First name"
                            required>
                    </div>
                    <div class="form-control">
                        <input value="<?php echo $last_name ?>" name="last_name" type="text" placeholder="Last name"
                            required>
                    </div>
                </div>
                <div class="form-control">
                    <input value="<?php echo $email ?>" name="email" type="email" placeholder="Email address" required>
                </div>
                <div class="form-control">
                    <input name="password" type="password" placeholder="New password" required>
                </div>
                <div class="form-control">
                    <select <?php echo $gender ?> name="gender" required>
                        <option value="" disabled selected>Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <button type="submit" class="signup-button">Sign Up</button>
                <div class="login-link">
                    <a href="/front-end/login/login.php">Already have an account?</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>