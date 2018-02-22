<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 14/02/2018
 * Time: 20:41
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

<div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Card Name</th>
            <th scope="col">Uploader</th>
            <th scope="col">Expiry Date</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($adverts as $advert) : ?>
        <tr>
            <th scope="row"><?php echo $advert["id"]; ?></th>
            <td><?php echo $advert["cardname"]; ?></td>
            <td><?php echo $advert["username"]; ?></td>
            <td><?php echo $advert["expirydate"]; ?></td>
            <td>
                <a class="btn btn-sm btn-primary" href="./admin-adverts-detail.php?id=<?php echo $advert["id"]; ?>">Full Details</a>
                <a class="btn btn-sm btn-danger" href="./admin-adverts-delete.php?id=<?php echo $advert["id"]; ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <?php echo $pagination; ?>
</div>
