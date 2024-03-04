<?php

// Check if the $_GET id parameter is present
if (isset($_GET['id'])) {
    require('./config/db.php');
    
    // get url query parameters. Be sure to sanitize the input
    $duck_id = mysqli_real_escape_string($conn, $_GET['id']);

    // create SQL Query
    $sql = "SELECT id,name,favorite_foods,img_src, bio FROM ducks WHERE id = $duck_id";

    // query the DB and add the result to a php array
    $result = mysqli_query($conn, $sql);
    $duck = mysqli_fetch_assoc($result);

    // free result from memory and close SQL connection
    mysqli_free_result($result);
    mysqli_close($conn);

    print_r($duck);
}

// Check if POST request for delete
if (isset($_POST['delete'])) {
    require('./config/db.php');

    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

    $sql = "DELETE FROM ducks WHERE id = $id_to_delete";

    if (mysqli_query($conn, $sql)){
        // success
        header("Location: index.php");
    } else {
        // fail
        echo 'query error: ' . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include('./components/head.php'); ?>

<body>
    <?php include('./components/nav.php'); ?>

    <main>
        <section class="profile">
            <div class="container">
                <div class="image">
                    <img src="<?php echo $duck['img_src']; ?>" alt="">
                </div>
                <div class="content">
                    <h1><?php echo $duck["name"]; ?></h1>
                    <p><strong>Favorite Foods:</strong> <?php echo $duck['favorite_foods']; ?></p>
                    <p><?php echo $duck['bio']; ?></p>
                </div>
            </div>
        </section>
        <section class="controls">
            <div class="edit">
                <form action="./edit-duck.php" method="POST">
                    <input type="hidden" name="id_to_edit" value="<?php echo $duck['id']; ?>">
                    <input type="submit" name="edit" value="Edit Duck">
                </form>
            </div>
            <div class="delete">
                <form action="./profile.php" method="POST">
                    <input type="hidden" name="id_to_delete" value="<?php echo $duck['id']; ?>">
                    <input type="submit" name="delete" value="Delete Duck">
                </form>
            </div>
        </section>
    </main>
</body>
</html>