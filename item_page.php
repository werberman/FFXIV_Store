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
    <title>Item Information Page</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/item_page.css">
    <script src="js/jquery-3.4.1.slim.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/setStars.js"></script>
    <script src="js/totalPrice.js"></script>
    <script src="js/itemPage.js"></script>

    <!-- Font Awesome Icon Library (as suggested on w3school)-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container">
        <div class="container">
            <div class="title">
                <!--Main banner goes here-->
                <div class="head_banner">
                    <img class="head_banner_image" src="imgs/banner_main_page_title.png">
                    <div class="banner_title" id="toreplace1">Title Pending</div>
                </div>
            </div>

            <!--Searchbar goes here-->
            <div class="search">
                <a href="main_page.php">Home</a>
                <a href="Contact_Info.php">Contact Us</a>
                <a href="Cart.html">Your Cart</a>
                <a class="active" id="toreplace2">TOREPLACE</a>
                <form name="searchForm" action="search_results.php">
                    <input name="searchInp" class="padding_top" type="text" placeholder="Search...">
                </form>
            </div>
            <?php
            //get the search parameters from the url
            $url_array[] = [""];
            $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $url_array[] = explode('=', $actual_link);
            $size = count($url_array);
            //no idea why, but this has to be mapped to another variable in order to get the correct value
            //for the array
            $tag = $url_array[($size - 1)];
            $final_tag = $tag[($size - 1)];

            //SQL statement below
            $sql = "SELECT * FROM products_all WHERE item_index = $final_tag";
            $results = $conn->query($sql);
            while ($row = $results->fetch_assoc()) {

                $item_index_int = $row["item_index"];
                $item_index = "item" . $row["item_index"];
                $item_name = $row["item_name"];
                $item_rating = $row["item_rating"];
                $item_rating_remainder = 5 - $item_rating;
                $item_img_dir = $row["item_img_dir"];
                $item_price = $row["item_price"];
                $item_desc = $row["item_desc"];

                //Rating star display is delt with below - a loop adds full stars to $star until rating is empty. 
                //The remainder (5 - rating) is added in the second loop as empty stars.
                $stars = "";
                for ($item_rating; $item_rating > 0; $item_rating--) {
                    $stars = $stars . '<span class="fa fa-star checked"></span>';
                }

                for ($item_rating_remainder; $item_rating_remainder > 0; $item_rating_remainder--) {
                    $stars = $stars . '<span class="fa fa-star"></span>';
                }

                $html_template = "<div class='item_page_grid_container'>
                <h1 class='prod_title'>$item_name <br> $stars</h1>
                <div class='item_page'>
                <a href='item_page.php?itemindex=$item_index_int'> <img class='item_page_image' src='$item_img_dir'> </a>
                </div>
                <div class='description'>$item_desc</div>
                <span class='cart_wrapper'>
                    <span class='quantity_selector' id='quantity_selector'>
                    <input type='number' id='$item_index' onchange=\"getTotalPrice($item_price, '$item_index', '$item_index-2')\" name='quantity' min='1' size='2' value='0'>
                    </input>
                    </span>
                    <button type='add_to_cart'>Add to Cart</button>
                    <div class='price' id='$item_index-2'>$$item_price</div>
                </span>
                </div>
                <script>toReplace(\"$item_name\")</script>";
                //display the featured items
                echo $html_template;
            }

            ?>

        </div>
</body>

</html>