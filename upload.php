<?php
$target_dir = "imgs/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$response = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
  $check = getimagesize($_FILES["file"]["tmp_name"]);
  if($check !== false) {
    $response = 1;
  } else {
    $response = 3;
    echo $response;
  }

// Check if file already exists
if (file_exists($target_file)) {
  $response = 0;
}

// Check file size
if ($_FILES["file"]["size"] > 500000) {
  $response = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  $response = 0;
}

// Check if $response is set to 0 by an error
if ($response == 0) {
    echo $response;
    // if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    echo $response;
  } else {
    $response = 0;
    echo $response;
  }
}
//</script>
?>