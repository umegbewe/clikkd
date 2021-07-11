<?php
include("includes/header_profile.php");


if(isset($_GET['profile_username'])) {
    $username = $_GET['profile_username'];
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
    $user_array = mysqli_fetch_array($user_details_query);
    $num_friends = (substr_count($user_array['friend_array'], ",")) -1;
}

if(isset($_POST['remove_friend'])) {
    $user = new User($con, $userLoggedIn);
    $user->removeFriend($username);
}

if(isset($_POST['add_friend'])) {
  $user = new User($con, $userLoggedIn);
  $user->sendRequest($username);
}

if(isset($_POST['confirm_request'])) {
    header("Location: requests.php");
}

  ?>
<div class="user_details columns">
    
    <div class="user_details_left_right">
    <ul>
        <div class="nav_profile">
        <a href="index.php">
        <i class="fas fa-home fa-2x"><span class="fas_details">Home</span></i>
        </a>
        </div>
        <div class="nav_profile">
        <a href="#">
        <i class="fas fa-bell fa-2x"><span class="fas_details">Notifications</span></i>
        </a>
        </div>
        <div class="nav_profile">
        <a href="messages.php">
        <i class="fas fa-envelope fa-2x"><span class="fas_details">Messages</span></i>
        </a>
        </div>
        <div class="nav_profile">
        <a href="requests.php">
        <i class="fas fa-user-friends fa-2x"><span class="fas_details">Requests</span></i>
        </a>
        </div>
        <div class="nav_profile">
        <a href="#">
        <i class="fas fa-cog fa-2x"><span class="fas_details">Settings</span></i>
        </a>
        </div>
    </ul> 
    </div>
</div>

    <div class="profile_left">
      <img src="<?php echo $user_array['profile_pic']; ?>">

      <div class="flnameandusername">
      <span class="username_profile a_username_profile"><?php echo $username; ?></span>
      <br>
      <br>
      <a href="" class="flname a_post" refresh><?php
      $logged_in_user_obj = new User($con, $username); 
      echo $logged_in_user_obj->getFirstAndLastName(); ?></a>
    </div>
        <div class="profile_details">
        <div class="individual_profile_details"><p class= "profile_details_style"><?php echo $user_array['num_posts'];?> Posts</p></div>
        <div class="individual_profile_details"><p class= "profile_details_style"><?php echo $user_array['num_likes']; ?> Likes</p></div>
        <div class="individual_profile_details"><p class= "profile_details_style"><?php echo $num_friends ?> Friends</p></div>
        </div>
      <form action="<?php echo $username; ?>" method="POST">
        <?php
        $profile_user_obj = new User($con, $username);
        if($profile_user_obj->isClosed()) {
            header("Location: user_closed.php");
        } 

        $logged_in_user_obj = new User($con, $userLoggedIn);

        if($userLoggedIn != $username) {
            if($userLoggedIn != $username) {
              echo '<div class="profile_info_bottom">';
                echo $logged_in_user_obj->getMutualFriends($username) . " Mutual Friends";
              echo '</div>';
            }
            
            if($logged_in_user_obj->isFriend($username)) {
                echo '<input type="submit" name="remove_friend" class="danger" value="Unfriend" style = "float: left;
                margin-left: -87px;"><br>'; 
            }
            else if ($logged_in_user_obj ->didRecieveRequest($username)) {
                echo '<input type="submit" name="confirm_request" class="warning" value="Confirm Request" style = "float: left;
                margin-left: -87px;"><br>';
            }
            else if ($logged_in_user_obj ->didSendRequest($username)) {
              echo '<input type="submit" name="" class="default" value="Request Sent" style = "float:left;
              margin-left: -87px;"><br>';
            }
            else
            echo '<input type="submit" name="add_friend" class="success" value="Add Friend" style= "float: left;
            margin-left: -87px;"><br>';
        }
        ?>
    </form>
    <input type="button" class="danger btn btn-info" data-toggle="modal" data-target="#post_form" value="Post Something" style="padding: 4px 17px 7px 18px;margin-left: 5px;border-radius: 7px; height: 40px;
    width: 62%;">
    </div>
    </div>

    <div class="main_column_profile column">
        <div class="posts_area"></div>
        <img id="loading" src="assets/images/icons/loading.gif" style="margin-left: 240px;">

    </div>

<!-- Modal -->
<div id="post_form" class="modal fade" tabindex="-1" role="dialog" aria-labbelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Post Something!</h4>
      </div>

      <div class="modal-body">
        <p>Post to &nbsp; <?php echo $username; ?> Timeline</p>

        <form class="profile_post" action="" method="POST">
            <div class="form-group">
              <textarea class="form-control" name="post_body"></textarea>
              <input type="hidden" name="user_from" value="<?php echo $userLoggedIn; ?>">
              <input type="hidden" name="user_to" value="<?php echo $username; ?>">
            </div>
          </form>
        </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" name="post_button" id="submit_profile_post">Post</button>
      </div>
    </div>

  </div>
</div>

<script>
        var userLoggedIn = '<?php echo $userLoggedIn; ?>';
        var profileUsername = '<?php echo $username; ?>';
        $(document).ready(function() {
            
            $('#loading').show();
            
         //Original ajax request for loading first posts
        $.ajax({
            url: "includes/handlers/ajax_load_profile_posts.php",
            type: "POST",
            data: "page=1&userLoggedIn=" + userLoggedIn + "&profileUsername=" + profileUsername,
            cache:false,
            success: function(data) {
                $('#loading').hide();
                $('.posts_area').html(data);
            }

        });
        
        $(window).scroll(function() {
            var height = $('.posts_area').height(); //Div containing posts
            var scroll_top = $(this).scrollTop();
            var page = $('.posts_area').find('.nextPage').val();
            var noMorePosts = $('.posts_area').find('.noMorePosts').val();

            if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
                $('#loading').show();

                var ajaxReq = $.ajax({
                    url: "includes/handlers/ajax_load_profile_posts.php",
                    type: "POST",
                    data: "page=" + page + "&userLoggedIn=" + userLoggedIn + "&profileUsername=" + profileUsername,
                    cache: false,
                    success: function(response) {
                        $('.posts_area').find('.nextPage').remove(); //Removes current next page
                        $('.posts_area').find('.noMorePosts').remove(); //Removes current next page

                        $('#loading').hide();
                        $('.posts_area').append(response);
                
                    }
                });
           
            } //End if

            return false;
            
        
        
        }); //End (window).scroll(function())
        
    });


    </script>

    </div>
</body>
</html>   



