<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 14/02/2018
 * Time: 21:32
 */
?>

<h1>Card ID: <?php echo $card["id"]; ?></h1>

<hr />

<img src="./img/cards/<?php echo $card["imagename"]; ?>.jpg">

<hr />

<p class="lead">Card Name: <?php echo $card["cardname"]; ?></a></p>

<p class="lead">Set Name: <a href="admin-sets-detail.php?id=<?php echo $card["setid"]; ?>"><?php echo $card["setname"]; ?></a></p>

<p>Mana Cost: <?php echo $card["manacost"]; ?></p>

<p>Card Type: <?php echo $card["cardtype"]; ?></p>

<p>Rarity: <?php echo $card["rarity"]; ?></p>

<p>Description: <?php echo $card["description"]; ?></p>

<p>Flavour Text: <?php echo $card["flavourtext"]; ?></p>

<p>Power: <?php echo $card["power"]; ?></p>

<p>Toughness: <?php echo $card["toughness"]; ?></p>

<p>Loyalty Points: <?php echo $card["loyalty"]; ?></p>

<p>Likes/Dislikes: <?php echo $card["likes"]; ?>/<?php echo $card["dislikes"]; ?></p>
