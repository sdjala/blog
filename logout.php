<?php
include 'classes/user.php';
$u = new User();
$u-> logout($email, $password);
?>