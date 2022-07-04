<!DOCTYPE html>
<?php session_start();
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: contact.php");
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
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
    /* contact */
    .contact-grids {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-flow: wrap;
    }

    .contact-heading h3 {
        text-transform: capitalize;
        text-align: center;
        font-size: 3em;
        font-weight: 600;
        color: #ffffff;
    }

    .contact-form input[type="text"],
    .contact-form input[type="email"],
    textarea {
        margin: 1em 0;
        padding: .6em 1em;
        width: 100%;
        background: #fff;
        border: none;
        font-size: 1.6rem;
    }

    textarea {
        height: 100px;
    }

    input.form-control:focus {
        box-shadow: none;
    }

    button.btn.btn-default:focus {
        outline: none;
    }

    iframe {
        width: 100%;
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
            <a href="contact.php" class="text-decoration-none" style="color: #4784e6;"><b>Contact Us</b></a>
            <a href="admin.php" class="text-decoration-none">Admin</a>
            <?php if (isset($_SESSION['username'])) { ?>
                <a href="dashboard.php"><button type="button" class="btn btn-primary"><i class="fa-solid fa-user"></i><?php echo " " . $_SESSION['username']; ?></button></a>
                <a href="index.php?logout='1'"><button type="button" class="btn btn-danger"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</button></a> <?php } else { ?>
                <a href="login.php"><button type="button" class="btn btn-primary">Login</button></a>
                <a href="register.php"><button type="button" class="btn btn-warning">Register</button></a><?php } ?>
        </nav>

    </section>

    <!-- header section ends -->

    <!-- contact section -->
    <div class="heading" style="background:url(images/header-bg-5.png) no-repeat">
        <h1 style="color: white; font-size: 8rem;">CONTACT US</h1>
    </div>
    <?php
    //including the database connection file
    include('dbconnection.php');
    $errors = array();
    $name = "";
    $email = "";
    $phone = "";
    $message = "";
    if (isset($_POST['send'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);

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
        if (empty($message)) {
            array_push($errors, "Message is empty");
        }

        include('error.php');

        if (count($errors) == 0) {

            $query = "INSERT INTO contact(name, email, phone, message) 
                      VALUES('$name', '$email', '$phone', '$message')";
            mysqli_query($conn, $query);
            $_SESSION['contact'] = "message sent";
            if (!isset($_SESSION['contact'])) { ?>
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Error</h4>
                            </div>
                            <div class="modal-body">
                                <p>could not send message. Pls try again later</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>
    <?php } else {
                header('location: contact.php');
            }
        }
    }
    ?>
    <h2 style="text-align: center; margin-top: 5rem;"><b>Need to get in touch with us ? Either fill out the form with your inquiry or find the department email you'd like to contact below.</b></h2>
    <section class="contact" id="contact">
        <div class="container">
            <div class="contact-grids">
                <div class=" col-md-6 map">
                    <iframe width="600" height="500" frameborder="0" style="border:0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d471220.5630456815!2d88.0495352874353!3d22.675752091875815!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f882db4908f667%3A0x43e330e68f6c2cbc!2sKolkata%2C%20West%20Bengal!5e0!3m2!1sen!2sin!4v1655578901670!5m2!1sen!2sin" allowfullscreen></iframe>

                </div>
                <div class=" col-md-6 contact-form">
                    <form method="post" action="" class="book-form">

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
                                <span>What can we help you with ? </span>
                                <textarea placeholder="Message" required="" name="message" maxlength="500" value="<?php echo $message; ?>"></textarea>
                            </div>
                        </div>
                        <input type="submit" value="submit" class="book-btn" name="send">
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>

    <!-- contact section -->

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


    <section class="footer">
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
                            <a href="#gallery" class="text-decoration-none"><i class="fas fa-angle-right"></i>gallery</a>
                        </td>
                        <td>
                            <a href="#review" class="text-decoration-none"><i class="fas fa-angle-right"></i>review</a>
                            <a href="#contact" class="text-decoration-none"><i class="fas fa-angle-right"></i>contact</a>
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
                <a href="#" class="text-decoration-none"><i class="fas fa-envelope"></i>travelogged@enquiry.com</a>
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
    <script src="script.js"></script>



</body>

</html>