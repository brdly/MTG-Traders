<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 06/02/2018
 * Time: 20:09
 */
?>

<?php if (count($errorbag) > 0) : ?>
    <div class="alert alert-danger" role="alert">
        <?php foreach ($errorbag as $error): ?>
            <?php echo $error; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if (count($responsebag) > 0) : ?>
    <div class="alert alert-success" role="alert">
        <?php foreach ($responsebag as $response): ?>
            <?php echo $response; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<div class="card flex-xl-row box-shadow mb-2">
    <img class="card-img-left" src="./img/cards/<?php echo $card["imagename"]; ?>.jpg" alt="<?php echo $card["cardname"]; ?>">
    <div class="card-body p-0">
        <div class="card h-100 m-0 border-0">
            <div class="card-header">
                <?php echo $card["cardname"]; ?> <span class="float-right"><?php echo $card["manacost"]; ?></span>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <?php echo $card["cardtype"]; ?> <span class="float-right"><?php echo $card["setsymbol"]; ?></span>
                </li>
            </ul>
            <div class="card-body">
                <?php if ($card["description"] !== NULL) : ?>
                    <p><?php echo $card["description"]; ?></p>
                <?php endif; ?>
                <?php if ($card["flavourtext"] !== NULL) : ?>
                    <p><em><?php echo $card["flavourtext"]; ?></em></p>
                <?php endif; ?>
                <?php if ($card["power"] !== NULL) : ?>
                    <p><span class="float-right"><?php if ($card["power"] === "-1") : ?>*<?php else : ?><?php echo $card["power"]; ?><?php endif; ?>/<?php if ($card["toughness"] === "-1") : ?>*<?php else : ?><?php echo $card["toughness"]; ?><?php endif; ?></span></p>
                <?php elseif ($card["loyalty"] !== NULL) : ?>
                    <p><span class="float-right ms ms-loyalty-start ms-loyalty-<?php echo $card["loyalty"]; ?>"></span></p>
                <?php endif; ?>
            </div>
            <div class="card-footer">
                <div class="btn-group float-right" role="group" aria-label="Basic example">
                    <button class="btn btn-success btn-sm"><i class="far fa-thumbs-up"></i> <span class="badge badge-secondary"><?php echo $card["likes"]; ?></span></button>
                    <button class="btn btn-danger btn-sm"><i class="far fa-thumbs-down"></i> <span class="badge badge-secondary"><?php echo $card["dislikes"]; ?></span></button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="filters-list">
    <a href="?<?php echo $endingsoonestURL; ?>" class="btn btn-primary<?php echo $endingsoonest; ?>">Ending Soonest</a>
    <a href="?<?php echo $lowestcostURL; ?>" class="btn btn-primary<?php echo $lowestcost; ?>">Lowest Cost</a>
    <a href="?<?php echo $conditionURL; ?>" class="btn btn-primary<?php echo $condition; ?>">Condition</a>
</div>
<div class="card-custom-deck">
<?php $i = 0; ?>
<?php foreach ($adverts as $advert) : ?>
    <?php $i++; ?>
    <div class="card advert-card">
        <img class="card-img-top" src="./img/uploads/<?php echo $advert["imgname"]; ?>">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Owner: <?php echo $advert["username"]; ?></li>
            <li class="list-group-item">Condition: <?php echo $advert["condition"]; ?></li>
            <li class="list-group-item">Price: £<?php echo $advert["price"]; ?></li>
            <li class="list-group-item border-bottom-0">Expires in: <?php echo $advert["expiresin"]; ?></li>
        </ul>
        <div class="card-body p-0"></div>
        <div class="card-footer">
            <a class="btn btn-primary btn-sm" href="contact.php?id=<?php echo $advert["id"]; ?>">Contact Owner</a>
            <div class="btn-group float-right" role="group" aria-label="Basic example">
            <?php if (count(Watchlist::isInWatchList($advert['id'], $_SESSION["user"]["id"])) > 0) : ?>
                <a class="btn btn-primary btn-sm" href="./remove-from-wishlist.php?id=<?php echo $advert['id']; ?>&page=<?php echo $card['id']; ?>"><i class="fas fa-star"></i></a>
            <?php else : ?>
                <a class="btn btn-primary btn-sm" href="./add-to-wishlist.php?id=<?php echo $advert['id']; ?>&page=<?php echo $card['id']; ?>"><i class="far fa-star"></i></a>
            <?php endif; ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>
<?php echo $paginator; ?>
