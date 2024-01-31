<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <header>
        <div class="container flex align-center justify-between">
            <div class="logo"><a href="/"><img src="./assets/images/duck.png" alt="illustration of a rubber duck"></a></div>
            <nav>
                <ul class="flex">
                    <li><a href="./index.php">Home</a></li>
                    <li><a href="./create-duck.php">Create a Duck</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <section class="welcome">
        <div class="container narrow">
            <h1>Welcome to the Duck Directory!</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam quibusdam distinctio voluptas aperiam eos ab quisquam fuga quae expedita nisi ipsum accusantium, aspernatur consequatur veniam rem dignissimos esse est quod.</p>
        </div>
        
    </section>
    <section class="body">
        <div class="container">
            <div class="grid">
                <div class="grid-item">
                    <div class="card">
                        <div class="image"><img src="https://source.unsplash.com/random/300x300?duck" alt=""></div>
                        <div class="content">
                            <h2>Duck Name</h2>
                            <ul class="favorite-foods">
                                <li>Food</li>
                                <li>Food</li>
                                <li>Food</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="grid-item">
                    <div class="card">
                        <div class="image"><img src="https://source.unsplash.com/random/300x300?duck" alt=""></div>
                        <div class="content">
                            <h2>Duck Name</h2>
                            <ul class="favorite-foods">
                                <li>Food</li>
                                <li>Food</li>
                                <li>Food</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="grid-item">
                    <div class="card">
                        <div class="image"><img src="https://source.unsplash.com/random/300x300?duck" alt=""></div>
                        <div class="content">
                            <h2>Duck Name</h2>
                            <ul class="favorite-foods">
                                <li>Food</li>
                                <li>Food</li>
                                <li>Food</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="grid-item">
                    <div class="card">
                        <div class="image"><img src="https://source.unsplash.com/random/300x300?duck" alt=""></div>
                        <div class="content">
                            <h2>Duck Name</h2>
                            <ul class="favorite-foods">
                                <li>Food</li>
                                <li>Food</li>
                                <li>Food</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="grid-item">
                    <div class="card">
                        <div class="image"><img src="https://source.unsplash.com/random/300x300?duck" alt=""></div>
                        <div class="content">
                            <h2>Duck Name</h2>
                            <ul class="favorite-foods">
                                <li>Food</li>
                                <li>Food</li>
                                <li>Food</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <p>
            &copy; <?php echo Date('Y'); ?> Ducks Unlimited. All Rights Reserved.
        </p>
    </footer>
</body>
</html>