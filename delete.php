<?php
    require_once("dbconnection.php");
    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header("location: index.php");
    }

    $sql = $conn->prepare("DELETE  FROM book WHERE id=?");
    $sql->bind_param("i", $_GET["id"]);
    $sql->execute();
    $sql->close();
    $conn->close();
    header('location:account.php');
?>
