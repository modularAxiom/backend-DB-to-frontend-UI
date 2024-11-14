<!--Programmer Name: 73-->
<!--This file contains the main menu of the GUI for accessing and manipulating the database-->
<!--of the social media website. Each required functionality of the site can be accessed by-->
<!--forms separated by fieldsets, each of which can be used to initiate different tasks,-->
<!--which take the user to different pages to complete each of them.-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Social Media Site User Database</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
<?php
    include 'connectdb.php';
?>
<!--A user ordering options selection form with dynamic user data display and options allowing the-->
<!--user (of the site) to select a user from a list of users in the database and then look up that user-->
<h1>Welcome to Our Social Media Site's User Database</h1><br>
<h2>You Can View A List of Our Users Here:</h2>
<fieldset id="order_by">
    <legend>Please Select Your Preferred Ordering Scheme:</legend>
    <form name="list_users" method="post">
        <input type="radio" name="ord_by" id="fn" value="fn">
        <label for="fn">Order By First Name</label><br>
        <input type="radio" name="ord_by" id="ln" value="ln">
        <label for="ln">Order By Last Name</label><br>

        <fieldset id="order_by_firstname" disabled hidden>
            <legend>Which First Name Ordering Would You Like To Use?</legend>
            <input type="radio" name="ord_by_fn" id="asc_fn" value="asc">
            <label for="asc_fn">Ascending Order</label><br>
            <input type="radio" name="ord_by_fn" id="dsc_fn" value="dsc">
            <label for="dsc_fn">Descending Order</label><br>
        </fieldset>
        <fieldset id="order_by_lastname" disabled hidden>
            <legend>Which Last Name Ordering Would You Like To Use?</legend>
            <input type="radio" name="ord_by_ln" id="asc_ln" value="asc">
            <label for="asc_ln">Ascending Order</label><br>
            <input type="radio" name="ord_by_ln" id="dsc_ln" value="dsc">
            <label for="dsc_ln">Descending Order</label><br>
        </fieldset>
        <input type="submit" name="view_users" id="view_users" value="View Users" disabled>
    </form>
    <form action="lookupuser.php" method="post">
        <fieldset id="selectUser" hidden>
            <?php
                if (isset($_POST["view_users"])) {
                    echo '<script type="text/JavaScript"> 
                                document.getElementById("selectUser").hidden = false 
                          </script>';
                    include 'usersbyorder.php';
                }
            ?>
        <input type="submit" id="lookUpUser" value="Look Up User" disabled>
        </fieldset>
    </form>
</fieldset><br>

<!--A user insertion form that allows the user of the site to add a new user to the database-->
<!--Form validation is performed via the validateAddForm function to ensure valid data entry-->
<h2>Add A New User To The Database:</h2>
<form id="addUserForm"  action="addnewuser.php" method="post" onsubmit="return validateAddForm()">
    <fieldset>
        <legend>To Add A New User, Please Enter The Following Information:</legend>
        <label for="addUserid">User ID:
            <input type="text" id="addUserid" name="userid" required minlength="1" maxlength="8">
        </label><br>
        <label for="addFirstname">First Name:
            <input type="text" id="addFirstname" name="firstname" required minlength="1" maxlength="30">
        </label><br>
        <label for="addLastname">Last Name:
            <input type="text" id="addLastname" name="lastname" required minlength="1" maxlength="30">
        </label><br>
        <label for="addImage">Profile Picture (Image URL):
            <input type="url" id="addImage" name="image" maxlength="100">
        </label><br>
        <!--The multiple selection class allows the user to select which users they would like to-->
        <!--follow via a dropdown list of checkboxes-->
        <div class="multipleSelection">
            <div class="selectBox" id="query_users" onclick="showCheckboxes(this)">
                <label>Select Users That This User Wants to Follow (Optional):
                    <select name="select_selectUsers">
                        <option>Select Users</option>
                    </select>
                </label>
                <div class="overSelect"></div>
            </div>
            <div id="queryUsersCheckboxes">
                <?php
                $queryType = 'queryUsers';
                include 'getfollowing.php';
                ?>
            </div>
        </div>
        <input type="submit" name="add_new_user" id="add_new_user" value="Add New User">
    </fieldset>
