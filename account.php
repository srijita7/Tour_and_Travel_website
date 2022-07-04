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

</head>
<style>
    .account {
        margin-top: 5rem;
        margin-bottom: 7rem;
        text-align: center;
    }

    .account thead tr {
        background-color: #4784e6;
        color: #ffffff;
        text-align: center;
    }

    .account table tbody {
        overflow-x: auto;
        text-align: center;
    }

    .account table {
        font-size: 150%;
        text-align: center;
        text-transform: capitalize;
        display: block
    }

    .account-btn {
        margin: 0.3rem;
        font-size: 80%;
    }

    .account .email {
        text-transform: lowercase;
    }

    .account tbody tr {
        border-bottom: 1px solid #18caf7;
    }

    .account tbody tr:last-of-type {
        border-bottom: 4px solid #18caf9;
    }

    .account tbody tr:hover {
        font-weight: bold;
        color: #2bc3e9;
    }

    table::-webkit-scrollbar {
        width: 10px;
    }

    table::-webkit-scrollbar-track {
        background-color: white;
    }

    table::-webkit-scrollbar-thumb {
        background: #18caf9;
    }

    .account-section {
        display: grid;
        padding-left: 5rem;
        padding-right: 5rem;
        font-size: 120%;
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

    <!-- list of bookings starts -->
    <?php
    include("dbconnection.php");

    //fetching data in descending order (lastest entry first)
    $result = mysqli_query($conn, "SELECT * FROM book WHERE username='" . $_SESSION['username'] . "' ORDER BY order_date DESC");
  
    ?>

    <div class="heading" style="background:url(images/header-bg-4.png) no-repeat">
        <h1 style="color: #4784e6; font-size: 8rem;">LIST OF BOOKINGs</h1>
    </div>
    <section class="account-section">
        <div class="account table-responsive">
            <table class="center table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Full Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone number (+91)</th>
                        <th scope="col">Location</th>
                        <th scope="col">Grade</th>
                        <th scope="col">Guests</th>
                        <th scope="col">Order date</th>
                        <th scope="col">Departure Date</th>
                        <th scope="col">Return Date</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $rows = mysqli_num_rows($result);
                    if ($rows == 0) {
                        echo "<tr><td colspan='11'>".'No Records Found'."</td></tr>";
                    } else {
                        while ($res = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            echo "<tr>";
                            echo "<td>" . $res['name'] . "</td>";
                            echo "<td class='email'>" . $res['email'] . "</td>";
                            echo "<td>" . $res['phone'] . "</td>";
                            echo "<td>" . $res['location'] . "</td>";
                            echo "<td>" . $res['grade'] . "</td>";
                            echo "<td>" . $res['guests'] . "</td>";
                            echo "<td>" . $res['order_date'] . "</td>";
                            echo "<td>" . $res['departure_date'] . "</td>";
                            echo "<td>" . $res['return_date'] . "</td>";
                            echo "<td>" . $res['price'] . "</td>";
                            echo "<td><a href=\"edit.php?id=$res[id]\"><button button type='button' class='account-btn btn btn-primary'>Edit</button></a>  <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\"><button button type='button' class='account-btn btn btn-danger'>Delete</button></a></td>";
                        }
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- list of booking ends -->

    <!-- footer section  -->

    <footer>
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


        <section class="footer" style="background:url(images/footer-bg.jpg) no-repeat">
            <div class="newsletter">
                <form action="index.php" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">
                            <h1>Subscribe to our newsletter</h1>
                        </label>
                        <div>
                            <input type="email" name="sub_email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            <button type="submit" class="btn btn-primary" name="subscribe">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="box-container">
                <div class="box">
                    <h3>Branch Locations</h3>
                    <a href="#" class="text-decoration-none"><i class="fas fa-angle-right"></i>India</a>
                    <a href="#" class="text-decoration-none"><i class="fas fa-angle-right"></i>USA</a>
                    <a href="#" class="text-decoration-none"><i class="fas fa-angle-right"></i>Japan</a>
                    <a href="#" class="text-decoration-none"><i class="fas fa-angle-right"></i>France</a>
                </div>
                <div class="box">
                    <table>
                        <tr>
                            <h3>Quick Links</h3>
                        </tr>
                        <tr>
                            <td>
                                <a href="home.php" class="text-decoration-none"><i class="fas fa-angle-right"></i>Home</a>
                                <a href="package.php" class="text-decoration-none"><i class="fas fa-angle-right"></i>Packages</a>
                                <a href="book.php" class="text-decoration-none"><i class="fas fa-angle-right"></i>Book</a>
                                <a href="about.php" class="text-decoration-none"><i class="fas fa-angle-right"></i>About</a>
                            </td>
                            <td>
                                <a href="review.php" class="text-decoration-none"><i class="fas fa-angle-right"></i>Review</a>
                                <a href="contact.php" class="text-decoration-none"><i class="fas fa-angle-right"></i>Contact</a>
                                <a href="#" class="text-decoration-none"><i class="fas fa-angle-right"></i>Privacy Policy</a>
                                <a href="#" class="text-decoration-none"><i class="fas fa-angle-right"></i>Terms Of Use</a>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="box">
                    <h3>Contact Info</h3>
                    <a href="#" class="text-decoration-none"><i class="fas fa-phone"></i>+123-456-7890</a>
                    <a href="#" class="text-decoration-none"><i class="fas fa-phone"></i>+123-456-7890</a>
                    <a href="#" class="text-decoration-none"><i class="fas fa-envelope"></i>travel@enquiry.com</a>
                    <a href="#" class="text-decoration-none"><i class="fas fa-map"></i>Mumbai, India - 40014</a>
                </div>
                <div class="box">
                    <h3>Follow Us</h3>
                    <a href="#" class="text-decoration-none"><i class="fa-brands fa-facebook"></i>Facebook</a>
                    <a href="#" class="text-decoration-none"><i class="fa-brands fa-twitter"></i>Twitter</a>
                    <a href="#" class="text-decoration-none"><i class="fa-brands fa-instagram"></i>Instagram</a>
                </div>
            </div>
            <div class="col-md-12 text-center">
                <h1 class="credit">
                    <p>Copyright © 2022. All rights reserved.</p>
                </h1>
            </div>
            </div>

        </section>
    </footer>

    <!-- swiper js link -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- custom js file link  -->
    <script src="package.js"></script>

    </footer>

</body>

</html>