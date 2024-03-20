<?php
   
// check for POST
if (isset($_POST['submit'])) {
    require('./config/functions.php');
    require('./config/db.php');

    // Create image file path
    $file_path = "assets/images/" . basename($_FILES["img_src"]["name"]);
    
    // define new Duck properties
    $name = htmlspecialchars($_POST['name']);
    $favorite_foods = htmlspecialchars($_POST['favorite_foods']);
    $bio = htmlspecialchars($_POST['bio']);
    $img_src = $file_path;

    $errors = errorCheck(false, $name, $favorite_foods, $bio, $img_src);

    if(!array_filter($errors)) {
        $sql = "INSERT INTO ducks (name, favorite_foods, bio, img_src) VALUES ('$name', '$favorite_foods', '$bio', '$file_path')";
        if (mysqli_query($conn, $sql)) {
                
            // Move image file to target directory
            if (move_uploaded_file($_FILES["img_src"]["tmp_name"], $file_path)) {
                // File uploaded Successfully, redirect to home page
                header("Location: ./index.php");
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        };
    } else {
        print_r($errors);
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
                        <input type="submit" id="submit" name="submit" value="Add Duck">
                    </div>

                </form>
            </div>
        </section>

    </main>

    <?php include('./components/footer.php'); ?>
</body>
</html>