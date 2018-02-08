<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 06/02/2018
 * Time: 10:52
 */
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="form-group">
        <label for="firstNameInput">First Name</label>
        <input type="text" class="form-control" id="firstNameInput" name="firstname" placeholder="First Name" required="required" value="<?php echo $_POST["firstname"]; ?>">
    </div>
    <div class="form-group">
        <label for="lastNameInput">Last Name</label>
        <input type="text" class="form-control" id="lastNameInput" name="lastname" placeholder="Last Name" required="required" value="<?php echo $_POST["lastname"]; ?>">
    </div>
    <div class="form-group">
        <label for="emailInput">Email Address</label>
        <input type="email" class="form-control" id="emailInput" name="email" placeholder="Email Address" required="required" value="<?php echo $_POST["email"]; ?>">
    </div>
    <div class="form-group">
        <label for="passwordInput">Password</label>
        <input type="password" class="form-control" id="passwordInput" name="password" placeholder="Password" required="required">
    </div>
    <div class="form-group">
        <label for="passwordConfirmInput">Confirm Password</label>
        <input type="password" class="form-control" id="passwordConfirmInput" name="passwordConfirmation" placeholder="Confirm Password" required="required">
    </div>
    <div class="form-group">
        <label for="addrLineOneInput">Address Line 1</label>
        <input type="text" class="form-control" id="addrLineOneInput" name="addrline1" placeholder="Address Line 1" required="required" value="<?php echo $_POST["addrline1"]; ?>">
    </div>
    <div class="form-group">
        <label for="addrLineTwoInput">Address Line 2</label>
        <input type="text" class="form-control" id="addrLineTwoInput" name="addrline2" placeholder="Address Line 2" value="<?php echo $_POST["addrline2"]; ?>">
    </div>
    <div class="form-group">
        <label for="addrLineThreeInput">Address Line 3</label>
        <input type="text" class="form-control" id="addrLineThreeInput" name="addrline3" placeholder="Address Line 3" value="<?php echo $_POST["addrline3"]; ?>">
    </div>
    <div class="form-group">
        <label for="cityInput">City</label>
        <input type="text" class="form-control" id="cityInput" name="city" placeholder="City" required="required" value="<?php echo $_POST["city"]; ?>">
    </div>
    <div class="form-group">
        <label for="postCodeInput">Post Code</label>
        <input type="text" class="form-control" id="postCodeInput" name="postcode" placeholder="Post Code" required="required" value="<?php echo $_POST["postcode"]; ?>">
    </div>
    <div class="form-group">
        <label for="countryInput">Country</label>
        <select class="form-control" id="countryInput" name="country">
            <?php foreach ($countries as $key => $value) : ?>
                <option value="<?php echo $key; ?>" <?php echo (($_POST["country"] == $key) ? "selected=\"selected\"" : "");?>><?php echo $value; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
