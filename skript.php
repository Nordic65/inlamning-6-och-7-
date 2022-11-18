<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="logout.php">Sign out</a>
    <?php
    include "conn.php";

    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    $login_success = false;
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row["username"] == $_POST["username"] && $row["password"] == $_POST["password"]) {
                $login_success = true;
                echo " <br> Logged in as " . " " . $row["username"] . " " . " Welcome back! ";
                echo " <br> <a href='upload.php'>Upload a file</a>";
            }
        }
    } else {
        echo "0 results";
    }

    if (!$login_success) {
        echo "Wrong username or password ";
    }

    $conn->close();


    if ($login_success) {
        session_start();
        $_SESSION["username"] = $_POST["username"];
    }
    ?>
</body>

</html>