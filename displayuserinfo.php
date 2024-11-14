
<?php
// Programmer Name: 73
// This file contains the displayUserInfo utility function, which displays a users data on
// on the page it is called on, including the user's followers and who they are following
   function displayUserInfo($connection, $selectedUser){
       // default profile picture to display if the selected user does not currently have
       $head_image = "https://icon-library.com/images/default-user-icon/default-user-icon-13.jpg";
       echo '<fieldset name="chosen_user">';

       // fetch the selected user's data and display it on the page
       $query1 = 'SELECT * FROM user WHERE userid="' . $selectedUser . '"';
       /** @var mysqli $connection */
       $result1=mysqli_query($connection,$query1);
       if (!$result1) {
           die("database queryGetUser failed.");
       }
       $row1=mysqli_fetch_assoc($result1);
       if (!empty($row1["image"])){
           echo '<img src="' . $row1["image"] . '" height="80" width="80">';
       }
       else {
           echo '<img src="' . $head_image . '" height="80" width="80">';
       }
       echo '<br>';
       echo '<h2>';
       echo $row1["firstname"] . " " . $row1["lastname"];
       echo '</h2>';
       echo '<h3>';
       echo 'UserID:  ' . $row1["userid"] . '<br>';
       echo '</h3>';
       echo '<br>';
       mysqli_free_result($result1);

       // fetch the users that the selected user is following and list them on the page
       $query2 = 'SELECT userid, firstname, lastname FROM user, follows WHERE userid = following 
                                                                AND follower = "' . $selectedUser . '"';
       $result2=mysqli_query($connection,$query2);
       if (!$result2) {
           die("database query2 failed.");
       }
       if (!$row2=mysqli_fetch_assoc($result2)){
           echo '<h3>This User Does Not Follow Anyone</h3><br>';
       }
       else{
           echo '<h3>Following:</h3>';
           echo '<ul>';
           echo '<h3>';
           echo '<li>';
           echo $row2["firstname"] . " " . $row2["lastname"] . " " . "(" . $row2["userid"] . ")";
           while ($row2=mysqli_fetch_assoc($result2)) {
               echo '<li>';
               echo $row2["firstname"] . " " . $row2["lastname"] . " " . "(" . $row2["userid"] . ")";
           }
           echo '</h3>';
           echo '</ul>';
       }
       mysqli_free_result($result2);

       // fetch the selected user's followers and list them on the page
       $query3 = 'SELECT userid, firstname, lastname FROM user, follows WHERE userid = follower 
                                                                AND following = "' . $selectedUser . '"';
       $result3=mysqli_query($connection,$query3);
       if (!$result3) {
           die("database query3 failed.");
       }
       if (!$row3=mysqli_fetch_assoc($result3)){
           echo '<h3>This User Does Not Have Any Followers</h3><br>';
       }
       else{
           echo '<h3>Followers:</h3>';
           echo '<ul>';
           echo '<h3>';
           echo '<li>';
           echo $row3["firstname"] . " " . $row3["lastname"] . " " . "(" . $row3["userid"] . ")";
           while ($row3=mysqli_fetch_assoc($result3)) {
               echo '<li>';
               echo $row3["firstname"] . " " . $row3["lastname"] . " " . "(" . $row3["userid"] . ")";
           }
           echo '</h3>';
           echo '</ul>';
       }
       mysqli_free_result($result3);
       echo '</fieldset>';
   }
?>