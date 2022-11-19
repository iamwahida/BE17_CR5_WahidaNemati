<?php
session_start();
require_once '../components/db_connect.php';
require_once '../components/file_upload.php';

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}
if (isset($_SESSION['user'])) {
    header("Location: ../home.php");
    exit;
}

if ($_POST) {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $size = $_POST['size'];
    $age = $_POST['age'];
    $vaccinated = $_POST['vaccinated'];
    $breed = $_POST['breed'];
    $status = $_POST['status'];

    $uploadError = '';
    //this function exists in the service file upload.
    $picture = file_upload($_FILES['picture'], "animal");

    $sql = "INSERT INTO animal (name, gender, picture, location, description, size, age, vaccinated, breed, status) VALUES ('$name', '$gender', '$picture->fileName', '$location', '$description', $size, $age, '$vaccinated', '$breed', '$status')";
    
    if (mysqli_query($connect, $sql) === true) {
        $class = "success";
        $message = "The entry below was successfully created <br>
            <table class='table w-50'><tr>
            <td> $name </td> <br>
            <td> $breed </td>
            </tr></table><hr>";
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
    } else {
        $class = "danger";
        $message = "Error while creating record. Try again: <br>" . $connect->error;
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
    }
    mysqli_close($connect);
} else {
    header("location: ../error.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update</title>
    <?php require_once '../components/boot.php' ?>
    <!-- Styling -->
        <link rel="stylesheet" href="../style/style.css">
</head>

<body>
     <!-- NAVBAR -->
     <nav>
        <div>
        <a href="home.php"><img src="../pictures/pfote.webp" alt="pfote" width="50px"></a></div>
        <div><a href="create.php">Add animal</a></div>
        <div><a href="../dashboard.php">Dashboard</a></div>

    </nav>
    <div class="container">
        <div class="mt-3 mb-3">
            <h1>Create request response</h1>
        </div>
        <div class="alert alert-<?= $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
            <a href='../dashboard.php'><button class="btn btn-warning" type='button'>Dashboard</button></a>
        </div>
    </div>
</body>

</html>