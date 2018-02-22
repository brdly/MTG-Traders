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
            <th scope="col">Set Name</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($sets as $set) : ?>
        <tr>
            <th scope="row"><?php echo $set["id"]; ?></th>
            <td><?php echo $set["setname"]; ?></td>
            <td>
                <a class="btn btn-sm btn-primary" href="./admin-sets-detail.php?id=<?php echo $set["id"]; ?>">Full Details</a>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <?php echo $pagination; ?>
</div>

<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Set</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="modal-body">
                <div class="form-group">
                    <label for="nameInput">Set Name</label>
                    <input type="text" class="form-control" name="setname" id="nameInput" placeholder="Set Name" required="required">
                </div>
                <div class="form-group">
                    <label for="codeInput">Set Code</label>
                    <input type="text" class="form-control" name="setcode" id="codeInput" placeholder="Set Code" required="required">
                </div>
                <div class="form-group">
                    <label for="typeInput">Set Type</label>
                    <select class="form-control" id="typeInput" name="settype">
                        <option value="block">Block</option>
                        <option value="core">Core</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>