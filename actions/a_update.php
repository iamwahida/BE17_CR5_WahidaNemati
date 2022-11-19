<?php
require_once '../components/db_connect.php';
require_once "../components/file_upload.php";

if ($_POST) {
    $id = $_POST['id'];
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
    $picture = file_upload($_FILES['picture'], "animal"); //file_upload() called  

    if ($picture->error === 0) {
        ($_POST['picture'] == "product.png" ?: unlink("../pictures/$_POST[picture]"));
    $sql = "UPDATE animal SET name='$name', gender='$gender', picture ='$picture->fileName', location = '$location', description ='$description', size = $size, age = $age, vaccinated='$vaccinated', breed='$breed', status = '$status'  WHERE animalID = $id";

    } else {
        $sql = "UPDATE animal SET name='$name', gender='$gender', location = '$location', description ='$description', size = $size, age = $age, vaccinated='$vaccinated', breed='$breed', status = '$status'  WHERE animalID = $id";
    }
    if (mysqli_query($connect, $sql) == TRUE) {
        $class = "success";
        $message = "The record was successfully updated";
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
    } else {
        $class = "danger";
        $message = "Error while updating record : <br>" . mysqli_connect_error();
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
    }
} else {
    header("location: ../error.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "../components/boot.php"; ?>
        <!-- STYLING SCSS LINK -->
        <link rel="stylesheet" href="../style/style.css">
    <title>Update</title>
</head>

<body>
     <!-- NAVBAR -->
     <nav>
        <div>
        <a href="../dashboard.php"><img src="../pictures/pfote.webp" alt="pfote" width="50px"></a></div>
        <div><a href="../dashboard.php">Dashboard</a></div>
    </nav>

    <div class="container">
        <div class="mt-3 mb-3">
            <h1>Update request response</h1>
        </div>
        <div class="alert alert-<?php echo $class; ?>" role="alert">
            <p><?php echo $message; ?></p>
            <p><?php echo $uploadError; ?></p>
            <a href='update.php?id=<?= $id ?>'><button class="btn btn-warning" type='button'>Back</button></a>
            <a href='../dashboard.php'><button style='color: white; background-color: rgb(129, 72, 6);' class="btn" type='button'>Dashboard</button></a>
        </div>
    </div>

</body>

</html>