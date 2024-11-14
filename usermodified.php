<!--Programmer Name: 73-->
<!--Completes the modification operations as selected in modifyuser.php and-->
<!--displays them to the user-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>User Modify</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
<?php
    include 'connectdb.php';
    include 'displayuserinfo.php';

    $selectedUser = $_POST["userid"];
    // Ensuring that display function properly interprets NULL image update and that empty checklists
    // are still usable as empty arrays
    /** @var mysqli $connection */
    $image = !empty($_POST["image"]) ? mysqli_real_escape_string($connection, $_POST["image"]) : NULL;
    $usersUnfollowed = isset($_POST["following"]) ? $_POST["following"] : [];
    $newUsersFollowed = isset($_POST["notFollowing"]) ? $_POST["notFollowing"] : [];

    // Update Image URL
    $queryUpdateImage = "UPDATE user SET image = ". ($image ? "'$image'" : "NULL") ." WHERE userid = '". $selectedUser ."'";
    $result = mysqli_query($connection,$queryUpdateImage);
    if (!$result) {
        die("Error: user update query, queryUpdateImage, failed." . mysqli_error($connection));
    }
    // Delete any users the selected user has checked as unfollowed
    foreach ($usersUnfollowed as $userUnFld){

        $data = [
            'follower' => $selectedUser,
            'following' => $userUnFld,
        ];

        $queryUnfollow = 'DELETE FROM follows WHERE follower="' . $data['follower'] . '" 
                                                    AND following="' . $data['following'] . '"';
        if (!mysqli_query($connection, $queryUnfollow)) {
            die("Error: user delete query, queryUnfollow, failed." . mysqli_error($connection));
        }
    }
    // Insert any users the selected user has checked as followed
    foreach ($newUsersFollowed as $newUserFld){

        $data = [
            'follower' => $selectedUser,
            'following' => $newUserFld,
            'followyear' => 2024
        ];

        $queryInsertFollowing = 'INSERT INTO follows VALUES ("' . $data['follower'] .
                                        '", "' . $data['following'] . '", "' . $data['followyear'] . '")';
        if (!mysqli_query($connection, $queryInsertFollowing)) {
            die("Error: user insert query, queryInsertFollowing, failed." . mysqli_error($connection));
        }
    }

    echo '<h1>You Have Modified The Following User:</h1>';

    /** @var mysqli $connection */
    displayUserInfo($connection, $selectedUser);

    /** @var mysqli $connection */
    mysqli_close($connection);
?>
</body>
</html>
