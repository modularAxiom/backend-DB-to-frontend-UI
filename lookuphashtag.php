<!--Programmer Name: 73-->
<!--Displays the hashtag selected in the viewHashtagsForm using the displayHashPosts-->
<!--utility function-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Hashtag Info</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
<?php
    include 'connectdb.php';
    include 'displayhashposts.php';

    // $head_image = "https://icon-library.com/images/default-user-icon/default-user-icon-13.jpg";

    $selectedHashtag = $_POST["Hashtags"];
    echo '<h1>You Have Selected The Hashtag:</h1>';

    /** @var mysqli $connection */
    displayHashPosts($connection, $selectedHashtag);

    mysqli_close($connection);
?>
</body>
</html>
