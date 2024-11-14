
<?php
    // Programmer Name: 73
    // This file either retrieves a list of users, or a list of users the selected user is following
    // or not following (in the form of a dropdown checkbox list) depending on what value is set for
    // the queryType variable on the page where this file is included on
    // State all query variables for file readability
    $queryUsers = "";
    $queryFollowing = "";
    $queryNotFollowing = "";

     // Check if queryType is set
    if (isset($queryType)) {
        $selectedUser = "";
        switch ($queryType) {
            case 'queryUsers':
                // retrieves a dropdown checkbox list of all users - used in the add form to allow
                // the site user to select the people the new user being added would like to follow
                $queryUsers = 'SELECT userid, firstname, lastname FROM user';
                /** @var mysqli $connection */
                $result = mysqli_query($connection, $queryUsers);
                break;
            case 'following':
                // retrieves a dropdown checkbox list of users currently followed - used in the modify
                // form to allow the site user to unfollow users that the selected user is following
                $selectedUser = $_POST["userid"];
                $queryFollowing = 'SELECT userid, firstname, lastname FROM user, follows WHERE 
                                            userid = following AND follower = "' . $selectedUser . '"';
                /** @var mysqli $connection */
                $result = mysqli_query($connection, $queryFollowing);
                break;
            case 'notFollowing':
                // retrieves a dropdown checkbox list of users currently not followed - used in the
                // modify form to allow the site user to follow new users the selected user is not
                // following
                $selectedUser = $_POST["userid"];
                $queryNotFollowing = 'SELECT userid, firstname, lastname FROM user 
                                        WHERE userid NOT IN (SELECT following FROM follows WHERE 
                                                                    follower = "' . $selectedUser . '")';
                /** @var mysqli $connection */
                $result = mysqli_query($connection, $queryNotFollowing);
                break;
            default:
                $queryUsers = 'SELECT userid, firstname, lastname FROM user';
                /** @var mysqli $connection */
                $result = mysqli_query($connection, $queryUsers);
        }

        if (!$result) {
            die("Error: select query," . $queryType .  ", failed.");
        }

        // dynamically generate dropdown checkbox list of users in the database based on queryType
        $name = $queryType . "[]";
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<label for="' . $row["userid"] . '">
                  <input type="checkbox" name="' . $name . '" id="' . $row["userid"] .
                    '" value="' . $row["userid"] . '">'
                    . $row["firstname"] . ' ' . $row["lastname"] . ' ' . '(' . $row["userid"] . ')' .'
                  </label>';
        }
        mysqli_free_result($result);
    }

?>
