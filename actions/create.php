<?php
session_start();
require_once '../components/db_connect.php';

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}
if (isset($_SESSION['user'])) {
    header("Location: ../home.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once '../components/boot.php' ?>
    <title>Add animal</title>
        <!-- Styling -->
        <link rel="stylesheet" href="../style/style.css">
    <style>
        fieldset {
            margin: auto;
            margin-top: 100px;
            width: 60%;
        }

        tr {
            font-size: 20px;
        }

        input {
            font-size: 20px;
        }
    </style>
</head>

<body>
     <!-- NAVBAR -->
     <nav>
        <div>
        <a href="../dashboard.php"><img src="../pictures/pfote.webp" alt="pfote" width="50px"></a></div>
        <div><a href="../dashboard.php">Dashboard</a></div>
    
    </nav>

    <fieldset>
        <legend class='h2'>Add Animal</legend>
        <form action="a_create.php" method="post" enctype="multipart/form-data">
            <table class='table'>
                <tr>
                    <th>Name</th>
                    <td><input class='form-control' type="text" name="name" placeholder="Name" /></td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td><input class='form-control' type="text" name="gender" placeholder="Gender" step="any" /></td>
                </tr>
                <tr>
                    <th>Picture</th>
                    <td><input class='form-control' type="file" name="picture" /></td>
                </tr>
                <tr>
                    <th>Location</th>
                    <td><input class='form-control' type="text" name="location" placeholder="Location" step="any" /></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><input class='form-control' type="text" name="description" placeholder="Description" step="any" /></td>
                </tr>
                <tr>
                    <th>Size</th>
                    <td><input class='form-control' type="text" name="size" placeholder="Size" step="any" /></td>
                </tr>
                <tr>
                    <th>Age</th>
                    <td><input class='form-control' type="number" name="age" placeholder="Age" step="any" /></td>
                </tr>
                <tr>
                    <th>Vaccination</th>
                    <td><input class='form-control' type="text" name="vaccinated" placeholder="Vaccination" step="any" /></td>
                </tr>
                <tr>
                    <th>Breed</th>
                    <td><input class='form-control' type="text" name="breed" placeholder="Breed" step="any" /></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><input class='form-control' type="text" name="status" placeholder="Status" step="any" /></td>
                </tr>
               
                <tr>
                    <td><button class='btn btn-success' type="submit">Insert Animal</button></td>
                    <td><a href="../dashboard.php"><button class='btn btn-warning' type="button">Back</button></a></td>
                </tr>
            </table>
        </form>
    </fieldset>
</body>

</html>