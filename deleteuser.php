<!--Programmer Name: 73-->
<!--Performs user deletion and displays the information of the user deleted, or the user that was-->
<!--attempted to be deleted if the delete was unsuccessful, and displays the reason why-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>User Delete</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
<?php
    include 'connectdb.php';
    include 'displayuserinfo.php'
?>
<!--<h1>Success! You Have Deleted the User:</h1>-->

<?php
    if (isset($_POST["userid"])) {
        $selectedUser = $_POST["userid"];

        $queryGetUser = 'SELECT * FROM user WHERE userid="' . $selectedUser . '"';
        $queryGetFollowing = 'SELECT userid, firstname, lastname FROM user, follows WHERE userid = following 
                                                                    AND follower = "' . $selectedUser . '"';
        $queryGetFollowers = 'SELECT userid, firstname, lastname FROM user, follows WHERE userid = follower 
                                                                    AND following = "' . $selectedUser . '"';
        /** @var mysqli $connection */
        $resultGetFollowing = mysqli_query($connection, $queryGetFollowing);
        $resultGetFollowers = mysqli_query($connection, $queryGetFollowers);
        if (!$resultGetFollowing) {
            die("Error: select query, queryGetFollowing, failed.");
        }
        if (!$resultGetFollowers) {
            die("Error: select query, queryGetFollowers, failed.");
        }
        $rowGetFollowing = mysqli_fetch_assoc($resultGetFollowing);
        $rowGetFollowers = mysqli_fetch_assoc($resultGetFollowers);
        // If the user entered for deletion is following other users or has followers of their own, the
        // deletion is prevented from proceeding and the reason why is displayed
        if ($rowGetFollowing || $rowGetFollowers) {
            echo '<h1>You Cannot Delete This User, Because They Are</h1>';
            echo '<h1>Being Followed, Or Following Other Users:</h1>';
            displayUserInfo($connection, $selectedUser);
            mysqli_free_result($resultGetFollowing);
            mysqli_free_result($resultGetFollowers);
        }
        // Otherwise, user deletion proceeds, first by deleting all the users comments and then the user
        // themselves - as the assignment only mentioned that deletion should be halted from proceeding
        // if the user is following or being followed, I have assumed that comments can be deleted along
        // with the user, even if they exist
        else {
            echo '<h1>You Have Deleted The Following User:</h1>';
            displayUserInfo($connection, $selectedUser);

            $queryDeleteComments = 'DELETE FROM comments WHERE userid="' . $selectedUser . '"';
            $queryDeleteUser = 'DELETE FROM user WHERE userid="' . $selectedUser . '"';
            // $head_image = "https://icon-library.com/images/default-user-icon/default-user-icon-13.jpg";

            /** @var mysqli $connection */
            if (!mysqli_query($connection, $queryDeleteComments)) {
                die("Error: delete query, queryDeleteComments, failed.");
            }
            /** @var mysqli $connection */
            if (!mysqli_query($connection, $queryDeleteUser)) {
                die("Error: delete query, queryDeleteUser, failed.");
            }
        }

        mysqli_close($connection);
    }
?>

</body>
</html>
