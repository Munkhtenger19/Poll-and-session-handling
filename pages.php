<?php function page_movielist($title, $user_id = null){ ?>
    <?php
    require_once 'functions.php';
    $movies = get_all_movies();
    ?>

    <h2><?=$title?></h2>
    <ul>
        <?php foreach($movies as $movie): ?>
            <?php $likes = user_likes_movie($user_id, $movie->id) ?>
            <li>
                <a href="movie.php?movie_id=<?=$movie->id?>"><?=$movie->title?></a>
                <a href="query_<?=$likes ?'dislike':'like'?>.php?movie_id=<?=$movie->id?>"><?=$likes ? '💚' : '🖤'?></a>
        <?php endforeach ?>
    </ul>
<?php } // end page_movielist ?>

<?php function page_add_poll($origin){ ?>
    <form action="query_add_poll.php" method="POST" novalidate>
        <input type="hidden" name="origin" value="<?=$origin?>">
        <label for="poll_text">Poll Text:</label>
        <input type="text" name="poll_text">
        <br>
        <label for="poll_options">Poll Options (One per line):</label>
        <textarea name="poll_options" ></textarea>
        <br>
        <label for="multiple_options">Allow Multiple Options:</label>
        <input type="radio" name="multiple_options" value="yes" > Yes
        <input type="radio" name="multiple_options" value="no"> No
        <br>
        <label for="voting_deadline">Voting Deadline:</label>
        <input type="date" name="voting_deadline">
        <br>
        <label for="creation_time">Creation Time:</label>
        <input type="datetime-local" name="creation_time">
        <br>
        <input type="submit" value="create">
    </form>
<?php } //end page_add_movie ?>

<?php function page_login($origin){ ?>
    <h2>Login</h2>
    <form action="query_login.php" method="POST" novalidate>
        <input type="hidden" name="origin" value="<?=$origin?>">
        Username: <input name="uname"> <br>
        Password: <input name="pword" type="password"> <br>
        <input type="submit" value="Login">
    </form>
<?php } //end page_login ?>

<?php function page_register($origin, $kept_data){ ?>
    <?php
        $is_kept = $kept_data != null;
    ?>
    <h2>Register</h2>
    <form action="query_register.php" method="POST" novalidate>
        <input type="hidden" name="origin" value="<?=$origin?>">
        Username: <input name="uname" value="<?=$is_kept ? $kept_data->uname : ''?>"> <br>
        Email: <input name="email" value="<?=$is_kept ? $kept_data->email : ''?>"> <br>
        Password: <input name="pword1" type="password"> <br>
        Password again: <input name="pword2" type="password"> <br>

        <input type="submit" value="Register">
    </form>
<?php } //end page_register ?>

<?php function page_errors($errors){ ?>
    <?php if(count($errors ?? []) == 0) return ?>

    <?php $error_dict = json_read('errors.json') ?>
    <h2>Error!</h2>
    <ul>
        <?php foreach($errors as $error): ?>
            <li><?=$error_dict->$error?></li>
        <?php endforeach ?>
    </ul>
<?php } // end page_errors ?>

<?php function login_button(){ ?>
<!--    <form action="query_login.php">-->
    <form action="login.php" novalidate>
        <input type="submit" value="Login">
    </form>
<?php } //end page_add_movie ?>

<?php function register_button(){ ?>
<!--    <form action="query_register.php">-->
        <form action="register.php" novalidate>
        <input type="submit" value="Register">
    </form>
<?php } //end page_add_movie ?>

<?php function poll_add_button(){ ?>
    <form action="poll.php" novalidate>
        <input type="submit" value="Create poll">
    </form>
<?php } //end page_add_movie ?>

