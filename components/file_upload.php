<?php
require_once "db_connect.php";

function file_upload($picture, $source = "user")
{
    $result = new stdClass(); //this object will carry status from file upload
    if (isset($_SESSION['adm'])) {
        $result->fileName = 'product.png';
    } else {
        $result->fileName = 'avatar.png';
    }
    // empty object
    $result = new stdClass();
    // var_dump_pretty($result);
    // default picture
    $result->fileName = 'avatar.png';
    $result->error = 1;
    //collect data from object $picture
    $fileName = $picture["name"];
    $fileType = $picture["type"];
    $fileTmpName = $picture["tmp_name"];
    $fileError = $picture["error"];
    $fileSize = $picture["size"];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $filesAllowed = ["png", "jpg", "jpeg", "webp"];

    if ($fileError == 4) {
        $result->ErrorMessage = "No picture was chosen. It can always be updated later.";
        return $result;
    } 
    // some criteria need to be checked
    else {
        if (in_array($fileExtension, $filesAllowed)) {
            if ($fileError === 0) {
                if ($fileSize < 500000) { //number is in bytes
                    //it gives a file name based microseconds, new file name will be created
                    $fileNewName = uniqid('') . "." . $fileExtension; // 1233343434.jpg i.e
    
                        $destination = "pictures/$fileNewName";
                 
                    if (move_uploaded_file($fileTmpName, $destination)) {
                        $result->error = 0;
                        $result->fileName = $fileNewName;
                        return $result;
                    } else {
                        $result->ErrorMessage = "There was an error uploading this file.";
                        return $result;
                    }
                } else {
                    $result->ErrorMessage = "This picture is bigger than the allowed 500Kb. <br> Please choose a smaller one and update the product.";
                    return $result;
                }
            } else {
                $result->ErrorMessage = "There was an error uploading - $fileError code. Check the PHP documentation.";
                return $result;
            }
        } else {
            $result->ErrorMessage = "This file type can't be uploaded.";
            return $result;
        }
    }
}
