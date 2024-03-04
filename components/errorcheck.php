<?php

function errorCheck($name, $favorite_foods, $bio, $img_src) {
    // create error array
    $errors = array(
        "name" => "",
        "favorite_foods" => "",
        "bio" => "",
        "img_src" => ""
    );

    // check if the name exists
    if(empty($name)) {
        
        // if it doesn't, throw error "required"
        $errors['name'] = "A name is required.";

    } else {
        // if it does, check against regex
        
        if(!preg_match('/^[a-z\s]+$/i', $name)) {
            // if fails regex, throw "incorrect formatting error
            $errors["name"] = "The name has illegal characters";
        }
    }


    // check if favorite foods exists
    if(empty($favorite_foods)) {
        
        // if it doesn't, throw error "required"
        $errors['favorite_foods'] = "No favorite foods? You gotta hungry duck.";

    } else {
        // if it does, check against regex
        
        if(!preg_match('/^[a-z,\s]+$/i', $favorite_foods)) {
            
            // if it fails regex, throw "incorrect formatting" error
            $errors['favorite_foods'] = "Favorite foods must be a comma separated list.";

        }
    }

    // check if bio is empty
    if(empty($bio)) {
        // error if so
        $errors["bio"] = "A bio is required.";
    }

    // Handle image file upload    
    $target_dir = "assets/images/";
    $target_file = $target_dir . basename($_FILES["img_src"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if (empty($_FILES["img_src"]["tmp_name"])) {
        $errors["img_src"] = "No file was uploaded.";
    } else {
        $check = @getimagesize($_FILES["img_src"]["tmp_name"]);
        if (!$check) {
            $errors["img_src"] = "File is not an image.";
        } elseif (file_exists($target_file)) {
            $target_file += time();
        } elseif ($_FILES["img_src"]["size"] > 500000) {
            $errors["img_src"] = "Filesize limit exceeded.";
        } elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "webp" ) {
            $errors["img_src"] = "Sorry, only JPG, JPEG, PNG, GIF or WEBP files are allowed.";

        }
    }

    return $errors;
}

// if(isset($_POST['submit'])) {

//     // create error array
//     $errors = array(
//         "name" => "",
//         "favorite_foods" => "",
//         "bio" => "",
//         "img_src" => ""
//     );

//     // get POST information
//     $name = htmlspecialchars($_POST["name"]);
//     $favorite_foods = htmlspecialchars($_POST["favorite_foods"]);
//     $bio = htmlspecialchars($_POST["bio"]);
//     $img_src = $_FILES["img_src"]["name"];

//     // check if the name exists
//     if(empty($name)) {
        
//         // if it doesn't, throw error "required"
//         $errors['name'] = "A name is required.";

//     } else {
//         // if it does, check against regex
        
//         if(!preg_match('/^[a-z\s]+$/i', $name)) {
//             // if fails regex, throw "incorrect formatting error
//             $errors["name"] = "The name has illegal characters";
//         }
//     }


//     // check if favorite foods exists
//     if(empty($favorite_foods)) {
        
//         // if it doesn't, throw error "required"
//         $errors['favorite_foods'] = "No favorite foods? You gotta hungry duck.";

//     } else {
//         // if it does, check against regex
        
//         if(!preg_match('/^[a-z,\s]+$/i', $favorite_foods)) {
            
//             // if it fails regex, throw "incorrect formatting" error
//             $errors['favorite_foods'] = "Favorite foods must be a comma separated list.";

//         }
//     }

//     // check if bio is empty
//     if(empty($bio)) {
//         // error if so
//         $errors["bio"] = "A bio is required.";
//     }

//     // Handle image file upload    
//     $target_dir = "assets/images/";
//     $target_file = $target_dir . basename($_FILES["img_src"]["name"]);
//     $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

//     if (empty($_FILES["img_src"]["tmp_name"])) {
//         $errors["img_src"] = "No file was uploaded.";
//     } else {
//         $check = @getimagesize($_FILES["img_src"]["tmp_name"]);
//         if (!$check) {
//             $errors["img_src"] = "File is not an image.";
//         } elseif (file_exists($target_file)) {
//             $target_file += time();
//         } elseif ($_FILES["img_src"]["size"] > 500000) {
//             $errors["img_src"] = "Filesize limit exceeded.";
//         } elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "webp" ) {
//             $errors["img_src"] = "Sorry, only JPG, JPEG, PNG, GIF or WEBP files are allowed.";

//         }
//     }

//     if(!array_filter($errors)) {
//         // everything is good, form is valid
//         // connect to the database
//         require('./config/db.php');

//         // build sql query
//         // $sql = "INSERT INTO ducks (column1, column2, column3 ...) VALUES ('Value for Column1', 'Value for Column2', 'Value for Column3' ...)";
//         $sql = "INSERT INTO ducks (name, favorite_foods, bio, img_src) VALUES ('$name', '$favorite_foods', '$bio', '$target_file')";

//         // execute query in mysql
//         mysqli_query($conn,$sql);

//         // Move image file to target directory
//         if (move_uploaded_file($_FILES["img_src"]["tmp_name"], $target_file)) {
//             // File uploaded Successfully
//         } else {
//             echo "Sorry, there was an error uploading your file.";
//         }

//         // load homepage
//         header("Location: ./index.php");
//     }
// }