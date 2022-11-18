<?php
require_once '../components/db_connect.php';

if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM animal WHERE animalID = {$id}";
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
    <title>Update</title>
    <?php require_once "../components/boot.php"; ?>
            <!-- Styling -->
            <link rel="stylesheet" href="../style/style.css">

    <style type="text/css">
    fieldset {
        margin: auto;
        margin-top: 100px;
        width: 60%;
    }

    tr {
        font-size: 20px;
    }

    .img-thumbnail {
        width: 70px !important;
        height: 70px !important;
    }
    </style>
</head>

<body>
        <!-- NAVBAR -->
 <!-- NAVBAR -->
 <nav>
        <div>
        <a href="../dashboard.php"><img src="../pictures/pfote.webp" alt="pfote" width="50px"></a></div>
    </nav>
    <fieldset>
        <legend class='h2'>Update request <img class='img-thumbnail rounded-circle' src='../pictures/<?= $picture ?>'
                alt=""></legenad>
        <form action="a_update.php" method="post" enctype="multipart/form-data">
            <table class="table">
            <tr>
                    <th>Name</th>
                    <td><input class='form-control' type="text" name="name" value="<?= $name?>" placeholder="name" /></td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td><input class='form-control' type="text" name="gender" value="<?= $gender?>" placeholder="Gender" step="any" /></td>
                </tr>
                <tr>
                    <th>Picture</th>
                    <td><input class='form-control' type="file" name="picture" /></td>
                </tr>
                <tr>
                    <th>Location</th>
                    <td><input class='form-control' type="text" name="location" value="<?= $location?>" placeholder="Location" step="any" /></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><input class='form-control' type="text" name="description" value="<?= $description?>" placeholder="Description" step="any" /></td>
                </tr>
                <tr>
                    <th>Size</th>
                    <td><input class='form-control' type="text" name="size" value="<?= $size?>" placeholder="Size" step="any" /></td>
                </tr>
                <tr>
                    <th>Age</th>
                    <td><input class='form-control' type="number" name="age" value="<?= $age?>" placeholder="Age" step="any" /></td>
                </tr>
                <tr>
                    <th>Vaccination</th>
                    <td><input class='form-control' type="text" name="vaccinated" value="<?= $vaccinated?>" placeholder="Vaccination" step="any" /></td>
                </tr>
                <tr>
                    <th>Breed</th>
                    <td><input class='form-control' type="text" name="breed" value="<?= $breed?>" placeholder="Breed" step="any" /></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><input class='form-control' type="text" name="status" value="<?= $status?>" placeholder="Status" step="any" /></td>
                </tr>
               
                <tr>
                <input type="hidden" name="id" value="<?= $id ?>" />
                <input type="hidden" name="picture" value="<?= $picture ?>" />
                    <td><button class='btn btn-success' type="submit">Update Animal</button></td>
                    <td><a href="../dashboard.php"><button class='btn btn-warning' type="button">Back</button></a></td>
                </tr>
            </table>
        </form>
    </fieldset>
</body>

</html>