<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
try {
    $conn = new mysqli($servername, $username, $password, "mysql");
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if (!$_POST == null) {
    if (isset($_GET['submit']) && isset($_POST['submit'])) {
        //KH: array_pop in this instance deletes the final array element
        //in the array sent by $_POST. This could be saved as a variable
        //if formatted like so:
        //$lastElement = array_pop($_POST);
        array_pop($_POST);
    }

    $values = array_values($_POST);
    var_dump($values);

    $contact_fname = $values[0];
    $contact_lname = $values[1];
    $contact_email = $values[2];
    $contact_dob = $values[3];
    $contact_user_comments = $values[4];

       $values = array_values($_POST);
        var_dump($values);

    $sqlInsert = "INSERT INTO `contact_info_submission` (`dob`, `email`, `fname`, `lname`, `user_comment`)
VALUES ('$contact_dob', '$contact_email', '$contact_fname', '$contact_lname', '$contact_user_comments')";
    echo $sqlInsert;
    $results = $conn->query($sqlInsert);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Contact Information</title>
    <link rel="stylesheet" href="css/contact_info.css">
    <script src="js/jquery-3.4.1.slim.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</head>

<body>
    <div class="container">

        <!--Main banner goes here-->
        <div class="banner">
            <img src="imgs/banner_main_page_title.png">
            <div class="banner_title">Contact Information</div>
        </div>

        <!--Searchbar goes here-->
        <div class="search">
            <a href="main_page.php">Home</a>
            <a class="active" href="Contact_Info.php">Contact Us</a>
            <a href="Cart.html">Your Cart</a>
            <form name="searchForm" action="search_results.html">
                <input name="searchInp" class="padding_top" type="text" placeholder="Search...">
            </form>
        </div>


        <p>This is the page where contact information will go. It will also include several photos. The form below is included to allow for clients to directly input their contact
            details and any questions they may have.
        </p>

        <!--This section will contain images of the various stages of the
    fight. No links required-->

        <div class="form">
            <form action="?submit" method="post">
                <label for="fname">First Name:</label><br>
                <input type="text" id="fname" name="fname"><br>
                <label for="lname">Last Name:</label><br>
                <input type="text" id="lname" name="lname"><br>
                <!--Email not working... -->
                <label for="email">Email Address:</label><br>
                <input type="text" id="email" name="email" size="50" maxlength="130"><br>
                <label for="dob">Date of Birth</label><br>
                <input type="date" id="dob" name="dob"><br>
                <label for="notes">Please enter any questions you have here (2000 characters):</label><br>
                <textarea type="text" id="notes" name="notes" size="2000" maxlength="2000" rows="6" cols="50"></textarea><br>
                <input type="submit" value="Submit"></input>
            </form>
        </div>
        <div class="images">
            <img src="https://via.placeholder.com/250x250">
            <img src="https://via.placeholder.com/250x250">
            <img src="https://via.placeholder.com/250x250">
            <img src="https://via.placeholder.com/250x250">
        </div>
    </div>
</body>

</html>