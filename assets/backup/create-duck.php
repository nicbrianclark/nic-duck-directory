<?php

if (isset($_POST["submit"])) {
    // Connect to DB
    include('./config/db.php');

    // TODO: Generate Errors list

    // Validate form: get POST data
    if(empty($_POST['name'])) {
        // Error: name is blank
        echo "A name is required";
    } else {
        // Success: name is present
        $name = trim(htmlspecialchars($_POST["name"]));
    }
    
    if(empty($_POST['favorite_foods'])) {
        // Error: favorite_foods is blank
        echo "A comma-separated list of favorite foods is required";
    } else {
        // Success: favorite_foods is present
        $favorite_foods = trim(htmlspecialchars($_POST["favorite_foods"]));
    }

    if(empty($_POST['bio'])) {
        // Error: bio is blank
        echo "A duck biography is required";
    } else {
        // Success: bio is present
        $bio = trim(htmlspecialchars($_POST["bio"]));
    }

    
    // Build new duck profile in DB
    // create SQL
    $sql = "INSERT INTO ducks(name,favorite_foods,bio) VALUES('$name','$favorite_foods','$bio')";

    // save to DB and check
    if(mysqli_query($conn, $sql)) {
        // success, redirect to index
        header('Location: index.php');
    } else {
        // error
        echo "Query Error: " . mysqli_error($conn);
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
                        <input type="text" id="name" name="name" required <?php if (isset($name)) { echo 'value="' . $name . '"'; } ?>>
                    </div>
                    <div class="input-group">
                        <label for="foods">Duck's Favorite Foods (Separate multiple with a comma)</label>
                        <input type="text" id="foods" name="favorite_foods" required <?php if (isset($favorite_foods)) { echo 'value="' . $favorite_foods . '"'; } ?>>
                    </div>
                    <div class="input-group">
                        <label for="image">Duck's Picture</label>
                        <input type="file" id="image" name="img_src">
                    </div>
                    <div class="input-group">
                        <label for="bio">Biography</label>
                        <textarea name="bio" id="bio" rows="10" required><?php if (isset($bio)){ echo $bio; }?></textarea>
                    </div>
                    <div class="input-group">
                        <input type="submit" id="submit" name="submit" value="Submit Form">
                    </div>
                </form>
            </div>
        </section>

    </main>

    <?php include('./components/footer.php'); ?>
</body>
</html>