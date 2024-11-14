<!--Programmer Name: 73-->
<!--This file contains the page the user is taken to after selecting a user in the "view users" form-->
<!--in the main menu. The page displays the users information via the displayUserInfo utility function-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>User Info</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
<?php
    include 'connectdb.php';
    include 'displayuserinfo.php';

    // $head_image = "https://icon-library.com/images/default-user-icon/default-user-icon-13.jpg";

    $selectedUser = $_POST["Users"];
    echo '<h1>You Have Selected:</h1>';

    /** @var mysqli $connection */
    displayUserInfo($connection, $selectedUser);

    mysqli_close($connection);
?>
</body>
</html>