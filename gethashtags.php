
<?php
    // Programmer Name: 73
    // Creates a dynamically generated list of hashtags to be selected as radio buttons by the user in
    // the viewHashtagsForm. Once a hashtag is selected, the user can look up that hashtag
    $queryGetHashtags = "SELECT * FROM hashtag";

    /** @var mysqli $connection */
    $result = mysqli_query($connection,$queryGetHashtags);
    if (!$result) {
        die("Error: Select query, queryGetHashtags, failed.");
    }
    echo "<legend>Select A Hashtag To View All The Posts Currently Using It:</legend>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<input type="radio" name="Hashtags" value="';
        echo $row["hashtagid"];
        echo '" onclick="showHideOptions(this)">';
        echo $row["hashtagtext"] . " " . "(" . $row["hashtagid"] . ")" . "<br>";
    }
    mysqli_free_result($result);
?>
