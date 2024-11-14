
<?php
    // Programmer Name: 73
    // This file contains the php code that dynamically generates a list of all the users in
    // the database in the order that the site user desires, allowing them to then select one of
    // them to look up via radio buttons in the "view users" form (the 1st form) in the main menu
    $order = "";
    if (isset($_POST['ord_by_fn'])) {
        $order = $_POST['ord_by_fn'] == 'asc' ? 'firstname ASC' : 'firstname DESC';
    }
    elseif (isset($_POST['ord_by_ln'])) {
        $order = $_POST['ord_by_ln'] == 'asc' ? 'lastname ASC' : 'lastname DESC';
    }

    $query = "SELECT userid, firstname, lastname FROM user ORDER BY " . $order;

    /** @var mysqli $connection */
    $result = mysqli_query($connection,$query);
    if (!$result) {
        die("databases queryFollowing failed.");
    }
    echo "<legend>Which User are you looking up?</legend>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<input type="radio" name="Users" value="';
        echo $row["userid"];
        echo '" onclick="showHideOptions(this)">';
        echo $row["firstname"] . " " . $row["lastname"] . " " . "(" . $row["userid"] . ")" . "<br>";
    }
    mysqli_free_result($result);
?>
