<?php if (count($errorbag) > 0) : ?>
<div class="alert alert-danger" role="alert">
    <?php foreach ($errorbag as $error): ?>
        <?php echo $error; ?>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="form-group">
        <label for="emailInput">Email Address</label>
        <input type="email" class="form-control" name="email" id="emailInput" placeholder="Enter email" required="required">
    </div>
    <div class="form-group">
        <label for="passwordInput">Password</label>
        <input type="password" class="form-control" name="password" id="passwordInput" placeholder="Password" required="required">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>