</form><br>

<!--A user deletion form that allows the user of the site to remove a user from the database-->
<!--Form validation is performed via the validateDeleteForm function to ensure that a valid user-->
<!--is entered, or that the user entered can be deleted-->
<h2>Delete An Existing User From The Database:</h2>
<form id="deleteUserForm" method="post" action="deleteuser.php" onsubmit="return validateDeleteForm()">
    <fieldset>
        <legend>To Delete An Existing User, Please Enter That User's User ID:</legend>
        <label for="deleteUserid">User ID:
            <input type="text" id="deleteUserid" name="userid" required minlength="1" maxlength="8">
        </label><br>
        <input type="submit" name="delete_user" id="delete_user" value="Delete User">
    </fieldset>
</form><br>

<!--A user modification form that allows the user of the site to modify a user in the database-->
<!--Form validation is performed via the validateModifyForm function to ensure that a valid user-->
<!--is entered-->
<h2>Modify A User In The Database:</h2>
<form id="modifyUserForm" method="post" action="modifyuser.php" onsubmit="return validateModifyForm()">
    <fieldset>
        <legend>To Modify An Existing User, Please Enter That User's User ID:</legend>
        <label for="modifyUserid">User ID:
            <input type="text" id="modifyUserid" name="userid" required minlength="1" maxlength="8">
        </label><br>
        <input type="submit" name="modify_user" id="modify_user" value="Modify User">
    </fieldset>
</form><br>

<!--A form that allows the user to dynamically display a list of hashtags from the database and select-->
<!--one of them to look up, taking the user to a different page-->
<h2>View And Look Up Hashtags:</h2>
<fieldset id="viewHashtags">
    <legend>Click To View All Hashtags:</legend>
    <form id="viewHashtagsForm" method="post">
        <input type="submit" name="view_hashtags" id="view_hashtags" value="View Hashtags">
    </form>
    <form id="select_hashtag" method="post" action="lookuphashtag.php">
        <fieldset id="selectHashtag" hidden>
            <?php
            if (isset($_POST["view_hashtags"])) {
                echo '<script type="text/JavaScript"> 
                            document.getElementById("selectHashtag").hidden = false 
                      </script>';
                include 'gethashtags.php';
            }
            ?>
            <input type="submit" id="lookUpHashtag" value="Look Up Hashtag" disabled>
        </fieldset>
    </form>
</fieldset><br>

<!--Basic form to look up posts - The list of posts (radio buttons) is dynamically generated
    from the posts currently in the database, the user can select one, taking them to a different page-->
<h2>View And Look Up Posts:</h2>
<fieldset id="viewPosts">
    <legend>Click To View All Posts:</legend>
    <form id="viewPostsForm" method="post">
        <input type="submit" name="view_posts" id="view_posts" value="View Posts">
    </form>
    <form id="select_post" method="post" action="lookuppost.php">
        <fieldset id="selectPost" hidden>
            <?php
            if (isset($_POST["view_posts"])) {
                echo '<script type="text/JavaScript"> 
                            document.getElementById("selectPost").hidden = false 
                      </script>';
                include 'getposts.php';
            }
            ?>
            <input type="submit" name="lookUpPost" id="lookUpPost" value="Look Up Post" disabled>
        </fieldset>
    </form>
</fieldset><br>

<!--A form that, when submitted, immediately takes the user to a different page which displays the top-->
<!--3 most followed users (i.e., the top 3 users with the most followers-->
<h2>View The Top 3 Most Followed Users:</h2>
<fieldset id="viewTop3">
    <legend>Click To View The Top 3 Most Popular Users:</legend>
    <form id="viewTop3Form" method="post" action="lookuptop3.php">
        <input type="submit" name="view_top3" id="view_top3" value="View Top 3 Users">
    </form>
</fieldset><br>

<?php
    /** @var mysqli $connection */
    mysqli_close($connection);
?>

</body>
</html>

