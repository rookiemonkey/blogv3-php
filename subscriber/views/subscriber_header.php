<?php
session_start();
ob_start();
SubscriberCondition::Protect_Subscriber();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog - ADMIN</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/sb-admin.css" rel="stylesheet">
    <link href="assets/css/loader.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <?php if (isset($_GET['source'])) {
        if ($_GET['source'] === 'add_post' || $_GET['source'] === 'edit_post') {
    ?>
            <script src="https://cdn.ckeditor.com/ckeditor5/21.0.0/classic/ckeditor.js"></script>
    <?php
        }
    }
    ?>

</head>

<body>