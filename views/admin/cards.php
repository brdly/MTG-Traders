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
            <th scope="col">Card Name</th>
            <th scope="col">Set Name</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($cards as $card) : ?>
        <tr>
            <th scope="row"><?php echo $card["id"]; ?></th>
            <td><?php echo $card["cardname"]; ?></td>
            <td><?php echo $card["setname"]; ?></td>
            <td>
                <a class="btn btn-sm btn-primary" href="./admin-cards-detail.php?id=<?php echo $card["id"]; ?>">Full Details</a>
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
                <h5 class="modal-title" id="exampleModalLabel">Add Card</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nameInput">Card Name</label>
                        <input type="text" class="form-control" name="cardname" id="nameInput" placeholder="Card Name" required="required">
                    </div>
                    <div class="form-group">
                        <label for="costInput">Mana Cost</label>
                        <input type="text" class="form-control" name="manacost" id="costInput" placeholder="Mana Cost">
                    </div>
                    <div class="form-group">
                        <label for="setInput">Set</label>
                        <select class="form-control" id="setInput">
                            <?php foreach ($sets as $set) : ?>
                            <option value="<?php echo $set["id"]; ?>"><?php echo $set["setname"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="descriptionInput">Card Description</label>
                        <textarea class="form-control" id="descriptionInput" name="description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="flavourInput">Card Flavour Text</label>
                        <textarea class="form-control" id="flavourInput" name="flavourtext" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="typeInput">Card Type</label>
                        <input type="text" class="form-control" name="cardtype" id="typeInput" placeholder="Card Type" required="required">
                    </div>
                    <div class="form-group">
                        <label for="rarityInput">Rarity</label>
                        <select class="form-control" id="rarityInput" name="rarity">
                            <option value="common">Common</option>
                            <option value="uncommon">Uncommon</option>
                            <option value="rare">Rare</option>
                            <option value="mythic">Mythic Rare</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="powerInput">Power</label>
                        <input type="text" class="form-control" name="power" id="powerInput" placeholder="Power">
                    </div>
                    <div class="form-group">
                        <label for="toughnessInput">Toughness</label>
                        <input type="text" class="form-control" name="toughness" id="toughnessInput" placeholder="Toughness">
                    </div>
                    <div class="form-group">
                        <label for="loyaltyInput">Loyalty</label>
                        <input type="text" class="form-control" name="loyalty" id="loyaltyInput" placeholder="Loyalty">
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