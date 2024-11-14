<!--Programmer Name: 73-->
<!--Displays the top 3 most followed users with the displayTop3Users function-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Top 3 Users Info</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
<?php
    include 'connectdb.php';
    include 'displaytop3users.php';

    // $head_image = "https://icon-library.com/images/default-user-icon/default-user-icon-13.jpg";

    echo '<h1>The Top Three Most Followed Users Are:</h1>';

    /** @var mysqli $connection */
    displayTop3Users($connection);

    mysqli_close($connection);
?>
</body>
</html>
