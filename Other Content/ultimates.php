<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
try {
    $conn = new mysqli($servername, $username, $password, "mysql");
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title> Ultimates</title>
    <link rel="stylesheet" href="../css/other_content/ultimates.css">
    <link rel="stylesheet" href="../css/style.css">

    <!-- Font Awesome Icon Library (as suggested on w3school)-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../js/jquery-3.4.1.slim.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/totalPrice.js"></script>

</head>

<body>
    <div class="container">
        <!--Main banner goes here-->
        <div class="banner">
            <img src="../imgs/banner_ultimates.png" style="max-width: 100%;">
            <div class="banner_title">Ultimates</div>
        </div>

        <!--Searchbar goes here-->
        <div class="search">
            <a href="../main_page.php">Home</a>
            <a href="../Contact_Info.php">Contact Us</a>
            <a href="../Cart.html">Your Cart</a>
            <a class="active">Ultimates</a>
            <form name="searchForm" action="../search_results.php">
                <input name="searchInp" class="padding_top" type="text" placeholder="Search...">
            </form>
        </div>

        <!--Only works if botton type rather than button class------------------------------------------------------------------------------------>
        <div class="add_all_button">
            <button type="button">Add Everything to Cart</button>
        </div>

        <p>Filler text lalalalala</p>

        <!--This section will contain images of the various stages of the
    fight. No links required-->
        <?php
        $sql2 = "SELECT * FROM `products_all` WHERE `item_desc` LIKE '%(Ultimate)'";
        $results = $conn->query($sql2);
        while ($row = $results->fetch_assoc()) {

            //Array items are mapped to variables with descriptive names below
            $item_index_int = $row["item_index"];
            $item_index = "item" . $row["item_index"];
            $item_name = $row["item_name"];
            $item_rating = $row["item_rating"];
            $item_rating_remainder = 5 - $item_rating;
            $item_banner_dir = '../' . $row["item_banner_img_dir"];
            $item_price = $row["item_price"];

            //Rating star display is delt with below - a loop adds full stars to $star until rating is empty. 
            //The remainder (5 - rating) is added in the second loop as empty stars.
            $stars = "";
            for ($item_rating; $item_rating > 0; $item_rating--) {
                $stars = $stars . '<span class="fa fa-star checked"></span>';
            }

            for ($item_rating_remainder; $item_rating_remainder > 0; $item_rating_remainder--) {
                $stars = $stars . '<span class="fa fa-star"></span>';
            }

            //See if there's a better way of doing this...

            $html_template =
                "
<div class='second_banner_item'>
    <a href='../item_page.php?itemindex=$item_index_int'> <img class='banner' src='$item_banner_dir'> </a>
    <div class='item_banner_title'>$item_name</div>
    <div class='under_banner_grid'>
        <div class='raiting'>
            $stars
        </div>
        <div class='price' id='$item_index-2'>$$item_price</div>
        <div class='quantity_selector' id='quantity_selector'>
            <input type='number' id='$item_index' onchange=\"getTotalPrice($item_price, '$item_index', '$item_index-2')\" name='quantity' min='1' size='2' value='0'>
            </input>
        </div>
        <button class='bottom_left_cart'>Add to Cart</button>
    </div>
</div>";

            //Display them
            echo $html_template;
        }
        ?>

    </div>
</body>

</html>