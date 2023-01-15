<?php
session_start();

require_once 'functions.php';
require_once 'pages.php';
$_SESSION['origin'] = 'index.php';
$user = $_SESSION['user'] ?? '';
//if(!auth_is_logged_in()){
//    $_SESSION['origin'] = 'index.php';
//    redirect('auth_pag.php');
//}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php if(!auth_is_logged_in()): ?>
    <span><?php login_button() ?><?php register_button() ?></span>
    <?php else: ?>
        <form action="query_logout.php">
            <input type="hidden" name="origin" value="index.php">
            <input type="submit" value="Logout">
        </form>
    <div>Logged in user ID: <?= $user?></div>
    <?php endif ?>
    <div><h1>See the polls </h1></div>
    <h3>Polls registered here:</h3>
    <hr>
    <?php if(is_admin($_SESSION['user'])) page_add_poll() ?>
</body>
</html>
