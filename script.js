// Programmer Name: 73
// This javascript file (in conjunction with style.css) implements some functions that allow the
// user to interact with the social media database site via a somewhat dynamic GUI, and also implements
// some functions for various types of form submission validations

// Simple submit button toggle function that enables disabled "look up" buttons when the user makes
// selection in a preceding list of radio buttons
function showHideOptions(button) {
    console.log("Button clicked:", button.name);
    let lookUpUser = document.getElementById("lookUpUser");
    let lookUpHashtag = document.getElementById("lookUpHashtag");
    let lookUpPost = document.getElementById("lookUpPost");

    if (button.name === "Users") {
        console.log("Enabling lookUpUser");
        lookUpUser.disabled = false;
    }
    if (button.name === "Hashtags") {
        console.log("Enabling lookUpHashtag");
        lookUpHashtag.disabled = false;
    }
    if (button.name === "Posts") {
        console.log("Enabling lookUpPost");
        lookUpPost.disabled = false;
    }
}

// This group of event listeners toggle the visibility of ordering options (contained within fieldsets)
// in the initial "view users" form, depending on which ordering options the user has checked.
// Visibility toggle implemented with CSS
document.addEventListener('DOMContentLoaded', function() {
    function configNameOptions() {
        const orderOptions = document.querySelectorAll('input[name="ord_by"]');
        orderOptions.forEach(option => {
            option.addEventListener('click', function() {
                let targetFieldset = this.id === 'fn' ? 'order_by_firstname' : 'order_by_lastname';
                document.getElementById(targetFieldset).hidden = false;
                document.getElementById(targetFieldset).disabled = false;
                let otherFieldset = this.id === 'fn' ? 'order_by_lastname' : 'order_by_firstname';
                document.getElementById(otherFieldset).hidden = true;
                document.getElementById(otherFieldset).disabled = true;

                document.getElementById('view_users').disabled = true;
            });
        });
    }
    function configOrderingOptions() {
        const secondaryOptions = document.querySelectorAll('input[name="ord_by_fn"], input[name="ord_by_ln"]');
        secondaryOptions.forEach(option => {
            option.addEventListener('click', function() {
                document.getElementById('view_users').disabled = false;
            });
        });
    }
    configNameOptions();
    configOrderingOptions();
});

// This function governs the display behaviour of the three dropdown checkbox lists that are used in
// this website to allow the website user to change the users that a selected user follows. CSS is used
// to hide/show the dropdown lists when the user clicks on the select_box interface.
var showUsers = true;
var showFollowing = true;
var showNotFollowing = true;
function showCheckboxes(select_box) {
    var queryUsers_checkboxes = document.getElementById("queryUsersCheckboxes");
    var following_checkboxes = document.getElementById("followingCheckboxes");
    var notFollowing_checkboxes = document.getElementById("notFollowingCheckboxes");
    if (select_box.id === "following"){
        if (showFollowing) {
            following_checkboxes.style.display = "block";
            showFollowing = false;
        }
        else {
            following_checkboxes.style.display = "none";
            showFollowing = true;
        }
    }
    else if (select_box.id === "not_following") {
        if (showNotFollowing) {
            notFollowing_checkboxes.style.display = "block";
            showNotFollowing = false;
        }
        else {
            notFollowing_checkboxes.style.display = "none";
            showNotFollowing = true;
        }
    }
    else if (select_box.id === "query_users") {
        if (showUsers) {
            queryUsers_checkboxes.style.display = "block";
            showUsers = false;
        }
        else {
            queryUsers_checkboxes.style.display = "none";
            showUsers = true;
        }
    }
}

// This validation function for the add form checks whether the userid entered already exists, and if so,
// prevents form submission and prevents the user from adding an existing user
function validateAddForm() {
    var UserID = document.getElementById('addUserForm').elements['userid'].value;
    var firstName = document.getElementById('addUserForm').elements['firstname'].value;
    var lastName = document.getElementById('addUserForm').elements['lastname'].value;
    // Perform validation checks
    if (UserID.length === 0 || UserID.length > 8) {
        alert('Please enter a valid User ID (Min 1 to Max 8 characters).');
        return false;
    }
    if (firstName.length === 0 || firstName.length > 30) {
        alert('Please enter a valid First Name (max 30 characters).');
        return false;
    }
    if (lastName.length === 0 || lastName.length > 30) {
        alert('Please enter a valid Last Name (max 30 characters).');
        return false;
    }
    // An XMLHttpRequest checks whether the userid entered already exists on the backend, using the
    // checkuserexists.php file, and returns a warning message to the user on the front end if it does
    var xmlHttpRequest = new XMLHttpRequest();
    xmlHttpRequest.open("POST", "checkuserexists.php", true);
    xmlHttpRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
    xmlHttpRequest.onload = function () {
        console.log(this.responseText);
        if (this.responseText.trim() === "exists") {
            alert("A user with this User ID already exists. Please enter a different User ID.")
        }
        else {
            document.forms['addUserForm'].submit();
        }
    };
    xmlHttpRequest.send("userid=" + encodeURIComponent(UserID));

    return false;
}

// Similar to the add form validation, this function checks if the userid exists, but if so,
// gives a warning to the user and an option to back out of the deletion, otherwise, it displays
// an alert to the user
function validateDeleteForm() {
    var UserID = document.getElementById('deleteUserForm').elements['userid'].value;
    // Perform validation checks
    var xmlHttpRequest = new XMLHttpRequest();
    xmlHttpRequest.open("POST", "checkuserexists.php", true);
    xmlHttpRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
    xmlHttpRequest.onload = function () {
        console.log(this.responseText);
        if (this.responseText.trim() === "exists") {
            var confirmed = confirm("Are you sure you want to delete this user?")
            if (confirmed) {
                document.forms['deleteUserForm'].submit();
            }
            else {
                console.log("User deletion cancelled.")
            }
        }
        else {
            alert("This User ID does not exist. Please enter an existing User ID.")
        }
    };
    xmlHttpRequest.send("userid=" + encodeURIComponent(UserID));
    return false;
}

// Similar to the delete form validation, this function checks if the userid entered exists,
// and if not, it displays an alert to the user
function validateModifyForm() {
    var UserID = document.getElementById('modifyUserForm').elements['userid'].value;
    // Perform validation checks
    var xmlHttpRequest = new XMLHttpRequest();
    xmlHttpRequest.open("POST", "checkuserexists.php", true);
    xmlHttpRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
    xmlHttpRequest.onload = function () {
        console.log(this.responseText);
        if (this.responseText.trim() === "exists") {
            document.forms['modifyUserForm'].submit();
        }
        else {
            alert("This User ID does not exist. Please enter an existing User ID.")
        }
    };
    xmlHttpRequest.send("userid=" + encodeURIComponent(UserID));

    return false;
}

