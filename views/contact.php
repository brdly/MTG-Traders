<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 15/02/2018
 * Time: 21:21
 */
?>

<div class="row">
    <div class="col">
        <div class="card text-center">
            <div class="card-header">
                Advert Details
            </div>
            <div class="card-body">
                <h5 class="card-title mb-0"><?php echo $advert["cardname"]; ?></h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Condition: <?php echo $advert["condition"]; ?></li>
                <li class="list-group-item">Price: £<?php echo $advert["price"]; ?></li>
                <li class="list-group-item border-bottom-0">Expires in: <?php echo $advert["expiresin"]; ?></li>
            </ul>
        </div>
    </div>
    <div class="col">
        <div class="card text-center">
            <div class="card-header">
                Owner Details
            </div>
            <div class="card-body">
                <h5 class="card-title mb-0"><?php echo $user["firstname"] . " " . $user["lastname"]; ?></h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Email: <?php echo $user["email"]; ?></li>
                <li class="list-group-item">Phone Number: <?php echo $user["phonenum"]; ?></li>
                <li class="list-group-item">Post Code: <?php echo $user["postcode"]; ?></li>

            </ul>
        </div>
    </div>
</div>
