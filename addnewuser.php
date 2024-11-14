<!--Programmer Name: 73-->
<!--The page that the user is taken to after successfully submitting the add form. It displays-->
<!--the new user's information via the displayUserInfo function-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>User Add</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
<?php
    include 'connectdb.php';
    include 'displayuserinfo.php';

?>
<!--<h1>Success! You Have Added the User:</h1>-->

<?php
    $UserId = $_POST["userid"];
    $firstName = $_POST["firstname"];
    $lastName = $_POST["lastname"];
    // Ensure that the image being inserted, if NULL, is actually interpreted by the display function
    // as NULL, and that if no users were selected to be followed, then usersFollowed is an empty array
    /** @var mysqli $connection */
    $image = !empty($_POST["image"]) ? "'" . mysqli_real_escape_string($connection, $_POST["image"]) . "'" : "NULL";
    $UsersFollowed = isset($_POST["queryUsers"]) ? $_POST["queryUsers"] : [];

    $queryUsers = 'SELECT userid FROM user';
    $queryInsertUser = "INSERT INTO user (userid, firstname, lastname, image) 
                                                VALUES ('$UserId', '$firstName', '$lastName', $image)";

    /** @var mysqli $connection */
    $result = mysqli_query($connection,$queryUsers);
    if (!$result) {
        die("Error: select query, queryUsers, failed.");
    }
    $existingUser = false;
    while ($rowUsers = mysqli_fetch_assoc($result)) {
        if ($UserId === $rowUsers["userid"]) {
            $existingUser = true;
            break;
        }
    }
    if ($existingUser) {
        echo "Error: A user with the same User ID already exists.";
    }
    elseif (!mysqli_query($connection, $queryInsertUser)) {
        die("Error: user insert query, queryInsertUser, failed." . mysqli_error($connection));
    }
    // If user insertion succeeds, proceed to insert all users selected to be followed, if there are any
    else {
        foreach ($UsersFollowed as $userFld){
            $data = [
                'follower' => $UserId,
                'following' => $userFld,
                'followyear' => 2024
            ];

            $queryInsertFollowing = 'INSERT INTO follows VALUES ("' . $data['follower'] .
                                        '", "' . $data['following'] . '", "' . $data['followyear'] . '")';
            if (!mysqli_query($connection, $queryInsertFollowing)) {
                die("Error: user insert query, queryInsertFollowing, failed." . mysqli_error($connection));
            }
        }

        echo '<h1>You Have Added The Following User:</h1>';
        $selectedUser = $UserId;
        displayUserInfo($connection, $selectedUser);
    }

    mysqli_close($connection);
?>

</body>
</html>
