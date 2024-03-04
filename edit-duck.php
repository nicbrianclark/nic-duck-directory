<?php

if (!empty($_POST)) {
    require('./config/db.php');

    if (isset($_POST['id_to_edit'])) {
        $id = mysqli_real_escape_string($conn, $_POST['id_to_edit']);
        $sql = "SELECT * FROM ducks WHERE id=$id";
        // query the DB and add the result to a php array
        $result = mysqli_query($conn, $sql);
        $duck = mysqli_fetch_assoc($result);

        // free result from memory and close SQL connection
        mysqli_free_result($result);
        mysqli_close($conn);

    } elseif (isset($_POST['submit'])) {
        require('./config/functions.php');

        if(!array_filter(errorcheck($_POST['name'], $_POST['favorite_foods'], $_POST['bio'], $_FILES['img_src']))) {
            // everything is good, form is valid
            // connect to the database
            require('./config/db.php');

            $target_dir = "assets/images/";
            $target_file = $target_dir . basename($_FILES["img_src"]["name"]);

            $id = $_POST['duckid'];
            $name = $_POST['name'];
            $favorite_foods = $_POST['favorite_foods'];
            $bio = $_POST['bio'];
            $img_src = $target_file;

            // build sql query
            $sql = "UPDATE ducks SET name='$name', favorite_foods='$favorite_foods', bio='$bio', img_src='$img_src' WHERE id=$id";
    
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
    
} else {
    echo "No POST";
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include('./components/head.php'); ?>

<body>

    <?php include('./components/nav.php'); ?>
    
    <main>
        <section class="edit-form">
            <div class="container narrow">
                <form action="./edit-duck.php" id="create-duck" method="POST" enctype="multipart/form-data">
                    <?php
                        if (isset($_POST['id_to_edit'])) {
                            $id = $_POST['id_to_edit'];
                            echo "<input type='hidden' name='duckid' value='$id' />"; 
                        }
                    ?>
                    <div class="form-intro">
                        <h1>Edit <?php echo $duck["name"]; ?></h1>
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
                            value="<?php if(isset($duck["name"])) { echo $duck["name"]; } ?>"
                            
                        />

                    </div>

                    <div class="input-group">
                        <label for="foods">Duck's Favorite Foods (Separate multiple with a comma)</label>

                        <?php
                            if (isset($errors['favorite_foods'])) {
                                echo "<div class='error'>" . $errors["favorite_foods"] . "</div>";
                            }
                        ?>

                        <input type="text" id="foods" name="favorite_foods" placeholder="eggs, tofu, grubs" value="<?php if(isset($duck["favorite_foods"])) { echo $duck["favorite_foods"]; } ?>" />
                    </div>

                    <div class="input-group">
                        <label for="image">Duck's Picture</label>
                        <img src="<?php echo $duck['img_src']; ?>" width="100">

                        <?php
                            if (isset($errors['img_src'])) {
                                echo "<div class='error'>" . $errors["img_src"] . "</div>";
                            }
                        ?>

                        <input type="file" id="image" name="img_src" />
                    </div>
                    
                    <div class="input-group">
                        <label for="bio">Biography</label>
                        
                        <?php
                            if (isset($errors['bio'])) {
                                echo "<div class='error'>" . $errors["bio"] . "</div>";
                            }
                        ?>

                        <textarea name="bio" id="bio" rows="10" placeholder="Talk about your duck..." ><?php if(isset($duck["bio"])) { echo $duck["bio"]; } ?></textarea>
                    </div>

                    <div class="input-group">
                        <input type="submit" id="submit" name="submit" value="Edit Duck">
                    </div>

                </form>
            </div>
        </section>

    </main>

    <?php include('./components/footer.php'); ?>
</body>
</html>