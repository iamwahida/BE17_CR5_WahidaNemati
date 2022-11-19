<?php
if (isset($_SESSION['user'])) {
    header("Location: home.php");
    exit;
}

if (isset($_SESSION['adm'])) {
    header("Location: dashboard.php");
    exit;
}

require_once 'components/db_connect.php';
require_once 'components/file_upload.php';

$error = false;
$first_name = $last_name = $email = $phone_number = $address = $picture = $password = $status = "";
$first_nameError = $last_nameError = $emailError = $phone_numberError = $addressError = $picError = $passwordError = $statusError = "";



if (isset($_POST['btn-signup'])) {
    $first_name = trim($_POST['first_name']);
    $first_name = strip_tags($first_name);
    $first_name = htmlspecialchars($first_name);

    $last_name = trim($_POST['last_name']);
    $last_name = strip_tags($last_name);
    $last_name = htmlspecialchars($last_name);

    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $phone_number = trim($_POST['phone_number']);
    $phone_number = strip_tags($phone_number);
    $phone_number= htmlspecialchars($phone_number);

    $address = trim($_POST['address']);
    $address = strip_tags($address);
    $address = htmlspecialchars($address);

    $password = trim($_POST['password']);
    $password = strip_tags($password);
    $password = htmlspecialchars($password);

    $uploadError = "";
    $picture = file_upload($_FILES['picture'], "user");


    if (empty($first_name) || empty($last_name)) {
        $error = true;
        $fnameError = "Please enter your name and surname";
    } elseif (strlen($first_name) < 3 || strlen($last_name) < 3) {
        $error = true;
        $first_nameError = "Name and surname must have at least 3 characters";
    } elseif (!preg_match("/^[a-zA-z]+$/", $first_name) || !preg_match("/^[a-zA-z]+$/",          $last_name)) {
        $error = true;
        $first_name = "Name and surname must contain only letters and no spaces";
    }

    if (empty($phone_number)) {
        $error = true;
        $dateError = "Please enter your phone number.";
    }

    if (empty($email)) {
        $error = true;
        $emailError = "Please enter your email";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter valid email address";
    } else {
        $query = "SELECT email FROM users WHERE email='$email'";
        $result = mysqli_query($connect, $query);
        $count = mysqli_num_rows($result);
        if ($count != 0) {
            $error = true;
            $emailError = "Provided email already exists";
        }
    }

    if (empty($password)) {
        $error = true;
        $passwordError = "Please enter the password";
    } elseif (strlen($password) < 5) {
        $error = true;
        $passwordError = "Password must have at least 6 characters";
    }

    $pass = hash('sha256', $password);

    if (!$error) {
        $query = "INSERT INTO users(first_name, last_name, email, phone_number, address,  password, picture) 
        VALUES ('$first_name', '$last_name', '$email', $phone_number, '$address', '$pass',   '$picture->fileName')";

        $res = mysqli_query($connect, $query);

        if ($res) {
            $errTyp = "success";
            $errMSG = "Successfully registered, you may login now";
            $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
        } else {
            $errTyp = "danger";
            $errMSG = "Something went wrong, try again later...";
            $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
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
    <title>Login and Registration System</title>
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
        <div class="row justify-content-center align-items-center h-100 ">
            <div class="col-12 col-lg-9 col-xl-7">
                <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                    <div class="card-body p-4 p-md-5">
                        <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registration Form</h3>
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" enctype="multipart/form-data">
                            <?php
                            if (isset($errMSG)) {
                            ?>
                                <div class="alert alert-<?php echo $errTyp ?>">
                                    <p><?php echo $errMSG; ?></p>
                                    <p><?php echo $uploadError; ?></p>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="row fs-3">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <input type="text" name="first_name" class="fs-4 form-control" placeholder="First name" maxlength="50" value="<?php echo $first_name ?>" />
                                        <span class="text-danger"> <?php echo $first_nameError; ?> </span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <input type="text" name="last_name" class=" fs-4 form-control" placeholder="Surname" maxlength="50" value="<?php echo $last_name ?>" />
                                        <span class="text-danger"> <?php echo $last_nameError; ?> </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4 d-flex align-items-center">
                                    <div class="form-outline datepicker w-100">
                                        <input class='fs-4 form-control' placeholder="Phone Number" type="number" name="phone_number" value="<?php echo $phone_number ?>" />
                                        <span class="text-danger"> <?php echo $phone_numberError; ?> </span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <input class='fs-4 form-control' type="file" name="picture">
                                        <span class="text-danger"> <?php echo $picError; ?> </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-2 pb-2">
                                    <div class="form-outline">
                                        <input type="email" name="email" class="fs-4  form-control" placeholder="Enter Your Email" maxlength="40" value="<?php echo $email ?>" />
                                        <span class="text-danger"> <?php echo $emailError; ?> </span>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-4 pb-2">
                                    <div class="form-outline">
                                        <input type="text" name="address" class="fs-4 form-control" placeholder="Address" maxlength="15" />
                                        <span class="text-danger"> <?php echo $addressError; ?> </span>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4 pb-2">
                                    <div class="form-outline">
                                        <input type="password" name="password" class="fs-4 form-control" placeholder="Enter Password" maxlength="15" />
                                        <span class="text-danger"> <?php echo $passwordError; ?> </span>
                                    </div>

                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="fs-4 btn btn-primary btn-lg btn-block" style="width:100%" name="btn-signup">Register</button>
                            </div>
                            <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="login.php" class="fw-bold text-body"><u>Login here</u></a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>