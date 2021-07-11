<?php
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>
<html>
<html lang="en">
<head>
        <title> Stratos </title>
        <link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
        <script src="assets/js/jquery-3.5.1.js"></script>
        <script src="assets/js/register.js"></script>
</head>
<body>
    <?php
        if (isset($_POST['register_button'])) {
            echo '
            <script>
            $(document).ready(function() {
                $("#first").hide();
                $("#second").show();
            });
            </script>
            ';
    }
    ?>
    <div class="wrapper">
    <div class="left details" >
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
    Explicabo, esse consequatur alias repellat in excepturi inventore ad asperiores tempora ipsa. 
    Accusantium tenetur voluptate labore aperiam molestiae rerum excepturi minus in pariatur praesentium, 
    corporis, aliquid dicta.
    </div>
    <div class="login_box right">
    <div class="login_header">
            <a href="register.php" class="logo" > Sorosoke </a>
            Login or signup
    </div>
    <div id="first">
        <form action="register.php" method="POST">
            <input type="email" name="log_email" placeholder="Email Address"  class="log_input inputfirst" value="<?php
            if (isset($_SESSION['log_email'])) {
                echo $_SESSION['log_email'];
            }
            ?>" required><br>
            <input type="password" name="log_password" placeholder="Password" class="log_input" >
            <br>
            <?php if(in_array("Email or Password incorrect<br>", $error_array))
                echo "Email or Password incorrect<br>"; ?>
            
            <a href="#" class="signup"> Forgot Password &nbsp;&nbsp;&nbsp;</a>

            <input type="submit" name="login_button" class="loginbutton" value="Login">
            <br>
            <a href="#" id="signup" class="signup"> Create Account</a>
            
        </form>
    </div>
        

    <div id="second">

            <form action="register.php" method="POST">
                <input type="text" name="reg_fname"  class="log_input" placeholder="First Name" value="<?php
                if(isset($_SESSION['reg_fname'])) {
                    echo $_SESSION['reg_fname'];
                }
                ?>" required>
                <br>
                <?php if(in_array("Please use a real first name<br>", $error_array)) {
                    echo "Please use a real first name<br>";
                } ?>

                <input type="text" name="reg_lname"  class="log_input" placeholder="Last Name" value="<?php
                if(isset($_SESSION['reg_lname'])) {
                    echo $_SESSION['reg_lname'];
                }
                ?>" required>
                <br>
                <input type="radio" name="gender" value="male" > Male &nbsp;
                <input type="radio" name="gender" value="female"> Female&nbsp;
                <input type="radio" name="gender" value="other"> Other<br>
                <?php if (in_array("Please use a real last name<br>", $error_array)) {
                    echo "Please use a real last name<br>";
                } ?>

                <input type="email" name="reg_email"  class="log_input" placeholder="Email" value="<?php
                if(isset($_SESSION['reg_email'])) {
                    echo $_SESSION['reg_email'];
                }
                ?>" required>
                <br>
                <input type="email" name="reg_email2"  class="log_input" placeholder="Confirm Email" value="<?php
                if(isset($_SESSION['reg_email2'])) {
                    echo $_SESSION['reg_email2'];
                }
                ?>" required>
                <br>
                <?php if (in_array("Email already exists<br>", $error_array)) 
                    echo "Email already exists<br>";
                 elseif (in_array("Invalid email format<br>", $error_array)) 
                    echo "Invalid email format<br>";
                 elseif (in_array("Emails don't match<br>", $error_array)) 
                    echo "Emails don't match<br>";
                 ?>

                <input type="password" name="reg_password"  class="log_input" placeholder="Password" required>
                <br>
                <input type="password" name="reg_password2"  class="log_input" placeholder="Confirm Password" required>
                <br>
                <?php if (in_array("Your passwords do not match<br>", $error_array))
                    echo "Your passwords do not match<br>";
                 elseif (in_array("Your passwords can only be in english letters and numbers<br>", $error_array)) 
                    echo "Your passwords can only be in english letters and numbers<br>";
                 elseif (in_array("Password too long or short<br>", $error_array)) 
                    echo "Password too long or short<br>";
                 ?>

                <input type="submit" name="register_button"  class="loginbutton" value="Register">
                <br>
                <?php if(in_array("<span style='color: #000000;'>Sucessful registration, you can now login!</span><br>", $error_array)) echo "<span style='color: #000000;'>Sucessful registration, you can now login!</span><br>"; ?>
                <a href="#" id="signin" class="signin"> Already got an account. Sign in here</a>
            </form>
        </div>
    </div>
    </div>
    </div>
    <footer class="foot" > 
        <a href="#" class="foot_item" > Privacy </a>
        <a href="#" class="foot_item" > Careers </a>
        <a href="#" class="foot_item" > Developers </a>
        <a href="#" class="foot_item" > Local </a>
        <a href="#" class="foot_item" > About</a>
        <a href="#" class="foot_item" > Cookies </a>
        <a href="#" class="foot_item" > Support</a>
        <a href="#" class="foot_item" > Terms</a>
        <div id="copy" style="font-size:18px"> Stratos.Inc &copy; 2021 </div>

    </footer>
</body>
</html>   
