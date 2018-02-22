<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 14/02/2018
 * Time: 19:25
 */

require_once __DIR__ . "/../../src/helpers/Navbar.php";

$nav = new Navbar();
$nav = Navbar::generate();
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
                <li class="nav-item<?php if ($title === "Home") : ?> active<?php endif; ?>"><a class="nav-link" href="/">Home</a></li>
                <?php foreach ($nav["sets"] as $key => $value) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo ucfirst($key); ?> Sets
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <?php foreach ($value as $set) : ?>
                                <a class="dropdown-item" href="/sets.php?id=<?php echo $set["id"]; ?>"><i class="ss ss-<?php echo $set["setcode"]; ?> ss-grad ss-fw"></i> <?php echo $set["setname"]; ?></a>
                            <?php endforeach; ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="./search.php" method="get">
                <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                <a class="btn btn-outline-success ml-2 my-2 my-sm-0" href="#">Advanced Search</a>
            </form>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <?php if (isset($_SESSION["user"])) : ?>
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $_SESSION["user"]["firstname"] . " " . $_SESSION["user"]["lastname"]; ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="./create-ad.php"><i class="fas fa-plus fa-fw"></i> Post Ad</a>
                            <a class="dropdown-item" href="./your-ads.php"><i class="fas fa-sticky-note fa-fw"></i> Your Ads</a>
                            <a class="dropdown-item" href="./watchlist.php"><i class="fas fa-star fa-fw"></i> Watch List</a>
                            <a class="dropdown-item" href="./account.php"><i class="fas fa-user fa-fw"></i> Account Settings</a>
                            <a class="dropdown-item" href="./signout.php"><i class="fas fa-sign-out-alt fa-fw"></i> Sign Out</a>
                        </div>
                    <?php else : ?>
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Login/Register
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="./login.php"><i class="fas fa-sign-in-alt fa-fw"></i> Sign In</a>
                            <a class="dropdown-item" href="./register.php"><i class="fas fa-user-plus fa-fw"></i> Register</a>
                        </div>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </nav>
    <div class="row admin-layout">
        <nav class="nav flex-column bg-light text-center">
            <a class="nav-link" href="./admin-adverts.php">Adverts</a>
            <a class="nav-link" href="./admin-expiredadverts.php">Expired Adverts</a>
            <div class="dropdown-divider"></div>
            <a class="nav-link" href="./admin-cards.php">Cards</a>
            <a class="nav-link" href="./admin-sets.php">Sets</a>
            <div class="dropdown-divider"></div>
            <a class="nav-link" href="./admin-users.php">Users</a>
        </nav>
        <div class="container-fluid bg-light">
            <?php echo $content; ?>
        </div>
    </div>

    <footer class="bg-light">
        <h6 class="text-center text-muted">&copy; George Broadley <?php echo date("Y"); ?></h6>
    </footer>
</div>

<script src="js/all.js"></script>
</body>
</html>