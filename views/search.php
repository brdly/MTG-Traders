<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 15/02/2018
 * Time: 20:13
 */
?>

<div class="row">
    <?php foreach ($cards as $card) : ?>
        <div class="col-md-12">
            <div class="card flex-xl-row box-shadow mb-2">
                <img class="card-img-left" src="img/cards/<?php echo $card["imagename"]; ?>.jpg" alt="<?php echo $card["cardname"]; ?>">
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
                            <a href="/card.php?id=<?php echo $card["id"]; ?>" class="btn btn-primary btn-sm">See Listings</a>
                            <div class="btn-group float-right" role="group" aria-label="Basic example">
                                <button class="btn btn-success btn-sm"><i class="far fa-thumbs-up"></i> <span class="badge badge-secondary"><?php echo $card["likes"]; ?></span></button>
                                <button class="btn btn-danger btn-sm"><i class="far fa-thumbs-down"></i> <span class="badge badge-secondary"><?php echo $card["dislikes"]; ?></span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php echo $pagination; ?>
