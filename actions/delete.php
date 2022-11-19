<?php
session_start();
require_once '../components/db_connect.php';
// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
if (isset($_SESSION["user"])) {
    header("Location: home.php");
    exit;
}

$logout ="";
$register ="";

$status = 'adm';
$sqli = "SELECT * FROM users WHERE status != '$status'";
$resulti = mysqli_query($connect, $sqli);
$tbody = '';
if ($resulti->num_rows > 0) {
    while ($row = $resulti->fetch_array(MYSQLI_ASSOC)) {
        $body = $row['first_name'];
        $img = $row['picture'];
        $logout = " <a href='logout.php?logout'>Logout</a>";
        $dash = "<a href='dashboard.php'>Dashboard</a>";
    }
} else {
    $img = "No Data Available";
    $logout = " <a href='login.php'>Login</a>";
    $register ="<a href='register.php'>Registration</a>";
}

//initial bootstrap class for the confirmation message
$class = 'd-none';
//the GET method will show the info from the user to be deleted
if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM animal WHERE animalID = {$id}";
    $result = mysqli_query($connect, $sql);
    $data = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 1) {
            $name = $data ['name'];
            $gender = $data ['gender'];
            $picture = $data ['picture'];
            $location = $data ['location'];
            $description = $data ['description'];
            $size = $data ['size'];
            $age = $data ['age'];
            $vaccinated = $data ['vaccinated'];
            $breed = $data ['breed'];
            $status = $data ['status'];

    }
}
//the POST method will delete the user permanently
if ($_POST) {
    $id = $_POST['id'];
    $picture = $_POST['picture'];
    ($picture == "avatar.png") ?: unlink("../pictures/$picture");

    $sql = "DELETE FROM animal WHERE animalID = {$id}";
    if ($connect->query($sql) === TRUE) {
        $class = "alert alert-success";
        $message = "Successfully Deleted!";
        header("Location: ../dashboard.php");
    } else {
        $class = "alert alert-danger";
        $message = "The entry was not deleted due to: <br>" . $connect->error;
    }
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Animal</title>
    <?php require_once '../components/boot.php' ?>
        <!-- Styling -->
        <link rel="stylesheet" href="../style/style.css">
    <style type="text/css">
        fieldset {
            margin: auto;
            margin-top: 100px;
            width: 70%;
        }

        .img-thumbnail {
            width: 70px !important;
            height: 70px !important;
        }
    </style>
</head>

<body>
     <!-- NAVBAR -->
     <nav>
        <div>
        <a href="home.php"><img src="../pictures/pfote.webp" alt="pfote" width="50px"></a></div>
        <div><?php echo $logout?></div> 
        <div><?php echo $dash?></div> 
        <div><?php echo $register?></div>
    </nav>

    <div class="<?php echo $class; ?>" role="alert">
        <p><?php echo ($message) ?? ''; ?></p>
    </div>
    <fieldset>
        <legend class='h2 mb-3'>Delete request <img class='img-thumbnail rounded-circle' src='../pictures/<?php echo $picture ?>' alt="<?php echo $name ?>"></legend>
        <h3>You have selected the data below:</h3>
        <table class="table w-75 mt-3">
            <tr class="text-center">
                <td style="font-size: 25px; font-weight: bold; color: white;"><?php echo "$name" ?></td>
            </tr>
        </table>

        <h3 class="mb-4">Do you really want to delete this user?</h3>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id ?>" />
            <input type="hidden" name="picture" value="<?php echo $picture ?>" />
            <button class="btn btn-danger" type="submit">Yes, delete it!</button>
            <a href="../dashboard.php"><button class="btn btn-warning" type="button">No, go back!</button></a>
        </form>
    </fieldset>
</body>
</html>