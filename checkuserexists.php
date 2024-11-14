<?php
    // Programmer Name: 73
    // This file checks whether a userid already exists in the database - used for form validation
    include 'connectdb.php';

    if (isset($_POST['userid'])) {
        $userId = $_POST['userid'];

        $query = "SELECT userid FROM user WHERE userid = '$userId'";
        /** @var mysqli $connection */
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "exists";
        }
        else {
            echo "not_exists";
        }

        mysqli_close($connection);
    }
?>

