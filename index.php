<?php

    // include database connection
    include('./config/db.php');

    // create SQL Query
    $sql = "SELECT name,favorite_foods,img_src FROM ducks";

    // query the DB and add the result to a php array
    $result = mysqli_query($conn, $sql);
    $ducks = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // free result from memory and close SQL connection
    mysqli_free_result($result);
    mysqli_close($conn);

?>


<!DOCTYPE html>
<html lang="en">

<?php include('./components/head.php'); ?>

<body>

    <?php include('./components/nav.php'); ?>
    
    <main>
        <?php include('./components/welcome.php'); ?>
    
        <section class="duck-grid">
            <div class="container">
                <div class="grid">
                    
                    <?php foreach($ducks as $duck) : ?>                    
                        
                        <div class="grid-item">
                            <div class="card">
                                
                            <div class="image">
                                <img src="<?php echo $duck["img_src"]; ?>" width="300" height="300" alt="a duck">
                            </div>
                                
                            <div class="content">
                                    <h2><?php echo $duck["name"]; ?></h2>
                                    
                                    <?php
                                        // Split the duck's favorite foods into an array by comma
                                        $food_list = explode(",", $duck["favorite_foods"]);
                                    ?>
                                    
                                    <ul class="favorite-foods">
                                        
                                        <?php foreach($food_list as $food) : ?>
                                            <li><?php echo $food ?></li>
                                        <?php endforeach ?>

                                    </ul>
                                </div>
                            </div>
                        </div>

                    <?php endforeach ?>

                </div>
            </div>
        </section>

    </main>

    <?php include('./components/footer.php'); ?>
</body>
</html>