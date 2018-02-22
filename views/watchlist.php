<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 15/02/2018
 * Time: 15:45
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
            <th scope="col">Condition</th>
            <th scope="col">Price</th>
            <th scope="col">Expiry Date</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($watchlist as $item) : ?>
            <tr>
                <th scope="row"><?php echo $item["id"]; ?></th>
                <td><?php echo $item["card"]["cardname"]; ?></td>
                <td><?php echo $item["details"]["firstname"] . " " . $item["details"]["lastname"]; ?></td>
                <td><?php echo $item["details"]["condition"]; ?></td>
                <td>£<?php echo $item["details"]["price"]; ?></td>
                <td><?php echo $item["details"]["expirydate"]; ?></td>
                <td>
                    <a class="btn btn-sm btn-danger" href="./remove-from-wishlist.php?id=<?php echo $item["advertid"]; ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <?php echo $pagination; ?>
</div>
