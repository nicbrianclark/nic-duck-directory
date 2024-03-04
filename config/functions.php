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
            $target_file = $target_file . strval(time());
        } elseif ($_FILES["img_src"]["size"] > 500000) {
            $errors["img_src"] = "Filesize limit exceeded.";
        } elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "webp" ) {
            $errors["img_src"] = "Sorry, only JPG, JPEG, PNG, GIF or WEBP files are allowed.";

        }
    }

    return $errors;
}