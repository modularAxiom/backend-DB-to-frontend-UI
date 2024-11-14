<!--Programmer Name: 73-->
<!--The page the user is taken to after submission of the viewPostsForm. Displays the selected post-->
<!--and its associated comments using the displayPostComments utility function-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Post Info</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
<?php
    include 'connectdb.php';
    include 'displaypostcomments.php';

    // $head_image = "https://icon-library.com/images/default-user-icon/default-user-icon-13.jpg";

    $selectedPost = $_POST["Posts"];
    echo '<h1>You Have Selected:</h1>';

    /** @var mysqli $connection */
    displayPostComments($connection, $selectedPost);

    mysqli_close($connection);
?>
</body>
</html>

