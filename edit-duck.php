<?php
   
// check for GET
if(isset($_GET['id'])) {
    echo $_GET['id'];
};

// check for POST
if (isset($_POST['submit'])) {
    require('./components/errorcheck.php');

    if(!array_filter($errors)) {
        // everything is good, form is valid
        // connect to the database
        require('./config/db.php');
    
        // build sql query
        // $sql = "INSERT INTO ducks (column1, column2, column3 ...) VALUES ('Value for Column1', 'Value for Column2', 'Value for Column3' ...)";
        $sql = "UPDATE ducks SET name='$name', favorite_foods='$favorite_foods', bio='$bio', img_src='$target_file') WHERE id='$id'";
    
        // execute query in mysql
        mysqli_query($conn,$sql);
    
        // Move image file to target directory
        if (move_uploaded_file($_FILES["img_src"]["tmp_name"], $target_file)) {
            // File uploaded Successfully
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    
        // load homepage
        header("Location: ./index.php");
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
                <form action="./create-duck.php" id="create-duck" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="existing_id" value="<?php if($_GET['id']) { echo $_GET['id']; } ?>">
                    
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

                    <div class="input-group">
                        <label for="image">Duck's Picture</label>

                        <?php
                            if (isset($errors['img_src'])) {
                                echo "<div class='error'>" . $errors["img_src"] . "</div>";
                            }
                        ?>

                        <input type="file" id="image" name="img_src">
                    </div>
                    
                    <div class="input-group">
                        <label for="bio">Biography</label>
                        
                        <?php
                            if (isset($errors['bio'])) {
                                echo "<div class='error'>" . $errors["bio"] . "</div>";
                            }
                        ?>

                        <textarea name="bio" id="bio" rows="10" placeholder="Talk about your duck..." ><?php if(isset($bio)) { echo $bio; } ?></textarea>
                    </div>

                    <div class="input-group">
                        <input type="submit" id="submit" name="submit" value="Update Duck">
                    </div>

                </form>
            </div>
        </section>

    </main>

    <?php include('./components/footer.php'); ?>
</body>
</html>