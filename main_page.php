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
    <title>Assignment - Part 1</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-3.4.1.slim.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/setStars.js"></script>
    <script src="js/totalPrice.js"></script>

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
                    <div class="banner_title">Title Pending</div>
                </div>
            </div>

        <!--Searchbar goes here-->
        <div class="search">
            <a class="active" href="main_page.php">Home</a>
            <a href="Contact_Info.php">Contact Us</a>
            <a href="Cart.html">Your Cart</a>
            <form name="searchForm" action="search_results.php">
                <input name="searchInp" class="padding_top" type="text" placeholder="Search...">
            </form>
        </div>

        <!--This section will display images in a grid (2x4 or something
        like that). These will link to the individual services-->

        <h1> Current Content </h1>
        <div class="services">


            <div class="image1">
                <a href="Current Content/e9s-e12s.html">
                    <img class='large_image' src="imgs/main_page_e9s-e12s.jpg">
                    <div class="banner_title">E9S-E12S</div>
                </a>
            </div>

            <div class="image1">
                <a href="Current Content/castrum_marinum.html">
                    <img class='large_image' src="imgs/castrum_marinum_extreme.jpg">
                    <div class="banner_title">Castrum Marinum (Extreme)</div>
                </a>
            </div>

            <div class="image1">
                <a href="Current Content/Bozja_info.html">
                    <img class='large_image' src="imgs/main_page_bozja.png">
                    <div class="banner_title">Bozja</div>
                </a>
            </div>
        </div>



        <!-- Older content goes here -->
        <h1>Previous Content</h1>
        <div class="previous_content">

            <div class="image2">
                <a href="Previous Content/a_realm_reborn.html">
                    <img class='large_image' src="imgs/main_page_a_realm_reborn.png">
                </a>
            </div>

            <div class="image2">
                <a href="Previous Content/heavensward.html">
                    <img class='large_image' src="imgs/main_page_heavensward.png">
                </a>
            </div>

            <div class="image2">
                <a href="Previous Content/stormblood.html">
                    <img class='large_image' src="imgs/main_page_stormblood.png">
                </a>
            </div>

            <div class="image2">
                <a href="Previous Content/shadowbringers.php">
                    <img class='large_image' src="imgs/main_page_shadowbringers.png">
                </a>
            </div>
        </div>

        <h1>Other Content</h1>
        <div class="ultimates">
            <div class="banner">
                <a href="Other Content/ultimates.php">
                    <img class='large_image' src="imgs/banner_ultimates.png">
                    <div class="banner_title">Ultimates</div>
                </a>
            </div>


            <div class="banner">
                <a href="Other Content/mounts_glam.html">
                    <img src="imgs/banner_mounts_and_glam.png">
                    <div class="banner_title">Mounts and Glam</div>
                </a>
            </div>
        </div>

        <!------------------------Featured------------------->
        <h1>Featured</h1>

        <?php

        $sql = "SELECT * FROM products_all WHERE item_is_featured = 1";
        $results = $conn->query($sql);
        while ($row = $results->fetch_assoc()) {

            //Array items are mapped to variables with descriptive names below
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

            $html_template = "<div class='grid_container'>
    <a href='item_page.php?itemindex=$item_index_int'> <img class='large_image' src='$item_img_dir'> </a>
    <div class='prod_title'>$item_name</div>
    <div class='description'>$item_desc</div>
    <div class='rating'>
        $stars
    </div>
    <div class='price' id='$item_index-2'>$$item_price</div>
    <span class='cart_wrapper'>
        <span class='quantity_selector' id='quantity_selector'>
        <input type='number' id='$item_index' onchange=\"getTotalPrice($item_price, '$item_index', '$item_index-2')\" name='quantity' min='1' size='2' value='0'>
        </input>
        </span>
        <button type='add_to_cart'>Add to Cart</button>
    </span>
    </div>";
            //display the featured items
            echo $html_template;
        }
        ?>

    </div>

</body>

</html>