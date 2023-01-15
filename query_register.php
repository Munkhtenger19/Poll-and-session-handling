<?php
session_start();
require_once 'functions.php';

$form_data = (object)[
    'uname' => trim($_POST['uname'] ?? ''),
    'email' => trim($_POST['email'] ?? ''),
    'pword1' => trim($_POST['pword1'] ?? ''),
    'pword2' => trim($_POST['pword2'] ?? ''),
    'isAdmin' => false
//    'year' => trim($_POST['year'] ?? 'nan'),
//    'city' => $_POST['city'] ?? '',
//    'color' => $_POST['color'] ?? '',
//    'movies' => $_POST['movies'] ?? []
];


$errors = [];

if(strlen($form_data->uname) < 5){
    $errors[] = 'uname_short';
}else if(!regex_username($form_data->uname)){
    $errors[] = 'uname_complex';
}else if(user_exists($form_data->uname)){
    $errors[] = 'uname_exists';
}

if (!filter_var($form_data->email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'invalid_email';
}

if($form_data->pword1 != $form_data->pword2){
    $errors[] = 'pword_nomatch';
}else if($form_data->pword1 < 8){
    $errors[] = 'pword_short';
}else if(!regex_password($form_data->pword1)){
    $errors[] = 'pword_complex';
}

//
//if(!is_numeric($form_data->year)){
//    $errors[] = 'year_nan';
//}else if(intval($form_data->year) < 1900 || intval($form_data->year) > 2010){
//    $errors[] = 'year_oob'; //out of bounds
//}
//
//if(!city_exists($form_data->city)){
//    $errors[] = 'city_unknown';
//}
//
//if(!color_exists($form_data->color)){
//    $errors[] = 'color_unknown';
//}
//
//if(count($form_data->movies) == 0){
//    $errors[] = 'movies_empty';
//}else if(!movies_exsist($form_data->movies)){
//    $errors[] = 'movies_unknown';
//}

if(count($errors) > 0){
    $_SESSION['errors'] = $errors;
    $_SESSION['origin'] = $_POST['origin'];
    $_SESSION['kept_data'] = $form_data;
    redirect('register.php');
}

$_SESSION['user'] = auth_register_user($form_data);
//redirect($_POST['origin'] ?? 'index.php');
redirect('login.php');