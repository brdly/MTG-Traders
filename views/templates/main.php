<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 05/02/2018
 * Time: 21:59
 */
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/styles.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <title>MTG Traders | <?php echo $title; ?></title>
</head>
<body>
<div class="wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="./index.php">MTG Traders</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user fa-fw"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <span class="navbar-text dropdown-item">Hello, George</span>
                        <a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt fa-fw"></i> Sign Out</a>
                        <a class="dropdown-item" href="./login.php"><i class="fas fa-sign-in-alt fa-fw"></i> Sign In</a>
                        <a class="dropdown-item" href="./register.php"><i class="fas fa-user-plus fa-fw"></i> Register</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid bg-light">
        <?php echo $content; ?>
    </div>

    <footer class="bg-light">
        <h6 class="text-center text-muted">&copy; George Broadley <?php echo date("Y"); ?></h6>
    </footer>
</div>

<script src="js/all.js"></script>
</body>
</html>
