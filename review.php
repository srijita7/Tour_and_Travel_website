<!DOCTYPE html>
<?php session_start();
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: review.php");
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

</head>
<style>
    h2 {
        margin-top: 3rem;
        margin-bottom: 3rem;
        text-align: center;
        color: black;
        font-size: 5rem;
        font-weight: 900;
    }

    .container {
        font-family: 'Open Sans', sans-serif;
        font-size: 20px;
        margin: 20px;
        color: #7d7d82;
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        margin: auto;
        width: 87%;
        background-color: #fceeed;
        padding: 30px;
        margin-bottom: 40px;
        border-radius: 20px;
    }

    .inputBox {
        margin: 20px;
    }

    .inputBox-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .star {
        width: 32px;
        height: 32px;
        transition: .6s all;
        margin: 10px;
    }

    #rating {
        cursor: pointer;
        display: inline-block
    }

    #review-form .btn {
        min-width: 100px;
        border-radius: 10px;
        color: #a9b7af;
        background-color: white;
        border: 3px solid #a9b7af;
        padding: 16px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        transition-duration: 0.4s;
        cursor: pointer;
        margin-bottom: 3rem;
    }

    #review-form .btn:hover {
        background-color: #a9b7af;
        color: white;
    }

    #review-form input[type="text"],
    #review-form textarea {
        width: 100%;
        border-width: 0.3rem;
    }

    #review-form .form-group {
        margin-bottom: 20px;
    }

    .form-control {
        padding: 10px;
        border-radius: 10px;
        background-color: white;
        border: 3px solid #a9b7af;
        margin: 4px 2px;
        font-size: 17px;
    }

    #review-form .help-block {
        display: block;
        margin-top: 5px;
        margin-bottom: 10px;
    }

    .review-slider {
        margin-bottom: 10rem;
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
            <a href="review.php" class="text-decoration-none" style="color: #4784e6;"><b>Reviews</b></a>
            <a href="contact.php" class="text-decoration-none">Contact Us</a>
            <a href="admin.php" class="text-decoration-none">Admin</a>
            <?php if (isset($_SESSION['username'])) {
                $result = mysqli_query($conn, "SELECT email, full_name FROM users WHERE username='" . $_SESSION['username'] . "'");
                $res = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $name = $res['full_name'];
                $email = $res['email'];
            ?>
                <a href="dashboard.php"><button type="button" class="btn btn-primary"><i class="fa-solid fa-user"></i><?php echo " " . $_SESSION['username']; ?></button></a>
                <a href="about.php?logout='1'"><button type="button" class="btn btn-danger"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</button></a> <?php } else { ?>
                <a href="login.php"><button type="button" class="btn btn-primary">Login</button></a>
                <a href="register.php"><button type="button" class="btn btn-warning">Register</button></a><?php } ?>
        </nav>
    </section>

    <!-- header section ends -->

    <!-- review section starts -->
    <div class="heading" style="background:url(images/header-bg-1.jpg) no-repeat">
        <h1 style="color: white; font-size: 8rem;">CUSTOMER REVIEWS</h1>
    </div>
    <section class="review" id="review">

        <div class="swiper review-slider">

            <div class="swiper-wrapper">
                <?php
                    $result = mysqli_query($conn, "SELECT * FROM review ORDER BY reviewDate DESC");
                    $rows = mysqli_num_rows($result);
                    if ($rows > 0) {
                        while ($res = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
                            <div class="swiper-slide">
                                <div class="slide">
                                    <img src="profilepics/<?php echo $res['profilepic'] ?>" alt="">
                                    <h3><?php echo $res['name'] ?></h3>
                                    <p><?php echo $res['review'] ?></p>
                                    <div class="stars">
                                        <?php
                                        $rating = $res['rating'];
                                        for ($x = 1; $x <= $rating; $x++) {
                                            echo "<i class='fas fa-star'></i>";
                                        }
                                        for ($x = 5; $x > $rating; $x--) {
                                            echo "<i class='far fa-star'></i>";
                                        }
                                        ?>
                                    </div>
                                    <span><?php echo $res['grade'] ?></span>
                                </div>
                            </div>
                <?php }
                    }?>
                <div class="swiper-slide">
                    <div class="slide">
                        <img src="images/pic1.png" alt="">
                        <h3>Emily Dane</h3>
                        <p>Excellent. Our best tour operator yet. The itinerary was carefully thought through and well balanced. The trip represented great travel for the cost. Our booking was easy, the pre-information packet was timely and thorough. Interim questions were handled promptly and thoroughly, including going out of their way to help us with some hard to get reservations.</p>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <span>Tourist</span>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="slide">
                        <img src="images/pic2.png" alt="">
                        <h3>John Stark</h3>
                        <p>The combination of our beautiful gleaming gulet, a totally professional crew, a talented chef producing exquisite yet simple dishes, our lovely local guide and our scholar tour leader who led us into the magic of the ancient world with charm and humour was a rare privilege. </p>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <span>Super Tourist</span>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="slide">
                        <img src="images/pic3.png" alt="">
                        <h3>Jeenie Weenie</h3>
                        <p>The combination of cruising, walking through fascinating archaeological sites, swimming in warm clear waters - is just a winner. It is the best holiday we have ever had. Many thanks for your meticulous attention to our comfort.</p>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <span>Standard</span>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="slide">
                        <img src="images/pic4.png" alt="">
                        <h3>Mark Drek</h3>
                        <p>This was a superb tour... beautifully crafted. The accommodation was wonderful and the food/wine experiences truly memorable. </p>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span>Comfort</span>
                    </div>
                </div>

            </div>

        </div>
        <?php
        $errors = array();
        $review = "";
        if (isset($_POST['send'])) {
            $username = $_SESSION['username'];
            $result = mysqli_query($conn, "SELECT email, full_name FROM users WHERE username='" . $_SESSION['username'] . "'");
            $res = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $name = $res['full_name'];
            $email = $res['email'];
            $grade = $_POST['grade'];
            $rating = $_POST['finalRating'];
            $review = $_POST['review'];
            if (!($_FILES["profilepic"]["error"] == 4)) {
                $ppic = $_FILES["profilepic"]["name"];
                // allowed extensions
                $allowed_extensions = array("jpg", "jpeg", "png");
                // Validation for allowed extensions .in_array() function searches an array for a specific value.
                $ext = pathinfo($ppic, PATHINFO_EXTENSION);
                if (!in_array($ext, $allowed_extensions)) {
                    array_push($errors, "Only .jpg .jpeg .png files allowed");
                } elseif ($_FILES["profilepic"]["size"] > 20000) {
                    array_push($errors, "File size should be within 20kb");
                } else {
                    //rename the image file
                    $imgnewfile = md5($ppic) . time() . $ext;
                    // Code for move image into directory
                    move_uploaded_file($_FILES["profilepic"]["tmp_name"], "profilepics/" . $imgnewfile);
                }
            } else {
                $imgnewfile = "default.png";
            }
            include('error.php');

            if (count($errors) == 0) {

                $query = mysqli_query($conn, "insert into review(username,name,email,grade,rating,review,profilepic) value('$username','$name','$email','$grade','$rating','$review','$imgnewfile')");
                mysqli_query($conn, $query);

                if (!$query) { ?>
                    <div class="error">
                        <p><?php echo "Review not added. Please try again later."; ?></p>
                    </div>
        <?php } else {
                    echo "<meta http-equiv='refresh' content='0'>";
                }
            }
        }
        ?>
        <?php if (isset($_SESSION['username'])) { ?>
            <h2>Add Review</h2>
            <div class="container">
                <form method="POST" id="review-form" action="review.php" enctype="multipart/form-data">
                    <div class="inputBox">
                        <span>Full Name</span>
                        <div><input type="text" required="true" class="form-control" placeholder="Full Name" name="name" id="name" value="<?php echo $name; ?>" disabled></div>
                    </div>
                    <div class="inputBox">
                        <span>Email</span>
                        <input type="text" required="true" placeholder="Email" class="form-control" name="email" id="email" value="<?php echo $email; ?>" disabled>
                    </div>
                    <div class="inputBox">
                        <label for="activity">Grade</label>

                        <select name="grade" id="grade" class="form-control form-select" required>
                            <option value="tourist">Tourist</option>
                            <option value="superior tourist">Superior Tourist</option>
                            <option value="standard">Standard</option>
                            <option value="superior standard">Superior Standard</option>
                            <option value="comfort">Comfort</option>
                        </select>
                    </div>
                    <div class="inputBox">
                        <span>Choose image</span>
                        <input type="file" class="form-control" name="profilepic">
                        <span style="color: red; font-size:17px;">Only jpg / jpeg/ png format allowed. Maximum file size 20kb.</span>
                    </div>
                    <div class="inputBox">
                        <span>Rating</span>
                        <div id="rating">
                            <svg class="star" id="1" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" style="fill: #f4b5b6;">
                                <polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566"></polygon>
                            </svg>
                            <svg class="star" id="2" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" style="fill: #f4b5b6;">
                                <polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566"></polygon>
                            </svg>
                            <svg class="star" id="3" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" style="fill: #f4b5b6;">
                                <polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566"></polygon>
                            </svg>
                            <svg class="star" id="4" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" style="fill: #f4b5b6;">
                                <polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566"></polygon>
                            </svg>
                            <svg class="star" id="5" viewBox="0 12.705 512 486.59" x="0px" y="0px" xml:space="preserve" style="fill: #808080;">
                                <polygon points="256.814,12.705 317.205,198.566 512.631,198.566 354.529,313.435 414.918,499.295 256.814,384.427 98.713,499.295 159.102,313.435 1,198.566 196.426,198.566"></polygon>
                            </svg>
                        </div>
                        <span id="starsInfo" class="help-block">
                            Click on a star to change your rating 1 - 5, where 5 = great! and 1 = really bad
                        </span>
                        <input type="text" id="finalRating" name="finalRating" value="4" style="display: none;">
                    </div>

                    <div class="inputBox form-group">
                        <span>Your Review</span>
                        <textarea class="form-control" rows="5" maxlength="999" placeholder="Add your review" name="review" id="review" value="<?php echo $review; ?>" required></textarea>
                        <span id="reviewInfo" class="help-block pull-right">
                            <span id="remaining">999</span> Characters remaining
                        </span>
                    </div>
                    <div class="inputBox-btn">
                        <input type="submit" value="submit" class="btn btn-primary" name="send">
                        <span id="submitInfo" class="help-block">
                            By clicking <strong>Submit</strong>, I authorize the sharing of my name and review on the web. (email will not be shared)
                        </span>
                    </div>
                </form>
            </div><?php } ?>
    </section>

    <!-- review section ends -->

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
    <script src="script.js"></script>

</body>

</html>