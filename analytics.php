<?php session_start();
if (!isset($_SESSION['admin'])) {
    $_SESSION['adminmsg'] = "You must log in first";
    header('location: adminlogin.php');
}
if (isset($_GET['adminlogout'])) {
    session_destroy();
    unset($_SESSION['admin']);
    header("location: index.php");
}
include('dbconnection.php');
?>
<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="style3.css">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <!-- CSS only -->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    /* Googlefont Poppins CDN Link */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    .sidebar {
        position: fixed;
        height: 100%;
        width: 240px;
        background: #0A2558;
        transition: all 0.5s ease;
    }

    .sidebar.active {
        width: 60px;
    }

    .sidebar .logo-details {
        height: 80px;
        display: flex;
        align-items: center;
    }

    .sidebar .logo-details i {
        font-size: 28px;
        font-weight: 500;
        color: #fff;
        min-width: 60px;
        text-align: center
    }

    .sidebar .logo-details .logo_name {
        color: #fff;
        font-size: 24px;
        font-weight: 500;
    }

    .sidebar .nav-links {
        margin-top: 10px;
    }

    .sidebar .nav-links li {
        position: relative;
        list-style: none;
        height: 50px;
    }

    .sidebar .nav-links li a {
        height: 100%;
        width: 100%;
        display: flex;
        align-items: center;
        text-decoration: none;
        transition: all 0.4s ease;
    }

    .sidebar .nav-links li a.active {
        background: #081D45;
    }

    .sidebar .nav-links li a:hover {
        background: #081D45;
    }

    .sidebar .nav-links li i {
        min-width: 60px;
        text-align: center;
        font-size: 18px;
        color: #fff;
    }

    .sidebar .nav-links li a .links_name {
        color: #fff;
        font-size: 15px;
        font-weight: 400;
        white-space: nowrap;
    }

    .sidebar .nav-links .log_out {
        position: absolute;
        bottom: 0;
        width: 100%;
    }

    .home-section {
        position: relative;
        background: #f5f5f5;
        min-height: 100vh;
        width: calc(100% - 240px);
        left: 240px;
        transition: all 0.5s ease;
    }

    .sidebar.active~.home-section {
        width: calc(100% - 60px);
        left: 60px;
    }

    .home-section nav {
        display: flex;
        justify-content: space-between;
        height: 80px;
        background: #fff;
        display: flex;
        align-items: center;
        position: fixed;
        width: calc(100% - 240px);
        left: 240px;
        z-index: 100;
        padding: 0 20px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        transition: all 0.5s ease;
    }

    .sidebar.active~.home-section nav {
        left: 60px;
        width: calc(100% - 60px);
    }

    .home-section nav .sidebar-button {
        display: flex;
        align-items: center;
        font-size: 24px;
        font-weight: 500;
    }

    nav .sidebar-button i {
        font-size: 35px;
        margin-right: 10px;
    }

    .home-section nav .search-box {
        position: relative;
        height: 50px;
        max-width: 550px;
        width: 100%;
        margin: 0 20px;
    }

    nav .search-box input {
        height: 100%;
        width: 100%;
        outline: none;
        background: #F5F6FA;
        border: 2px solid #EFEEF1;
        border-radius: 6px;
        font-size: 18px;
        padding: 0 15px;
    }

    nav .search-box .bx-search {
        position: absolute;
        height: 40px;
        width: 40px;
        background: #2697FF;
        right: 5px;
        top: 50%;
        transform: translateY(-50%);
        border-radius: 4px;
        line-height: 40px;
        text-align: center;
        color: #fff;
        font-size: 22px;
        transition: all 0.4 ease;
    }

    .home-section nav .profile-details {
        display: flex;
        align-items: center;
        background: #F5F6FA;
        border: 2px solid #EFEEF1;
        border-radius: 6px;
        height: 50px;
        min-width: 190px;
        padding: 0 15px 0 2px;
    }

    nav .profile-details img {
        height: 40px;
        width: 40px;
        border-radius: 6px;
        object-fit: cover;
    }

    nav .profile-details .admin_name {
        font-size: 15px;
        font-weight: 500;
        color: #333;
        margin: 0 10px;
        white-space: nowrap;
    }

    nav .profile-details i {
        font-size: 25px;
        color: #333;
    }

    .home-section .home-content {
        position: relative;
        padding-top: 104px;
    }

    .home-content .overview-boxes {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        padding: 0 20px;
        margin-bottom: 26px;
    }

    .overview-boxes .box {
        display: flex;
        align-items: center;
        justify-content: center;
        width: calc(100% / 4 - 15px);
        background: #fff;
        padding: 15px 14px;
        border-radius: 12px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    }

    .overview-boxes .box-topic {
        font-size: 20px;
        font-weight: 500;
    }

    .home-content .box .number {
        display: inline-block;
        font-size: 35px;
        margin-top: -6px;
        font-weight: 500;
    }

    .home-content .box .indicator {
        display: flex;
        align-items: center;
    }

    .home-content .box .indicator i {
        height: 20px;
        width: 20px;
        background: #8FDACB;
        line-height: 20px;
        text-align: center;
        border-radius: 50%;
        color: #fff;
        font-size: 20px;
        margin-right: 5px;
    }

    .box .indicator i.down {
        background: #e87d88;
    }

    .home-content .box .indicator .text {
        font-size: 12px;
    }

    .home-content .box .cart {
        display: inline-block;
        font-size: 32px;
        height: 50px;
        width: 50px;
        background: #cce5ff;
        line-height: 50px;
        text-align: center;
        color: #66b0ff;
        border-radius: 12px;
        margin: -15px 0 0 6px;
    }

    .home-content .box .cart.two {
        color: #2BD47D;
        background: #C0F2D8;
    }

    .home-content .box .cart.three {
        color: #ffc233;
        background: #ffe8b3;
    }

    .home-content .box .cart.four {
        color: #e05260;
        background: #f7d4d7;
    }

    .home-content .total-order {
        font-size: 20px;
        font-weight: 500;
    }

    .home-content .sales-boxes {
        display: flex;
        justify-content: space-between;
        /* padding: 0 20px; */
    }

    .home-content .sales-boxes {
        width: 100%;
        background: #fff;
        padding: 20px 30px;
        margin: 0 20px;
        border-radius: 12px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    }

    .home-content .sales-boxes .sales-details {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .sales-boxes .box .title {
        font-size: 24px;
        font-weight: 500;
        /* margin-bottom: 10px; */
    }

    .sales-boxes .sales-details li.topic {
        font-size: 20px;
        font-weight: 500;
    }

    .sales-boxes .sales-details li {
        list-style: none;
        margin: 8px 0;
    }

    .sales-boxes .sales-details li a {
        font-size: 18px;
        color: #333;
        font-size: 400;
        text-decoration: none;
    }

    .sales-boxes .box .button {
        width: 100%;
        display: flex;
        justify-content: flex-end;
    }

    .sales-boxes .box .button a {
        color: #fff;
        background: #0A2558;
        padding: 4px 12px;
        font-size: 15px;
        font-weight: 400;
        border-radius: 4px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .sales-boxes .box .button a:hover {
        background: #0d3073;
    }



    /* Responsive Media Query */
    @media (max-width: 1240px) {
        .sidebar {
            width: 60px;
        }

        .sidebar.active {
            width: 220px;
        }

        .home-section {
            width: calc(100% - 60px);
            left: 60px;
        }

        .sidebar.active~.home-section {
            /* width: calc(100% - 220px); */
            overflow: hidden;
            left: 220px;
        }

        .home-section nav {
            width: calc(100% - 60px);
            left: 60px;
        }

        .sidebar.active~.home-section nav {
            width: calc(100% - 220px);
            left: 220px;
        }
    }

    @media (max-width: 1150px) {
        .home-content .sales-boxes {
            flex-direction: column;
        }

        .home-content .sales-boxes .box {
            width: 100%;
            overflow-x: scroll;
            margin-bottom: 30px;
        }

        .home-content .sales-boxes .top-sales {
            margin: 0;
        }
    }

    @media (max-width: 1000px) {
        .overview-boxes .box {
            width: calc(100% / 2 - 15px);
            margin-bottom: 15px;
        }
    }

    @media (max-width: 700px) {

        nav .sidebar-button .dashboard,
        nav .profile-details .admin_name,
        nav .profile-details i {
            display: none;
        }

        .home-section nav .profile-details {
            height: 50px;
            min-width: 40px;
        }

        .home-content .sales-boxes .sales-details {
            width: 560px;
        }
    }

    @media (max-width: 550px) {
        .overview-boxes .box {
            width: 100%;
            margin-bottom: 15px;
        }

        .sidebar.active~.home-section nav .profile-details {
            display: none;
        }
    }

    @media (max-width: 400px) {
        .sidebar {
            width: 0;
        }

        .sidebar.active {
            width: 60px;
        }

        .home-section {
            width: 100%;
            left: 0;
        }

        .sidebar.active~.home-section {
            left: 60px;
            width: calc(100% - 60px);
        }

        .home-section nav {
            width: 100%;
            left: 0;
        }

        .sidebar.active~.home-section nav {
            left: 60px;
            width: calc(100% - 60px);
        }

    }

    table {
        font-size: 22px;
        text-align: center;
        margin: 10px;
    }

    table,
    th,
    td {
        border: 1px solid white;
        border-collapse: collapse;
    }

    th,
    td {
        background-color: #96D4D4;
    }

    table tbody {
        text-align: center;
    }

    table {
        font-size: 23px;
        text-align: center;
        text-transform: capitalize;
        display: block;
        width: 100%;
    }

    .email {
        text-transform: lowercase;
    }

    .sales-boxes {
        overflow-x: scroll;
    }

    .top-sales-details {
        margin: 1px;
    }

    section {
        padding: 3rem 2rem;
    }
</style>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <i class='bx bxs-plane-alt'></i>
            <a href="index.php" class="logo text-decoration-none">
                <div class="wrapper logo_name">
                    <span>T</span>
                    <span>R</span>
                    <span>A</span>
                    <span>V</span>
                    <span>E</span>
                    <span>L</span>
                </div>
            </a>
        </div>

        <ul class="nav-links">
            <li>
                <a href="admin.php">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Admin Dashboard</span>
                </a>
            </li>
            <li>
                <a href="adminbook.php">
                    <i class='bx bx-list-ul'></i>
                    <span class="links_name">List of Bookings</span>
                </a>
            </li>
            <li>
                <a href="analytics.php" class="active">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="links_name">Registered Users</span>
                </a>
            </li>
            <li class="log_out">
                <a href="admin.php?adminlogout='1'">
                    <i class='bx bx-log-out'></i>
                    <span class="links_name">Log out</span>
                </a>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <nav>
            <div class="sidebar-button">
                <i class='bx bx-menu sidebarBtn'></i>
                <span class="dashboard">Admin Dashboard</span>
            </div>
            <div class="profile-details">
                <!--<img src="images/profile.jpg" alt="">-->
                <span class="admin_name">
                    <?php
                    $result = mysqli_query($conn, "SELECT name FROM admin WHERE username='" . $_SESSION['admin'] . "'");
                    $res = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    echo $res['name'];
                    ?>
                </span>
            </div>
        </nav>

        <div class="home-content">
            <div class="overview-boxes">
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Total Bookings</div>
                        <div class="number">
                            <?php
                            $result = mysqli_query($conn, "SELECT * FROM book");
                            $res = mysqli_num_rows($result);
                            echo $res;
                            ?>
                        </div>
                        <div class="indicator">
                            <i class='bx bx-up-arrow-alt'></i>
                            <span class="text">Up</span>
                        </div>
                    </div>
                    <i class='bx bx-cart-alt cart'></i>
                </div>
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Registered Users</div>
                        <div class="number">
                            <?php
                            $result = mysqli_query($conn, "SELECT * FROM users");
                            $res = mysqli_num_rows($result);
                            echo $res;
                            ?>
                        </div>
                        <div class="indicator">
                            <i class='bx bx-up-arrow-alt'></i>
                            <span class="text">Up</span>
                        </div>
                    </div>
                    <i class='bx bxs-cart-add cart two'></i>
                </div>
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Newsletter Subscribers</div>
                        <div class="number">
                            <?php
                            $result = mysqli_query($conn, "SELECT * FROM newsletter");
                            $res = mysqli_num_rows($result);
                            echo $res;
                            ?>
                        </div>
                        <div class="indicator">
                            <i class='bx bx-up-arrow-alt'></i>
                            <span class="text">Up</span>
                        </div>
                    </div>
                    <i class='bx bx-cart cart three'></i>
                </div>
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Total Profit Acquired</div>
                        <div class="number">
                            <?php
                            $result = mysqli_query($conn, "SELECT sum(price) as amount FROM book");
                            $res = mysqli_fetch_array($result, MYSQLI_ASSOC);
                            echo "$" . $res['amount'];
                            ?>
                        </div>
                        <div class="indicator">
                            <i class='bx bx-up-arrow-alt'></i>
                            <span class="text">Up</span>
                        </div>
                    </div>
                    <i class='bx bxs-cart-download cart four'></i>
                </div>
            </div>

            <?php
            include("dbconnection.php");

            //fetching data in descending order (lastest entry first)
            $result = mysqli_query($conn, "SELECT * FROM users");

            ?>
            <section class="account-section">
                <div class="account table-responsive">
                    <table class="center table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Username</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone number (+91)</th>
                                <th scope="col">Date Of Registration</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $rows = mysqli_num_rows($result);
                            if ($rows == 0) {
                                echo "<tr><td colspan='12'>" . 'No Records Found' . "</td></tr>";
                            } else {
                                while ($res = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                    echo "<tr>";
                                    echo "<td>" . $res['username'] . "</td>";
                                    echo "<td>" . $res['full_name'] . "</td>";
                                    echo "<td class='email'>" . $res['email'] . "</td>";
                                    echo "<td>" . $res['contact'] . "</td>";
                                    echo "<td>" . $res['dateOfRegistration'] . "</td>";
                                    echo "<td><a href=\"userdelete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\"><button button type='button' class='account-btn btn btn-danger'>Delete</button></a></td>";
                                }
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </section>

    <script>
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".sidebarBtn");
        sidebarBtn.onclick = function() {
            sidebar.classList.toggle("active");
            if (sidebar.classList.contains("active")) {
                sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
            } else
                sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        }
    </script>

</body>

</html>