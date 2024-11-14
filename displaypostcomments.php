
<?php
// Programmer Name: 73
// Function displays basic information of selected post and then displays all the comments made
// on that post, as well as each commenter's basic information and the date the comment was made
    function displayPostComments($connection, $selectedPost){

        echo '<fieldset name="chosen_post">';
        // Retrieve and display basic information for selected post with indentation formatting for
        // better readability
        $queryPost = 'SELECT * FROM user, post WHERE postid="' . $selectedPost . '" AND 
                                                                                post.userid = user.userid';
        /** @var mysqli $connection */
        $resultPost=mysqli_query($connection,$queryPost);
        if (!$resultPost) {
            die("Error: Select query, queryPost, failed.");
        }
        $rowPost=mysqli_fetch_assoc($resultPost);

        echo '<br>';
        echo '<div class="post_display">';
        echo '<h2>';
        echo 'POST BY: ' . $rowPost["firstname"] . " " . $rowPost["lastname"] . "<br>";
        echo '</h2>';
        echo '<h3>';
        echo '<pre>';
        echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . 'POST:    ' . '"' . $rowPost["posttext"] . '"' . "<br>" .
             '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . 'MADE ON:  ' . $rowPost["postdate"] . '</pre>';
        echo '</h3>';
        echo '</div>';

        mysqli_free_result($resultPost);

        // Retrieve and display information for each comment made on selected post with additional
        // formatting for better readability
        $queryPostComments = 'SELECT * FROM user, post, comments WHERE post.postid="' . $selectedPost . '"
                                     AND post.postid = comments.postid AND comments.userid = user.userid';
        $resultPostComments=mysqli_query($connection,$queryPostComments);
        if (!$resultPostComments) {
            die("Error: Select query, queryPostComments, failed.");
        }

        if (!$rowPostComments=mysqli_fetch_assoc($resultPostComments)){
            echo '<h3>This Post Has No Comments</h3><br>';
        }
        else{
            echo '<h3>Comments:</h3>';
            echo '<ul>';
            echo '<h3>';
            echo '<li>';
            echo $rowPostComments["firstname"] . " " . $rowPostComments["lastname"] .
                ': ' . '"' . $rowPostComments["commenttext"] . '"' .
                ' --' . $rowPostComments["commentdate"];
            while ($rowPostComments=mysqli_fetch_assoc($resultPostComments)) {
                echo '<li>';
                echo $rowPostComments["firstname"] . " " . $rowPostComments["lastname"] .
                    ': ' . '"' . $rowPostComments["commenttext"] . '"' .
                    ' --' . $rowPostComments["commentdate"];
            }
            echo '</h3>';
            echo '</ul>';
        }
        mysqli_free_result($resultPostComments);

        echo '</fieldset>';
    }
?>

