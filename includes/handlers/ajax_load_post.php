<?php
include ("../../config/config.php");
include ("../classes/User.php");
include ("../classes/Post.php");

$limit = 10; // Number of posts be loaded per call
$posts = new Post($con, $_REQUEST['userLoggedIn']);
$posts->loadPostFriends($_REQUEST, $limit);





?>