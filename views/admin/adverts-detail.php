<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 14/02/2018
 * Time: 21:32
 */
?>

<h1>Advert ID: <?php echo $advert["id"]; ?></h1>

<hr />

<img src="./img/uploads/<?php echo $advert["imgname"]; ?>">

<hr />

<p class="lead">Card Name: <a href="admin-cards-detail.php?id=<?php echo $advert["cardid"]; ?>"><?php echo $advert["cardname"]; ?></a></p>

<p class="lead">Advert Owner: <a href="admin-users-detail.php?id=<?php echo $advert["ownerid"]; ?>"><?php echo $advert["username"]; ?></a></p>

<p>Card Condition: <?php echo $advert["condition"]; ?></p>

<p>Asking Price: £<?php echo $advert["price"]; ?></p>

<p>Expiry Date: <?php echo $advert["expirydate"]; ?></p>
