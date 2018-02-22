<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 14/02/2018
 * Time: 21:54
 */
?>
<div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Email Address</th>
            <th scope="col">Post Code</th>
            <th scope="col">Phone Number</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user) : ?>
        <tr>
            <th scope="row"><?php echo $user["id"]; ?></th>
            <td><?php echo $user["firstname"]; ?> <?php echo $user["lastname"]; ?></td>
            <td><?php echo $user["email"]; ?></td>
            <td><?php echo $user["postcode"]; ?></td>
            <td><?php echo $user["phonenum"]; ?></td>
            <td>
                <a class="btn btn-sm btn-primary" href="./admin-users-detail.php?id=<?php echo $user["id"]; ?>">Full Details</a>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <?php echo $pagination; ?>
</div>
