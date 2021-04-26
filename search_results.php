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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/search_results.css">
    <script src="js/jquery-3.4.1.slim.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/Search.js"></script>
    <script src="js/totalPrice.js"></script>
    <title>Search Results</title>

    <!-- Font Awesome Icon Library (as suggested on w3school)-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container">

        <!--Main banner goes here-->
        <div class="banner">
            <img src="https://via.placeholder.com/1015x100">
            <div class="banner_title">Search Results</div>
        </div>

        <!--Searchbar goes here-->
        <div class="search">
            <a href="main_page.php">Home</a>
            <a href="Contact_Info.php">Contact Us</a>
            <a href="Cart.html">Your Cart</a>
            <a class="active" href="Cart.html">Search Results</a>
            <form name="searchForm" action="search_results.php">
                <input name="searchInp" class="padding_top" type="text" placeholder="Search...">
            </form>
        </div>

        <!--This section will contain images of the various stages of the
    fight. No links required-->

        <div class="header">
            <div class="bkg-img s-grid" src="">
                <!--Search terms used for the search will go in the banner below-->
                <div class="s-grid-item dropdown">
                    <button class="sort">Options...</button>
                    <div class="dropdown_options">
                        <form method="post">
                            <label> Sort By: </label><br>
                            <input type="radio" id="sortHL" name="sort" value="ORDER BY item_price DESC">Price (High-Low)</input><br>
                            <input type="radio" id="sortLH" name="sort" value="ORDER BY item_price">Price (Low-High)</input><br>
                            <input type="radio" id="sortAZ" name="sort" value="ORDER BY item_name">Name (A-Z)</input><br>
                            <input type="radio" id="sortZA" name="sort" value="ORDER BY item_name DESC">Name (Z-A)</input><br>
                            <input type="radio" id="sortRhRl" name="sort" value="ORDER BY item_rating DESC">Rating (High-Low)</input><br>
                            <input type="radio" id="sortRlRh" name="sort" value="ORDER BY item_rating ">Rating (Low-High)</input><br>
                            <label> Filter By: </label><br>
                            <input type="radio" id="over150" name="filter" value="o150">Price: ($150 and Over)</input><br>
                            <input type="radio" id="under150" name="filter" value="u150">Price: (Under $150)</input><br>
                            <input type="radio" id="over3star" name="filter" value="o3">Rating: (3 and Over)</input><br>
                            <input type="radio" id="under3star" name="filter" value="u3">Rating: (Under 3)</input><br>
                            <button type="submit">Submit</button>
                        </form>

                    </div>
                </div>
            </div>
            <?php
            //get the search parameters from the url
            $sort = "";
            $filter = "";
            $url_array[] = [""];
            $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $url_array[] = explode('=', $actual_link);
            $size = count($url_array);
            //no idea why, but this has to be mapped to another variable in order to get the correct value
            //for the array
            $tag = $url_array[($size - 1)];
            $final_tag = $tag[($size - 1)];

            //SQL sorting
            if (isset($_POST['sort'])) {
                $sort = $_POST["sort"];
            }

            if (isset($_POST['filter'])) {
                $rawFilter = $_POST["filter"];
                switch ($rawFilter) {
                    case "o150":
                        $filter = "AND item_price >= 150";
                        break;
                    case "u150":
                        $filter = "AND item_price < 150";
                        break;
                    case "o3":
                        $filter = "AND item_rating >= 3";
                        break;
                    case "u3":
                        $filter = "AND item_rating < 3";
                        break;
                }
            }

            $sql = "SELECT * FROM products_all WHERE ( item_name LIKE \"%$final_tag%\" OR 
            item_desc LIKE \"%$final_tag%\" ) $filter $sort";
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


                // Rating star display is delt with below - a loop adds full stars to $star until rating is empty. 
                // The remainder (5 - rating) is added in the second loop as empty stars.
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

                echo $html_template;
            }
            ?>
        </div>
</body>
</html>