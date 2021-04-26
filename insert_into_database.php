<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
try {
    $conn = new mysqli($servername, $username, $password, "mysql");
    // echo "Connected successfully";
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

    $item_name = $values[0];
    $item_price = $values[1];
    $item_img_dir = "imgs/" . $values[2];
    $item_desc = $values[3];
    $banner_dir = $values[4];
    $item_rating = $values[5];


//     $values = array_values($_POST);
//     var_dump($values);

    $sqlInsert = "INSERT INTO `products_all` (`item_name`, `item_price`, `item_img_dir`, `item_rating`, `item_desc`, `item_banner_img_dir`)
VALUES ('$item_name', $item_price, '$item_img_dir', '$item_rating', '$item_desc', '$banner_dir')";
// echo  $sqlInsert;
$results = $conn->query($sqlInsert);
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Uploader Tool</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.4.1.slim.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</head>

<body>

    <!-- Item attribute text field inputs are laid out below -->
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col">
                <h1 class="text-center mt-3">Item Upload</h1>
                <hr>
                <form action="?submit" method="post">
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label for="name">Item Name: </label>
                            <input type="text" id="name" name="name" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="price">Item Price:</label>
                            <input type="text" id="price" name="price" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="name">Item Image Name: </label>
                            <input type="text" id="img_dir" name="img_dir" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="name">Item Description: </label>
                            <input type="text" id="img_desc" name="img_desc" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="name">Item Banner Image Directory: </label>
                            <input type="text" id="banner_dir" name="banner_dir" class="form-control">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <p class="text-center mb-auto">1=Lowest, 5=Highest</p>
                        </div>
                    </div>


                    <!-- Rating is selected via a series of radial buttons laid out below -->
                    <hr>
                    <div class="row mt-2">
                        <div class="col-md-8">
                            <p>Item Rating</p>
                        </div>
                        <div class="col">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="rating" value="1">1
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="rating" value="2">2
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="rating" value="3">3
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="rating" value="4">4
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="rating" value="5">5
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Submit button below -->
                    <hr class="mt-auto">
                    <div class="row">
                        <div class="col text-center">
                            <input type="submit" name="submit" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <!-- Image Gallery and Uploader -->
        <div class="row justify-content-md-center">
            <div class="col">
                <h1 class="text-center mt-3">Item Upload</h1>
                <hr>
                <div class="row">
                    <div class="col">
                        <button class="btn btn-light mb-3 float-right" data-toggle="modal" data-target="#uploadModal">Upload</button>
                    </div>
                </div>
                <div class="row mb-3">
                    <?php
                    $images = array_diff(scandir('imgs'), array('.', '..'));

                    $html_template = '
                    <div class="col-md-4 my-auto">
                        <img src="imgs/<IMAGE_PATH>" class="img-fluid img-thumbnail">
                    </div>';

                    foreach ($images as $image) {
                        echo str_replace("<IMAGE_PATH>", $image, $html_template);
                    }
                    ?>

                </div>
            </div>
        </div>
        <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Upload</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="file" accept="image/*" id="imageFile">
                        <p id="uploadError"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="uploadFile()">Upload</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>