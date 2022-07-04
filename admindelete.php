<?php
    require_once("dbconnection.php");
    if (!isset($_SESSION['admin'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: adminlogin.php');
    }
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['admin']);
        header("location: index.php");
    }

    $sql = $conn->prepare("DELETE FROM book WHERE id=?");
    $sql->bind_param("i", $_GET["id"]);
    $sql->execute();
    $sql->close();
    $conn->close();
    header('location: adminbook.php');
?>
