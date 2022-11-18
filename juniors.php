<?php
require_once "components/db_connect.php";
require_once "components/boot.php";

session_start();
if (isset($_SESSION['adm'])) {
    header('Location: dashboard.php');
    exit;
}
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$logout ="";

// USER DATA
$status = 'adm';
$sqli = "SELECT * FROM users WHERE status != '$status'";
$resulti = mysqli_query($connect, $sqli);
$body = '';
$dash = '';
if ($resulti->num_rows > 0) {
    while ($row = $resulti->fetch_array(MYSQLI_ASSOC)) {
        $body = $row['first_name'];
        $img = $row['picture'];
        $logout = " <a href='logout.php?logout'>Logout</a>";
        $dash = "<a href='dashboard.php'>Dashboard</a>";

    }
} else {
    $body = "No Data Available";
    $img = "No Data Available";
    $logout = " <a href='login.php'>Login</a>";
}


$sql = "Select * from animal where age < 8";
$result = mysqli_query($connect, $sql);
$content = "";

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $content .= "
            <div class='card mt-5 mb-2' style='width: 20rem;'>
            <img src='pictures/". $row ['picture']."' width='100%' height = '50%' class='p-2 card-img-top' alt='animal-pictures/". $row ['picture']."'>
            <div class='card-body'>
            <p class='card-title'>". $row ['name']."</p>
            <p class='card-text'><strong>Breed: </strong>". $row ['breed']."</p>
            <p class='card-text'><strong>Age: </strong>". $row ['age']."</p>
            <p class='card-text'><strong>Vaccinated: </strong>". $row ['vaccinated']."</p>
            <p class='card-text'><strong>Status: </strong>". $row ['status']."</p>
            <a href='details.php?id=" . $row['animalID'] . "' class='btn fs-5'>Show details</a>
            </div>
            </div>
            ";
        }
    } else {
        $content = "No data available";
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Shop</title>
    <!-- Styling -->
    <link rel="stylesheet" href="style/style.css">


</head>
<body>
    <!-- NAVBAR -->
    <nav>
    <div>
    <a href="home.php"><img src="pictures/pfote.webp" alt="pfote" width="50px"></a></div>
        <div><a href="juniors.php">Juniors</a></div>
        <div><a href="seniors.php">Seniors</a></div>
        <div><a href="home.php">All pets</a></div>
        <div><?php echo $logout?></div> 
        <div><?php echo $dash?></div> 
    </nav>

  <!-- STATUS -->
    <div class="user">
    <img src="pictures/<?php echo $img?>" alt="Picture">
    <div class="welcome">Welcome <?php echo $body?>!
</div>
</div>

<hr>

    <!-- ALLS SENIORS -->
    <div class="titel1"><p>Juniors</p></div>
    <div class="container d-flex">
      <div class="row gap-4 justify-content-center">
          <?php echo $content; ?>
        </div>
    </div>


</div>
</body>
</html>