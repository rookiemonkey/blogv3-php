<?php
    require '../vendor/autoload.php';
    $mysqli = Model::Provide_Database();
    session_start();

    // set session to null
    $_SESSION['id'] = null;
    $_SESSION['username'] = null;
    $_SESSION['firstname'] = null;
    $_SESSION['lastname'] = null;
    $_SESSION['role'] = null;

    // remove the user from the users_login table
    $session = session_id();
    $query = $mysqli->prepare("DELETE FROM users_online WHERE session = ?");
    $query->bind_param('s', $session);
    $query->execute();
    $query->close();

    header('Location: /cms/index');
?>