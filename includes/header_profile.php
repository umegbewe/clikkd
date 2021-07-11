<?php
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");
include("includes/classes/Message.php");

if(isset($_SESSION['username'])) {
    $userLoggedIn = $_SESSION['username'];
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
    $user = mysqli_fetch_array($user_details_query); 
}
    else {
        header("Location: register.php");
    }
?>

<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Clikkd.com </title>

        <!-- Javascript -->
        <script src="assets/js/jquery-3.5.1.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
	    <script src="assets/js/bootbox.min.js"></script>
        <script src="assets/js/main.js"></script>
        <script src="assets/js/jquery_Jcrop.js"></script>
        <script src="assets/js/jcrop_bits.js"></script>

        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="assets/fontawesome/css/all.css">
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="assets/css/jquery_Jcrop.css">

</head>
<body>
    <div class="top_bar">
        <div class="logo">
            <a href="index.php">Clikkd.com</a>
        </div>
        <nav>
            <a href="<?php echo $userLoggedIn; ?>">
             <img class='vnav_img' src= '<?php echo $user['profile_pic']; ?>'>
                <?php echo $user['first_name']; ?>
            </a>
            <a href="includes/handlers/logout.php">
            <i class="fa fa-sign-out-alt fa-lg"></i>
            </a>
        </nav>
        
    </div>

    <div class="wrapper2">


</body>
</html>
