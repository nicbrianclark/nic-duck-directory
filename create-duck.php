<?php
    
    
    // check for POST
    if(isset($_POST['submit'])) {

        // create error array
        $errors = array(
            "name" => "",
            "favorite_foods" => "",
            "bio" => "",
        );

        // get POST information
        $name = htmlspecialchars($_POST["name"]);
        $favorite_foods = htmlspecialchars($_POST["favorite_foods"]);
        $bio = htmlspecialchars($_POST["bio"]);

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

        if(!array_filter($errors)) {
            // everything is good, form is valid
            
            // connect to the database
            require('./config/db.php');

            // // build sql query
            // $sql = "INSERT INTO ducks (column1, column2, column3 ...) VALUES ('Value for Column1', 'Value for Column2', 'Value for Column3' ...)";
            $sql = "INSERT INTO ducks (name, favorite_foods, bio) VALUES ('$name', '$favorite_foods', '$bio')";

            // // execute query in mysql
            mysqli_query($conn,$sql);

            // echo "Query is successful. Added: " . $name . " to database.";

            // // load homepage
            header("Location: ./index.php");
        } else {
            // if there are any errors
            // print_r($errors);
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<?php include('./components/head.php'); ?>

<body>

    <?php include('./components/nav.php'); ?>
    
    <main>
        <section class="create-form">
            <div class="container narrow">
                <form action="./create-duck.php" id="create-duck" method="POST">
                    <div class="form-intro">
                        <h1>Want a New Duck?</h1>
                        <p>Fill out this helpful form to add a new duck (<a href="https://www.youtube.com/watch?v=3KvgQIBcdRk" target="_blank">One that won't quack all night.</a>).</p>
                    </div>
                    <div class="input-group">
                        <label for="name">Duck's Name</label>

                        <?php
                            if (isset($errors['name'])) {
                                echo "<div class='error'>" . $errors["name"] . "</div>";
                            }
                        ?>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            placeholder="Daffy"
                            value="<?php if(isset($name)) { echo $name; } ?>"
                            
                        />

                    </div>
                    <div class="input-group">
                        <label for="foods">Duck's Favorite Foods (Separate multiple with a comma)</label>

                        <?php
                            if (isset($errors['favorite_foods'])) {
                                echo "<div class='error'>" . $errors["favorite_foods"] . "</div>";
                            }
                        ?>

                        <input type="text" id="foods" name="favorite_foods" placeholder="eggs, tofu, grubs" value="<?php if(isset($favorite_foods)) { echo $favorite_foods; } ?>" />
                    </div>
                    <!-- <div class="input-group">
                        <label for="image">Duck's Picture</label>
                        <input type="file" id="image" name="img_src">
                    </div> -->
                    <div class="input-group">
                        <label for="bio">Biography</label>
                        
                        <?php
                            if (isset($errors['bio'])) {
                                echo "<div class='error'>" . $errors["bio"] . "</div>";
                            }
                        ?>

                        <textarea name="bio" id="bio" rows="10" placeholder="Talk about your duck..." ><?php if(isset($name)) { echo $name; } ?></textarea>
                    </div>
                    <div class="input-group">
                        <input type="submit" id="submit" name="submit" value="Add Duck">
                    </div>
                </form>
            </div>
        </section>

    </main>

    <?php include('./components/footer.php'); ?>
</body>
</html>