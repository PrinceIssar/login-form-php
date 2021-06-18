<?php
require('connection.php');
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Login & Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h2>User Dashboard</h2>
    <nav>
        <a href="">Home</a>
        <a href="">Contact</a>
        <a href="">Home</a>
        <a href="">About</a>
    </nav>
    <?php
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true)
    {
        echo "
      <div class='user'> 
        $_SESSION[username] - <a href='logout.php'>LOGOUT</a>
        </div>
        ";
    }
    else
    {
        // you can't put double quotes in double quotes
echo "
        <div class='sign-in-up'>
        <button type='button' onclick=\"popup('login-popup')\" >Login</button>
        <button type='button' onclick=\"popup('register-popup')\">Register</button>
        </div>
          ";
    }

    ?>
</header>

<div class="popup-container" id="login-popup">
    <div class="popup">
        <form method="POST" action="login_register.php">
            <h2>
                <span> USER LOGIN</span>
                <button type="reset" onclick="popup('login-popup')">X</button>
            </h2>
<!--            user can use both username or email because of name="email_username" -->
            <input type="text" placeholder="E-mail or Username" name="email_username">
            <input type="password" placeholder="Password"  name="password">
            <button type="submit" class="login-btn" name="login">LOGIN</button>
        </form>
    </div>
</div>


<div class="popup-container" id="register-popup" >
    <div class="register popup">
        <form method="POST" action="login_register.php">
            <h2>
                <span> USER REGISTER</span>
                <button type="reset" onclick="popup('register-popup')">X</button>
            </h2>
            <input type="text" placeholder="Full Name" name="fullname">
            <input type="text" placeholder="Username"  name="username">
            <input type="email" placeholder="E-mail"  name="email">

            <input type="password" placeholder="Password"  name="password">
            <button type="submit" class="register-btn" name="register">Register</button>
        </form>
    </div>
</div>

<?php
//set available and also true : value assigned
 if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true)
 {
     echo "<h1 style= 'text-align: center; margin-top: 200px'> Welcome to $_SESSION[username]</h1>";
 }
?>



<script src="script.js"></script>
</body>
</html>