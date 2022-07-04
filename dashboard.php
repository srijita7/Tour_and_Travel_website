<!DOCTYPE html>

<?php session_start();
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: index.php");
}
include('dbconnection.php');
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <title>Travel</title>

    <!-- swiper css link -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- custom css file link -->
    <link rel="stylesheet" href="style.css">

    <!-- bootstrap cdn -->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>
<style>
    :root {
        /* ===== Colors ===== */
        --primary-color: #0E4BF1;
        --panel-color: #FFF;
        --text-color: #000;
        --black-light-color: #707070;
        --border-color: #e6e5e5;
        --toggle-color: #DDD;
        --box1-color: #4DA3FF;
        --box2-color: #FFE6AC;
        --box3-color: #E7D1FC;
        --title-icon-color: #fff;

        /* ====== Transition ====== */
        --tran-05: all 0.5s ease;
        --tran-03: all 0.3s ease;
        --tran-03: all 0.2s ease;
    }

    .nav {
        position: fixed;
        top: 10rem;
        left: 0;
        width: 250px;
        padding: 10px 14px;
        background-color: var(--panel-color);
        border-right: 1px solid var(--border-color);
        transition: var(--tran-05);
        height: 100%;
    }

    .footer {
        z-index: 1000;
    }

    .nav.close {
        width: 73px;
    }

    .nav .logo-name {
        display: flex;
        align-items: center;
    }

    .nav .logo-image {
        display: flex;
        justify-content: center;
        min-width: 45px;
    }

    .nav .logo-image img {
        width: 40px;
        object-fit: cover;
        border-radius: 50%;
    }

    .nav .logo-name .logo_name {
        font-size: 22px;
        font-weight: 600;
        color: var(--text-color);
        margin-left: 14px;
        transition: var(--tran-05);
    }

    .nav.close .logo_name {
        opacity: 0;
        pointer-events: none;
    }

    .nav .menu-items {
        margin-top: 40px;
        height: calc(100% - 90px);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .menu-items li {
        list-style: none;
    }

    .menu-items li a {
        display: flex;
        align-items: center;
        height: 50px;
        text-decoration: none;
        position: relative;
    }

    .nav-links li a:hover:before {
        content: "";
        position: absolute;
        left: -7px;
        height: 5px;
        width: 5px;
        border-radius: 50%;
        background-color: var(--primary-color);
    }

    body.dark li a:hover:before {
        background-color: var(--text-color);
    }

    .menu-items li a i {
        font-size: 24px;
        min-width: 45px;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--black-light-color);
    }

    .menu-items li a .link-name {
        font-size: 18px;
        font-weight: 400;
        color: var(--black-light-color);
        transition: var(--tran-05);
    }

    .nav.close li a .link-name {
        opacity: 0;
        pointer-events: none;
    }

    .nav-links li a:hover i,
    .nav-links li a:hover .link-name {
        color: var(--primary-color);
    }

    body.dark .nav-links li a:hover i,
    body.dark .nav-links li a:hover .link-name {
        color: var(--text-color);
    }

    .menu-items .logout-mode {
        padding-top: 10px;
        border-top: 1px solid var(--border-color);
    }

    .menu-items .mode {
        display: flex;
        align-items: center;
        white-space: nowrap;
    }

    .menu-items .mode-toggle {
        position: absolute;
        right: 14px;
        height: 50px;
        min-width: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .mode-toggle .switch {
        position: relative;
        display: inline-block;
        height: 22px;
        width: 40px;
        border-radius: 25px;
        background-color: var(--toggle-color);
    }

    .switch:before {
        content: "";
        position: absolute;
        left: 5px;
        top: 50%;
        transform: translateY(-50%);
        height: 15px;
        width: 15px;
        background-color: var(--panel-color);
        border-radius: 50%;
        transition: var(--tran-03);
    }

    body.dark .switch:before {
        left: 20px;
    }

    .dashboard {
        position: relative;
        left: 250px;
        background-color: var(--panel-color);
        min-height: 100vh;
        width: calc(100% - 250px);
        padding: 10px 14px;
        transition: var(--tran-05);
    }

    .nav.close~.dashboard {
        left: 73px;
        width: calc(100% - 73px);
    }

    .dashboard .top {
        position: fixed;
        top: 0;
        left: 250px;
        display: flex;
        width: calc(100% - 250px);
        justify-content: space-between;
        align-items: center;
        padding: 10px 14px;
        background-color: var(--panel-color);
        transition: var(--tran-05);
        z-index: 1;
    }

    .nav.close~.dashboard .top {
        left: 73px;
        width: calc(100% - 73px);
    }

    .dashboard .top .sidebar-toggle {
        font-size: 26px;
        color: var(--text-color);
        cursor: pointer;
    }

    .dashboard .top .search-box {
        position: relative;
        height: 45px;
        max-width: 600px;
        width: 100%;
        margin: 0 30px;
    }

    .top .search-box input {
        position: absolute;
        border: 1px solid var(--border-color);
        background-color: var(--panel-color);
        padding: 0 25px 0 50px;
        border-radius: 5px;
        height: 100%;
        width: 100%;
        color: var(--text-color);
        font-size: 15px;
        font-weight: 400;
        outline: none;
    }

    .top img {
        width: 40px;
        border-radius: 50%;
    }

    .dashboard .dash-content {
        padding-top: 50px;
    }

    .dash-content .title {
        display: flex;
        align-items: center;
        margin: 60px 0 30px 0;
    }

    .dash-content .title i {
        position: relative;
        height: 35px;
        width: 35px;
        background-color: var(--primary-color);
        border-radius: 6px;
        color: var(--title-icon-color);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .dash-content .title .text {
        font-size: 24px;
        font-weight: 500;
        color: var(--text-color);
        margin-left: 10px;
    }

    .dash-content .boxes {
        display: flex;
        align-items: center;
        justify-content: space-around;
        flex-wrap: wrap;
    }

    .dash-content .boxes .box {
        display: flex;
        flex-direction: column;
        align-items: center;
        border-radius: 12px;
        width: calc(100% / 3 - 20px);
        padding: 15px 15px;
        background-color: var(--box1-color);
        transition: var(--tran-05);
    }

    .boxes .box i {
        font-size: 35px;
        color: var(--text-color);
    }

    .boxes .box .text.a {
        white-space: nowrap;
        font-size: 50px;
        font-weight: 500;
        color: var(--text-color);
    }

    .boxes .box .number {
        font-size: 40px;
        font-weight: 500;
        color: var(--text-color);
    }

    .boxes .box {
        width: 250px;
    }

    .boxes .box.box1 {
        width: 100%;
        height: 150px;
        margin-bottom: 20px;
    }

    .boxes .box.box2 {
        background-color: var(--box2-color);
        width: 100%;
        height: 150px;
        margin-bottom: 20px;
    }

    .boxes .box.box4 {
        background-color: var(--box3-color);
        width: 100%;
        height: 150px;
    }

    .dash-content .activity .activity-data {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
    }

    .activity .activity-data {
        display: flex;
    }

    .activity-data .data {
        display: flex;
        flex-direction: column;
        margin: 0 15px;
    }

    .activity-data .data-title {
        font-size: 20px;
        font-weight: 500;
        color: var(--text-color);
    }

    .activity-data .data .data-list {
        font-size: 18px;
        font-weight: 400;
        margin-top: 20px;
        white-space: nowrap;
        color: var(--text-color);
    }

    .dashboard {
        margin-bottom: 10rem;
    }

    @media (max-width: 1000px) {
        .nav {
            width: 73px;
        }

        .nav.close {
            width: 250px;
        }

        .nav .logo_name {
            opacity: 0;
            pointer-events: none;
        }

        .nav.close .logo_name {
            opacity: 1;
            pointer-events: auto;
        }

        .nav li a .link-name {
            opacity: 0;
            pointer-events: none;
        }

        .nav.close li a .link-name {
            opacity: 1;
            pointer-events: auto;
        }

        .nav~.dashboard {
            left: 73px;
            width: calc(100% - 73px);
        }

        .nav.close~.dashboard {
            left: 250px;
            width: calc(100% - 250px);
        }

        .nav~.dashboard .top {
            left: 73px;
            width: calc(100% - 73px);
        }

        .nav.close~.dashboard .top {
            left: 250px;
            width: calc(100% - 250px);
        }

        .activity .activity-data {
            overflow-X: scroll;
        }
    }

    @media (max-width: 780px) {
        .dash-content .boxes .box {
            width: calc(100% / 2 - 15px);
            margin-top: 15px;
        }
    }

    @media (max-width: 560px) {
        .dash-content .boxes .box {
            width: 100%;
        }
    }

    @media (max-width: 400px) {
        .nav {
            width: 0px;
        }

        .nav.close {
            width: 73px;
        }

        .nav .logo_name {
            opacity: 0;
            pointer-events: none;
        }

        .nav.close .logo_name {
            opacity: 0;
            pointer-events: none;
        }

        .nav li a .link-name {
            opacity: 0;
            pointer-events: none;
        }

        .nav.close li a .link-name {
            opacity: 0;
            pointer-events: none;
        }

        .nav~.dashboard {
            left: 0;
            width: 100%;
        }

        .nav.close~.dashboard {
            left: 73px;
            width: calc(100% - 73px);
        }

        .nav~.dashboard .top {
            left: 0;
            width: 100%;
        }

        .nav.close~.dashboard .top {
            left: 0;
            width: 100%;
        }
    }
    
</style>

<body>

    <!-- header section starts  -->

    <section class="header">
        <div id="menu-bar" class="fa-solid fa-bars"></div>

        <a href="index.php" class="logo text-decoration-none">
            <div class="wrapper">
                <span>T</span>
                <span>R</span>
                <span>A</span>
                <span>V</span>
                <span>E</span>
                <span>L</span>
            </div>
        </a>

        <nav class="navbar">
        <a href="index.php" class="text-decoration-none">Home</a>
            <a href="about.php" class="text-decoration-none">About</a>
            <a href="package.php" class="text-decoration-none">Packages</a>
            <a href="book.php" class="text-decoration-none">Book</a>
            <a href="review.php" class="text-decoration-none">Reviews</a>
            <a href="contact.php" class="text-decoration-none">Contact Us</a>
            <a href="admin.php" class="text-decoration-none">Admin</a>
            <?php if (isset($_SESSION['username'])) { ?>
                <a href="dashboard.php"><button type="button" class="btn btn-primary"><i class="fa-solid fa-user"></i><?php echo " " . $_SESSION['username']; ?></button></a>
                <a href="index.php?logout='1'"><button type="button" class="btn btn-danger"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</button></a> <?php } else { ?>
                <a href="login.php"><button type="button" class="btn btn-primary">Login</button></a>
                <a href="register.php"><button type="button" class="btn btn-warning">Register</button></a><?php } ?>
        </nav>

    </section>

    <!-- header section ends -->

    <nav class="nav">

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="dashboard.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Dashboard</span>
                    </a></li>
                <li><a href="profile.php">
                        <i class="uil uil-files-landscapes"></i>
                        <span class="link-name">My Account</span>
                    </a></li>
                <li><a href="password.php">
                        <i class="uil uil-chart"></i>
                        <span class="link-name">Change Password</span>
                    </a></li>
                <li><a href="account.php">
                        <i class="uil uil-thumbs-up"></i>
                        <span class="link-name">List Of Bookings</span>
                    </a></li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>


            <!--<img src="images/profile.jpg" alt="">-->
        </div>
        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Dashboard</span>
                </div>

                <div class="boxes">
                    <div class="box box1">
                        <i class="uil uil-thumbs-up"></i>
                        <span class="text"><a href="account.php" style="text-decoration: none; color: black;  font-size: 18px; text-align: center ">Bookings</a></span>
                    </div>
                    <div class="box box2">
                        <i class="uil uil-files-landscapes"></i>
                        <span class="text"><a href="profile.php" style="text-decoration: none; color: black;  font-size: 18px; text-align: center">My Account</a></span>
                        
                    </div>
                    <div class="box box4">
                        <i class="uil uil-files-landscapes"></i>
                        <span class="text"><a href="password.php" style="text-decoration: none; color: black; font-size: 18px; text-align: center">Change Password</a></span>
                       
                    </div>
                </div>
            </div>

            <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text">Last 5 Bookings</span>
                </div>
                <table class="center table table-striped table-bordered" style="font-size: 20px;">
                    <thead>
                        <tr style="color: blue;">
                            <th scope="col">Full Name</th>
                            <th scope="col">Location</th>
                            <th scope="col">Order date</th>
                        </tr>
                    </thead>
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM book WHERE username='" . $_SESSION['username'] . "' ORDER BY order_date DESC LIMIT 5");
                    $rows = mysqli_num_rows($result);
                    if ($rows == 0) {
                        echo "<tr><td colspan='3'>" . 'No Records Found' . "</td></tr>";
                    } else {
                        while ($res = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            echo "<tr>";
                            echo "<td>" . $res['name'] . "</td>";

                            echo "<td>" . $res['location'] . "</td>";
                            echo "<td>" . $res['order_date'] . "</td>";
                        }
                    }

                    ?>
                </table>


            </div>
    </section>

    <!-- footer section  -->

    <?php
    include('dbconnection.php');
    $errors = array();
    if (isset($_POST['subscribe'])) {
        // receive input values from the form
        $email = mysqli_real_escape_string($conn, $_POST['sub_email']);
        if (empty($email)) {
            array_push($errors, "Email is required");
        }
        if (count($errors) > 0) {
            echo '<script>alert("Enter email ! ")</script>';
        } else {
            $query = "INSERT INTO newsletter (email) VALUES('$email')";
            mysqli_query($conn, $query);
            $_SESSION['subscribe'] = "subscribed";
            if (!$_SESSION) {
                echo '<script>alert("Request not successful. Please try again later")</script>';
            } else {
                echo '<script>alert("Subscribed ! ")</script>';
            }
        }
    } ?>

</body>
<script>
    const body = document.querySelector("body"),
        sidebar = body.querySelector(".nav");
    sidebarToggle = body.querySelector(".sidebar-toggle");

    let getStatus = localStorage.getItem("status");
    if (getStatus && getStatus === "close") {
        sidebar.classList.toggle("close");
    }

    sidebarToggle.addEventListener("click", () => {
        sidebar.classList.toggle("close");
        if (sidebar.classList.contains("close")) {
            localStorage.setItem("status", "close");
        } else {
            localStorage.setItem("status", "open");
        }
    })
</script>
<script src="script.js"></script>
</html>