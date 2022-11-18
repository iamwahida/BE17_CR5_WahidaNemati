<?php
require_once "components/db_connect.php";
require_once "components/boot.php";

    if ($_GET['id']) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM animal WHERE animalID = $id";
        $result = mysqli_query($connect, $sql);

        if (mysqli_num_rows($result) == 1) {
            $data = mysqli_fetch_assoc($result);
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

        } else {
            header("location: error.php");
        }

    } else {
        header("location: error.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <!-- Styling -->
    <link rel="stylesheet" href="style/style.css">

    <style>
        li {
            margin: 0;
            padding: 5px 0 5px 30px;
            list-style: none;
            background-image: url("animal-pictures/pfote.webp");
            background-repeat: no-repeat;
            background-position: left center;
            background-size: 20px;
        }
    </style>

</head>
<body>
    <!-- NAVBAR -->
    <nav>
        <div><img src="animal-pictures/pfote.webp" alt="pfote" width="50px">
        <a href="home.php"></a></div>
        <div><a href="juniors.php">Juniors</a></div>
        <div><a href="seniors.php">Seniors</a></div>
        <div><a href="home.php">All pets</a></div>
    </nav>

    <!-- ALLS ANIMALS -->
    <div class="titel1"><p>Details of the specific pet</p></div>
    <div class="container d-flex justify-content-center mt-5 mb-5">
    <div class="card mb-3" style="max-width: 600px;">
    <div class="row g-0">
    <div class="col-md-4 p-3">
      <img src='animal-pictures/<?php echo $picture?>' width='100%' class="img-fluid" alt="<?php echo $name ?>">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <p class="mb-3 card-title" 
        style = "font-weight: bold;
                text-align: center;
                font-size: 35px;
                color: white;
                text-shadow: 1px 1px 2px black;
                background-color: pink;"><?= $name?></p>
             <p class="card-text"><?= $description?></p>
        <ul>
            <li><strong>Gender: </strong><?= $gender ?></li>
            <li><strong>Age: </strong><?= $age?></li>
            <li><strong>Vaccination: </strong><?= $vaccinated ?></li>
            <li><strong>Breed: </strong><?= $breed ?></li>
            <li><strong>Location: </strong><?= $location ?></li>
            <li><strong>Status: </strong><?= $status ?></li>
        </ul>
      </div>
    </div>
  </div>
</div>
    </div>

</div>
</body>
</html>