<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 14/02/2018
 * Time: 21:32
 */
?>

<h1>User ID: <?php echo $user["id"]; ?></h1>

<hr />

<p class="lead">Name: <?php echo $user["firstname"]; ?> <?php echo $user["lastname"]; ?></p>

<p>Email Address: <?php echo $user["email"]; ?></p>

<p>Address Line 1: <?php echo $user["addrline1"]; ?></p>

<p>Address Line 2: <?php echo $user["addrline2"]; ?></p>

<p>Address Line 3: <?php echo $user["addrline3"]; ?></p>

<p>City: <?php echo $user["city"]; ?></p>

<p>Country: <?php echo $user["country"]; ?></p>

<p>Post Code: <?php echo $user["postcode"]; ?></p>

<p>Phone Number: <?php echo $user["phonenum"]; ?></p>