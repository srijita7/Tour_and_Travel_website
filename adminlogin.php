<?php include('server.php') ?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin Login</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- bootstrap cdn -->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>
<style>
    .heading {
        margin-bottom: 5px;
        padding: 50px;
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
        background-color: #fceeed;
        padding: 1px;
        margin-bottom: 40px;
        border-radius: 20px;
        width: 70%;
        margin-top: 20px;
    }

    .inputBox {
        margin: 30px;
    }

    #register-form button {
        width: 100%;
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
        width: 100%;
    }

    .help-block {
        display: block;
        margin-top: 5px;
        margin-bottom: 10px;
    }

    .form-styling {
        width: 70%;
    }
</style>

<body>
    <!-- header section starts  -->

    <section class="header">

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

    </section>

    <!-- header section ends -->
    <div class="heading">
        <h1 style="color: var(--colorMain);">Admin Login</h1>
    </div>

    <div class="container">
        <form method="post" action="adminlogin.php" class="form-styling" id="register-form">
            <?php include('error.php'); ?>
            <div class="inputBox">
                <span>Username</span>
                <input type="text" class="form-control" name="username">
            </div>
            <div class="inputBox">
                <span>Password</span>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="inputBox">
                <button type="submit" class="form-control btn" name="login_admin">Login</button>
            </div>
        </form>
    </div>
    
</body>

</html>