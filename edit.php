<!DOCTYPE html>
<?php session_start();
include('dbconnection.php');
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: index.php");
}
$result = mysqli_query($conn, "SELECT * FROM book WHERE id='" . $_GET["id"] . "'");
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
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

    <!-- booking section starts -->

    <div class="heading" style="background:url(images/header-bg-3.png) no-repeat">
        <h1>UPDATE BOOKING</h1>
    </div>

    <h1 class="heading"><b>update your booked trip ! </b></h1>

    <?php

    $errors = array();
    $name = "";
    $email = "";
    $phone = "";
    $guests = "";
    $departure = "";
    $return = "";
    if (isset($_POST['update'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $location = mysqli_real_escape_string($conn, $_POST['location']);
        $grade = mysqli_real_escape_string($conn, $_POST['grade']);
        $guests = mysqli_real_escape_string($conn, $_POST['guests']);
        $departure = mysqli_real_escape_string($conn, $_POST['departure']);
        $return = mysqli_real_escape_string($conn, $_POST['return']);

        // checking empty fields
        if (empty($name)) {
            array_push($errors, "Full Name is required");
        }
        if (empty($email)) {
            array_push($errors, "Email ID is required");
        }
        if (empty($phone)) {
            array_push($errors, "Phone number is required");
        }
        if (empty($location)) {
            array_push($errors, "Select location");
        }
        if (empty($grade)) {
            array_push($errors, "Select grade");
        }
        if (empty($guests)) {
            array_push($errors, "Enter number of guests");
        }
        if (empty($departure)) {
            array_push($errors, "Departure date is required");
        }
        if (empty($return)) {
            array_push($errors, "Return date is required");
        }
        if ($return < $departure) {
            array_push($errors, "Return date should be after departure date");
        }

        if ($guests == 0) {
            array_push($errors, "Number of guests cannot be 0");
        }

        if (!empty($guests)) {
            $price = $guests * 90;
        }

        include('error.php');

        if (count($errors) == 0) {
            $timezone = date_default_timezone_get();
            date_default_timezone_set("Asia/Kolkata");
            $date = date('Y-m-d H:i:s');
            $id = $_GET['id'];
            $query = "UPDATE book SET name='$name', email='$email', phone='$phone', location='$location', grade='$grade', guests={$guests}, order_date='$date', departure_date='$departure', return_date='$return', price='$price' where id={$id}";
            mysqli_query($conn, $query);
            $_SESSION['update'] = "update successful";
            if (!isset($_SESSION['update'])) { ?>
                <div class="error">
                    <p><?php echo "Booking update not successful. Please try again later.";
                        header('location: edit.php'); ?></p>
                </div>
    <?php } else {
                header('location: account.php');
            }
        }
    }
    ?>

    <section class="book">

        <form method="post" action="" class="book-form">

            <div class="flex">
                <div class="inputBox">
                    <span>Full Name : </span>
                    <input type="text" placeholder="Enter your Full Name" name="name" value="<?php echo $row["name"]; ?>">
                </div>
                <div class="inputBox">
                    <span>Email : </span>
                    <input type="email" placeholder="Enter your Email" name="email" value="<?php echo $row["email"]; ?>">
                </div>
                <div class="inputBox">
                    <span>Phone Number (+91) : </span>
                    <input type="tel" placeholder="Enter your Phone Number" name="phone" pattern="^\d{10}$" value="<?php echo $row["phone"]; ?>">
                </div>
                <div class="inputBox">
                    <label for="location">Location : </label>
                    <?php $location = $row["location"] ?>
                    <select name="location" id="location" required>
                        <option value="Mumbai" <?php if ($location == "Mumbai") echo 'selected="selected"'; ?>>Mumbai</option>
                        <option value="Hawaii" <?php if ($location == "Hawaii") echo 'selected="selected"'; ?>>Hawaii</option>
                        <option value="Sydney" <?php if ($location == "Sydney") echo 'selected="selected"'; ?>>Sydney</option>
                        <option value="Paris" <?php if ($location == "Paris") echo 'selected="selected"'; ?>>Paris</option>
                        <option value="Tokyo" <?php if ($location == "Tokyo") echo 'selected="selected"'; ?>>Tokyo</option>
                        <option value="Egypt" <?php if ($location == "Egypt") echo 'selected="selected"'; ?>>Egypt</option>
                        <option value="Bali" <?php if ($location == "Bali") echo 'selected="selected"'; ?>>Bali</option>
                        <option value="Dubai" <?php if ($location == "Dubai") echo 'selected="selected"'; ?>>Dubai</option>
                        <option value="Antarctica" <?php if ($location == "Antarctica") echo 'selected="selected"'; ?>>Antarctica</option>
                        <option value="Seoul" <?php if ($location == "Seoul") echo 'selected="selected"'; ?>>Seoul</option>
                        <option value="Bora Bora" <?php if ($location == "Bora Bora") echo 'selected="selected"'; ?>>Bora Bora</option>
                        <option value="Havana" <?php if ($location == "Havana") echo 'selected="selected"'; ?>>Havana</option>
                    </select>
                </div>
                <div class="inputBox">
                    <label for="activity">Grade : </label>

                    <select name="grade" id="grade" required>
                        <option value="tourist" <?php if ($row["grade"] == "tourist") echo 'selected="selected"'; ?>>Tourist</option>
                        <option value="superior tourist" <?php if ($row["grade"] == "superior tourist") echo 'selected="selected"'; ?>>Superior Tourist</option>
                        <option value="standard" <?php if ($row["grade"] == "standard") echo 'selected="selected"'; ?>>Standard</option>
                        <option value="superior standard" <?php if ($row["grade"] == "superior standard") echo 'selected="selected"'; ?>>Superior Standard</option>
                        <option value="comfort" <?php if ($row["grade"] == "comfort") echo 'selected="selected"'; ?>>Comfort</option>
                    </select>
                </div>
                <div class="inputBox">
                    <span>Number of guests :</span>
                    <input type="number" placeholder="number of guests" name="guests" value="<?php echo $row["guests"]; ?>">
                </div>
                <div class="inputBox">
                    <span>Departure Date :</span>
                    <input type="date" name="departure" value="<?php echo $row["departure_date"]; ?>">
                </div>
                <div class="inputBox">
                    <span>Return Date :</span>
                    <input type="date" name="return" value="<?php echo $row["return_date"]; ?>">
                </div>
            </div>

            <input type="submit" value="update" class="book-btn" name="update">

        </form>
        <div class="hero-img">
            <img src="images/hero.jpg" alt="">
        </div>

    </section>

    <!-- booking section ends -->

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