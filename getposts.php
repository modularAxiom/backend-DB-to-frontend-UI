
<?php
    // Programmer Name: 73
    // Display all posts as radio buttons  so that the user may select one to look up
    // Additional indentation formatting on list of posts is done so that they are listed
    // using a more intuitive display
    $queryGetPosts = "SELECT * FROM post, user WHERE post.userid = user.userid ORDER BY firstname";

    /** @var mysqli $connection */
    $resultGetPosts = mysqli_query($connection,$queryGetPosts);
    if (!$resultGetPosts) {
        die("Error: Select query, queryGetPosts, failed.");
    }
    echo "<legend>Select A Post To View All The Comments On That Post:</legend>";
    while ($row = mysqli_fetch_assoc($resultGetPosts)) {
        echo '<div class="post_options">';
        echo '<input type="radio" name="Posts" value="';
        echo $row["postid"];
        echo '" onclick="showHideOptions(this)">';
        echo 'POST BY: ' . $row["firstname"] . " " . $row["lastname"] . "<br>";
        echo '<pre>';
        echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . 'POST:    ' . '"' . $row["posttext"] . '"' . "<br>" .
             '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . 'MADE ON:  ' . $row["postdate"] . '</pre>';
        echo '</div>';
    }
    mysqli_free_result($resultGetPosts);
?>

