<?php
session_start();
require_once 'components/db_connect.php';

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
if (isset($_SESSION["user"])) {
    header("Location: home.php");
    exit;
}

$logout ="";
$register ="";

$status = 'adm';
$sql = "SELECT * FROM users WHERE status != '$status'";
$result = mysqli_query($connect, $sql);
$tbody = '';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
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

// ANIMALS
$sqli = "SELECT * FROM animal";
$resulti = mysqli_query($connect, $sqli);
$content = "";
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($resulti)) {
            $content .= "
            <div class='card mt-3 mb-2' style='width: 20rem;'>
            <img src='pictures/". $row ['picture']."' width='100%' height = '50%' class='p-2 card-img-top' alt='animal-pictures/". $row ['picture']."'>
            <div class='card-body'>
            <p class='card-title'>". $row ['name']."</p>
            <p class='card-text'><strong>Breed: </strong>". $row ['breed']."</p>
            <p class='card-text'><strong>Age: </strong>". $row ['age']."</p>
            <p class='card-text'><strong>Vaccinated: </strong>". $row ['vaccinated']."</p>
            <p class='card-text'><strong>Status: </strong>". $row ['status']."</p>
            <a href='detailsADM.php?id=" . $row['animalID'] . "' class='btn fs-5'>Show details</a>
            <a href='actions/update.php?id=" . $row['animalID'] . "' class='btn fs-5 bg-warning'>Edit</a>
            <a href='actions/delete.php?id=" . $row['animalID'] . "'class= 'btn bg-danger fs-5'>Delete</a>
            </div>
            </div>
            ";
        }
    } else {
        $content = "No data available";
    }
    mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hi, Administrator</title>
    <?php require_once 'components/boot.php' ?>
    <!-- Styling -->
    <link rel="stylesheet" href="style/style.css">
    <style type="text/css">
        .img-thumbnail {
            width: 70px !important;
            height: 70px !important;
        }

        td {
            text-align: left;
            vertical-align: middle;
        }

        tr {
            text-align: center;
        }

        .userImage {
            width: 100px;
            height: auto;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav>
        <div>
        <a href="../dashboard.php"><img src="pictures/pfote.webp" alt="pfote" width="50px"></a></div>
        <div><a href="actions/create.php">Add animal</a></div>
        <div><?php echo $logout?></div> 
        <div><?php echo $dash?></div> 
        <div><?php echo $register?></div>
    </nav>
    <div class="d-flex justify-content-center mt-5">
                <div class="text-center">
                    <img src="pictures/admavatar.png" alt=" avatar" class="rounded-circle img-fluid" style="width: 150px;">
                    <h2 class="my-4">Administrator</h2>
                </div>
            </div>
    <div class="container d-flex">
      <div class="row gap-4 justify-content-center">
          <?php echo $content; ?>
        </div>
    </div>

</body>
</html>