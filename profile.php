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
<!DOCTYPE html>
<html>

<head>
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  <title>Edit Account Details</title>
  <!-- font awesome cdn link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" type="text/css" href="style.css">
  <!-- bootstrap cdn -->
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<style>
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
    max-width: fit-content;
    margin-top: 20px;
  }

  .inputBox {
    margin: 30px;
  }

  #register-form button {
    min-width: 100px;
    border-radius: 10px;
    color: var(--colorMain);
    background-color: aquamarine;
    border: 3px solid #a9b7af;
    padding: 16px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 20px;
    margin: 4px 2px;
    transition-duration: 0.4s;
    cursor: pointer;
    margin-bottom: 3rem;
    text-transform: uppercase;
    font-weight: 500;
  }

  #register-form button:hover {
    background-color: #a9b7af;
    color: white;
  }

  #register-form input[type="text"],
  #register-form textarea {
    width: 100%;
    border-width: 0.3rem;
  }

  #register-form .form-group {
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

  .help-block {
    display: block;
    margin-top: 5px;
    margin-bottom: 10px;
  }
</style>

<body>
  <section class="login header">

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
        <a href="register.php"><button type="button" class="btn btn-warning" style="color: blue;"><b>Register</b></button></a><?php } ?>
    </nav>
  </section>
  <div class="heading">
    <h1 style="color: var(--colorMain);">Edit Account Details</h1>
  </div>
  <?php
  $result = mysqli_query($conn, "SELECT * FROM users WHERE username='" . $_SESSION['username'] . "'");
  $res = mysqli_fetch_array($result, MYSQLI_ASSOC);
  if (isset($_POST['save'])) {
    $username = $_SESSION['username'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['contact']);
    $query = "UPDATE users SET full_name='$name', email='$email', contact='$phone' where username='$username'";
    echo "hello";
    mysqli_query($conn, $query);
    if (!$query) { ?>
      <div class="error">
        <p><?php echo "Changes not saved. Please try again later."; ?></p>
      </div>
  <?php } else {
      echo "<meta http-equiv='refresh' content='0'>";
    }
  }
  ?>
  <div class="container">
    <form method="POST" action="profile.php" class="form-styling" id="register-form">

      <div class="inputBox">
        <span>Full Name</span>
        <input type="text" class="form-control" name="name" value="<?php echo $res['full_name']; ?>" required>
      </div>
      <div class="inputBox">
        <span>Username <span style="color: red;" class="help-block">Only letters, underscore and numbers allowed without spaces</span></span>
        <input type="text" class="form-control" pattern="^[A-Za-z0-9_]+" name="username" value="<?php echo $res['username']; ?>" disabled>
      </div>
      <div class="inputBox">
        <span>Email</span>
        <input type="email" class="form-control" name="email" value="<?php echo $res['email']; ?>" required>
      </div>
      <div class="inputBox">
        <span>Contact number (+91) </span>
        <input type="tel" class="form-control" pattern="^\d{10}$" name="contact" value="<?php echo $res['contact']; ?>" required>
      </div>
      <div class="inputBox">
        <button type="submit" class="form-control btn" name="save">Save Changes</button>
      </div>
    </form>
  </div>
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
          <p>Copyright ?? 2022. All rights reserved.</p>
        </h1>
      </div>
      </div>

    </section>
  </footer>


</body>

</html>