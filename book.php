<!DOCTYPE html>
<?php session_start();
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: review.php");
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
            <a href="about.php" class="text-decoration-none" >About</a>
            <a href="package.php" class="text-decoration-none">Packages</a>
            <a href="book.php" class="text-decoration-none" style="color: #4784e6"><b>Book</b></a>
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
        <h1>BOOKING</h1>
    </div>

    <h1 class="heading"><b>book your trip ! </b></h1>

    <?php
    //including the database connection file
    include('dbconnection.php');
    $errors = array();
    $name = "";
    $email = "";
    $phone = "";
    $guests = "";
    $departure = "";
    $return = "";
    if (isset($_POST['send'])) {
        $username = $_SESSION['username'];
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

            $query = "INSERT INTO book (username, name, email, phone, location, grade, guests, departure_date, return_date, price) 
                      VALUES('$username', '$name', '$email', '$phone', '$location', '$grade', '$guests', '$departure', '$return', '$price')";
            mysqli_query($conn, $query);
            $_SESSION['book'] = "booking successful";
            if (!isset($_SESSION['book'])) { ?>
                <div class="error">
                    <p><?php echo "Booking not successful. Please try again later.";
                        header('location: book.php'); ?></p>
                </div>
            <?php } else {
                header('location: dashboard.php');
            }
        }
    }
    ?>

    <section class="book">

        <form method="post" action="book.php" class="book-form">

            <div class="flex">
                <div class="inputBox">
                    <span>Full Name : </span>
                    <input type="text" placeholder="Enter your Full Name" name="name" value="<?php echo $name; ?>">
                </div>
                <div class="inputBox">
                    <span>Email : </span>
                    <input type="email" placeholder="Enter your Email" name="email" value="<?php echo $email; ?>">
                </div>
                <div class="inputBox">
                    <span>Phone Number (+91) : </span>
                    <input type="tel" placeholder="Enter your Phone Number" name="phone" pattern="^\d{10}$" value="<?php echo $phone; ?>">
                </div>
                <div class="inputBox">
                    <label for="location">Location : </label>

                    <select name="location" id="location" required>
                        <option value="Mumbai">Mumbai</option>
                        <option value="Hawaii">Hawaii</option>
                        <option value="Sydney">Sydney</option>
                        <option value="Paris">Paris</option>
                        <option value="Tokyo">Tokyo</option>
                        <option value="Egypt">Egypt</option>
                        <option value="Bali">Bali</option>
                        <option value="Dubai">Dubai</option>
                        <option value="Antarctica">Antarctica</option>
                        <option value="Seoul">Seoul</option>
                        <option value="Bora Bora">Bora Bora</option>
                        <option value="Havana">Havana</option>
                    </select>
                </div>
                <div class="inputBox">
                    <label for="activity">Grade : </label>

                    <select name="grade" id="grade" required>
                        <option value="tourist">Tourist</option>
                        <option value="superior tourist">Superior Tourist</option>
                        <option value="standard">Standard</option>
                        <option value="superior standard">Superior Standard</option>
                        <option value="comfort">Comfort</option>
                    </select>
                </div>
                <div class="inputBox">
                    <span>Number of guests :</span>
                    <input type="number" placeholder="number of guests" name="guests" value="<?php echo $guests; ?>">
                </div>
                <div class="inputBox">
                    <span>Departure Date :</span>
                    <input type="date" name="departure" value="<?php echo $departure; ?>">
                </div>
                <div class="inputBox">
                    <span>Return Date :</span>
                    <input type="date" name="return" value="<?php echo $return; ?>">
                </div>
            </div>

            <input type="submit" value="submit" class="book-btn" name="send">

        </form>
        <div class="hero-img">
            <img src="images/hero.jpg" alt="">
        </div>

    </section>

    <!-- booking section ends -->

    <!-- footer section  -->

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