<?php
session_start();
include "conn.php";
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$approved = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

$filename = $_FILES['fileToUpload']['name'];

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
    if ($_SESSION["username"] == "holros") {
        $sql = "INSERT INTO uploads (filename, user, uploadtime, snuskig)
        VALUES ('$filename', '" . $_SESSION["username"] . "', NOW(), TRUE)";
        $conn->query($sql);
    } else {
        $test =  $_SESSION["username"];
        $sql = "INSERT INTO uploads (filename, user, uploadtime) VALUES ('$filename', '$test', NOW())";
        $result = $conn->query($sql);
    }
} else {
    echo "Sorry, there was an error uploading your file.";
}
