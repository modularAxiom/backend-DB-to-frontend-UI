<!--Programmer Name: 73-->
<!--The page that the user is taken to after a valid userid is entered in the modify form. It gives-->
<!--the user the option to update the selected user's profile picture (image URL) as well as select-->
<!--new users to follow that the selected user is currently not following and unfollow users that-->
<!--the selected user is currently following. Submitted changes are completed in usermodified.php-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>User Modify</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
<?php
    include 'connectdb.php';
    include 'displayuserinfo.php';

    // $head_image = "https://icon-library.com/images/default-user-icon/default-user-icon-13.jpg";
    echo '<h1>You Are Modifying The Following User:</h1>';
    $selectedUser = $_POST["userid"];

    /** @var mysqli $connection */
    displayUserInfo($connection, $selectedUser);
?>

<!--The user is given the option to enter a new image URL for the selected user and-->
<!--change who the selected user is following - upon form submission, the user is taken-->
<!--to a new page showing the changes made to the selected user-->
<h2>User Modification Options:</h2>
<form id="modifyUserOptions" method="post" action="usermodified.php">
    <fieldset>
        <legend>To Update This User's Information, Please Use The Interface Below:</legend>
        <label for="image">Change Profile Picture (New Image URL):
            <input type="url" name="image" maxlength="100">
        </label><br>

        <!--The multipleSelection class is utilized to create a dropdown list of checkboxes to unfollow-->
        <!--users currently followed-->
        <div class="multipleSelection">
            <div class="selectBox" id="following" onclick="showCheckboxes(this)">
                <label>Unfollow Users From A List Of Users Currently Followed (Optional):
                    <select>
                        <option>Select Users To Unfollow</option>
                    </select>
                </label>
                <div class="overSelect"></div>
            </div>
            <div id="followingCheckboxes">
                <?php
                $queryType = 'following';
                include 'getfollowing.php';
                ?>
            </div>
        </div>

        <!--The multipleSelection class is utilized to create a dropdown list of checkboxes to follow-->
        <!--users currently not followed-->
        <div class="multipleSelection">
            <div class="selectBox" id="not_following" onclick="showCheckboxes(this)">
                <label>Follow New Users From A List Of Users Currently Not Followed (Optional):
                    <select>
                        <option>Select Users To Follow</option>
                    </select>
                </label>
                <div class="overSelect"></div>
            </div>
            <div id="notFollowingCheckboxes">
                <?php
                $queryType = 'notFollowing';
                include 'getfollowing.php';
                ?>
            </div>
        </div>

        <input type="hidden" name="userid" value="<?php echo htmlspecialchars($selectedUser); ?>">
        <input type="submit" name="make_changes" id="make_changes" value="Make Changes">
    </fieldset>
</form>
<?php
    /** @var mysqli $connection */
    mysqli_close($connection);
?>
</body>
</html>