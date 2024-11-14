
<?php
    // Programmer Name: 73
    // Utility function to display the top 3 most followed users in the lookuptop3.php file
    // styled with CSS to ensure that all data that needs to be displayed about each user is
    // neatly separated into fieldsets and cleanly fits into each fieldset, along with the
    // user's rank in the top 3
    function displayTop3Users($connection){
        $head_image = "https://icon-library.com/images/default-user-icon/default-user-icon-13.jpg";

        $queryTop3 = 'SELECT userid, firstname, lastname, image, COUNT(follower) AS follow_count 
                                    FROM user LEFT JOIN follows ON userid = following GROUP BY userid 
                                                                        ORDER BY follow_count DESC LIMIT 3';
        /** @var mysqli $connection */
        $resultTop3=mysqli_query($connection,$queryTop3);
        if (!$resultTop3) {
            die("Error: Select query, queryTop3, failed.");
        }

        echo '<fieldset name="top3_users">';
        $rowTop3 = mysqli_fetch_assoc($resultTop3);
        $top3Rank = 1;
        do {
            echo '<fieldset name="top_user">';
            echo '<legend><span class="rank"># ' . $top3Rank . '.</span></legend>';
            $numFollowers = $rowTop3["follow_count"];
            if (!empty($rowTop3["image"])) {
                echo '<img src="' . $rowTop3["image"] . '" height="80" width="80">';
            } else {
                echo '<img src="' . $head_image . '" height="80" width="80">';
            }
            echo '<br>';
            echo '<div class="top3_display">';
            echo '<h2>';
            echo  $rowTop3["firstname"] . " " . $rowTop3["lastname"] . "<br>";
            echo '</h2>';
            echo '<pre>';
            echo '<h3>';
            echo  'UserID: ' . $rowTop3["userid"] . "<br>" .
                  'Followers: ' . $numFollowers;
            echo '</h3>';
            echo '</pre>';
            echo '</div>';
            echo '</fieldset><br>';

            $top3Rank++;
        }
        while ($rowTop3 = mysqli_fetch_assoc($resultTop3));
        echo '</fieldset>';

        mysqli_free_result($resultTop3);
    }
?>


