<?php

    include '../includes/database.php';

    session_start();
    $_SESSION['username'] = null;
    $_SESSION['firstname'] = null;
    $_SESSION['lastname'] = null;
    $_SESSION['role'] = null;

    // removed the user from the users_login table
    $session = session_id();
    $query = $mysqli->prepare("DELETE FROM users_online WHERE session = ?");
    $query->bind_param('s', $session);
    $query->execute();
    $query->close();

    header('Location: ../index.php')

?>