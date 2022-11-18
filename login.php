<?php

session_start();

if (isset($_SESSION['user'])) {
    header("Location: home.php");
    exit;
}

if (isset($_SESSION['adm'])) {
    header("Location: dashboard.php");
    exit;
}

require_once 'components/db_connect.php';

$error = false;
$email = $pass = $emailError = $passError = "";

if (isset($_POST['btn-login'])) {
    // prevent sql injections/ clear user invalid inputs
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);

    if (empty($email)) {
        $error = true;
        $emailError = "Please enter your email address.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter valid email address.";
    }
    if (empty($pass)) {
        $error = true;
        $passError = "Please enter your password.";
    }

    if (!$error) {
        $password = hash('sha256', $pass);
        $sql = "SELECT * FROM USERS WHERE email= '$email' AND password = '$password'";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_assoc($result);

        $count = mysqli_num_rows($result);

        if ($count == 1) {
            if ($row['status'] == "adm") {
                $_SESSION['adm'] = $row['usersID'];
                header("Location: dashboard.php");
                exit;
            } else {
                $_SESSION['user'] = $row['usersID'];
                header("Location: home.php");
                exit;
            }
        } else {
            $errMSG = "Incorrect Credentials, Try again. <br>";
        }
    }
}
mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php require_once 'components/boot.php' ?>
    <!-- Styling -->
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
     <!-- NAVBAR -->
     <nav>
    <div><a href="home.php"><img src="pictures/pfote.webp" alt="pfote" width="50px"></a></div>
        <div><a href="juniors.php">Juniors</a></div>
        <div><a href="seniors.php">Seniors</a></div>
        <div><a href="home.php">All pets</a></div>
        <div><a href="register.php">Registration</a></div>
        <div><a href="login.php">Login</a></div> 
    </nav>

    <div class="container py-5 h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-lg-9 col-xl-7">
                <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                    <div class="card-body p-4 p-md-5">
                        <h3 class="pb-5 pb-md-0 pb-lg-0 mb-md-5">Login </h3>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" enctype="multipart/form-data">
                            <?php
                            if (isset($errMSG)) {
                                echo $errMSG;
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-12 mb-2 pb-2">
                                    <div class="form-outline">
                                        <input type="email" name="email" class="form-control form-control-lg" placeholder="Your Email" maxlength="40" value="<?php echo $email ?>" />
                                        <span class="text-danger mx-2"><?php echo $emailError ?></span>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4 pb-2">
                                    <div class="form-outline">
                                        <input type="password" name="pass" class="form-control form-control-lg" placeholder="Your Password" maxlength="15" />
                                        <span class="text-danger mx-2"><?php echo $passError ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" style="width:100%" name="btn-login">Log in</button>
                            </div>
                            <p class="text-center text-muted mt-5 mb-0">Don't have an account? <a href="register.php" class="fw-bold text-body"><u>Register here</u></a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>