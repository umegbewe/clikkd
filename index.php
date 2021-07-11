<?php
include("includes/header.php");
if(isset($_POST['post'])) {
    $post = new Post($con, $userLoggedIn);
    $post->submitPost($_POST['post_text'], 'none');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <div class="main_column column">
        <form class="post_form" action="index.php" method="POST">
            <textarea name="post_text" id="post_text" placeholder="What's on your mind?"></textarea>
            <input type="submit" name="post" id="post_button" value="Post">
        </form>
    <div>    

    <div class="posts_area">
        <img id="loading" src="assets/images/icons/loading.gif" style="margin-left: 240px;">

    </div>




    <script>
        var userLoggedIn = '<?php echo $userLoggedIn; ?>';
        $(document).ready(function() {
            
            $('#loading').show();
            
         //Original ajax request for loading first posts
        $.ajax({
            url: "includes/handlers/ajax_load_post.php",
            type: "POST",
            data: "page=1&userLoggedIn=" + userLoggedIn,
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
                    url: "includes/handlers/ajax_load_post.php",
                    type: "POST",
                    data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
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



