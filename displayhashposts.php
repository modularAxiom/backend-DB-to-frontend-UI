
<?php
    // Programmer Name: 73
    // Function displays selected hashtag information and all the posts in which the hashtag was used
    function displayHashPosts($connection, $selectedHashtag){

        echo '<fieldset name="chosen_hashtag">';

        $queryHashtag = 'SELECT * FROM hashtag WHERE hashtagid="' . $selectedHashtag . '"';
        /** @var mysqli $connection */

        $resultHashtag=mysqli_query($connection,$queryHashtag);
        if (!$resultHashtag) {
            die("Error: Select query, queryHashtag, failed.");
        }
        $rowHashtag=mysqli_fetch_assoc($resultHashtag);
        $yesOrNo = "";
        if ($rowHashtag["trending"]) {
            $yesOrNo = "YES";
        }
        else {
            $yesOrNo = "NO";
        }
        // Display basic attributes of selected hashtag
        echo '<br>';
        echo '<h2>';
        echo $rowHashtag["hashtagtext"];
        echo '</h2>';
        echo '<h3>';
        echo '<pre>';
        echo 'HashtagID:     ' . $rowHashtag["hashtagid"] . '<br>';
        echo 'Trending:      ' . $yesOrNo . '<br>';
        echo 'Date Created:  ' . $rowHashtag["hashtagdate"] . '<br>';
        echo '</pre>';
        echo '</h3>';
        mysqli_free_result($resultHashtag);

        // Retrieve all posts associated with selected hashtag and display them indentation formatting
        // for improved readability
        $queryHashOnPost = 'SELECT * FROM hashonpost, post, user WHERE hashtagid = "'
                                    . $selectedHashtag . '" AND hashonpost.postid = post.postid AND 
                                                                                post.userid = user.userid';
        $resultHashOnPost=mysqli_query($connection,$queryHashOnPost);
        if (!$resultHashOnPost) {
            die("Error: Select query, queryHashOnPost, failed.");
        }

        if (!$rowHashOnPost=mysqli_fetch_assoc($resultHashOnPost)){
            echo '<h3>This Hashtag Has Not Been Used In Any Posts</h3><br>';
        }
        else{
            echo '<h3>Associated Posts:</h3>';
            echo '<ul>';
            echo '<h3>';

            echo '<li>';
            echo '<pre>';
            echo 'POST BY: ' . $rowHashOnPost["firstname"] . " " . $rowHashOnPost["lastname"] . "<br>" .
                 '     POST:    ' . '"' . $rowHashOnPost["posttext"] . '"' . "<br>" .
                 '     MADE ON:  ' . $rowHashOnPost["postdate"] . '</pre>';
            while ($rowHashOnPost=mysqli_fetch_assoc($resultHashOnPost)) {
                echo '<li>';
                echo '<pre>';
                echo 'POST BY: ' . $rowHashOnPost["firstname"] . " " . $rowHashOnPost["lastname"] . "<br>" .
                    '     POST:    ' . '"' . $rowHashOnPost["posttext"] . '"' . "<br>" .
                    '     MADE ON:  ' . $rowHashOnPost["postdate"] . '</pre>';
            }
            echo '</h3>';
            echo '</ul>';
        }
        mysqli_free_result($resultHashOnPost);

        echo '</fieldset>';
    }
?>
