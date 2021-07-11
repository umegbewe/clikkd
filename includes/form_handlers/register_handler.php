<?php
//declaring variables to prevent errors
 $fname = ""; //First name
 $lname = ""; //Last name
 $em = ""; //Email
 $em2 = ""; //Email 2
 $password = ""; //Password
 $password = ""; //Password2
 $date = ""; //Sign Up Date
 $error_array = array(); //Holds error messages

 if (isset($_POST['register_button'])){
     //Registration Form Values

     //First name
     $fname = strip_tags($_POST['reg_fname']); //remove Html Tags
     $fname = str_replace(' ', '', $fname); //remove whitespaces
     $fname = ucfirst(strtolower($fname)); //Uppercase First
     $_SESSION['reg_fname'] =$fname; //Stores first name into session variable

    //Last name
     $lname = strip_tags($_POST['reg_lname']); //remove Html Tags
     $lname = str_replace(' ', '', $lname); //remove whitespaces
     $lname = ucfirst(strtolower($lname)); //Uppercase First
     $_SESSION['reg_lname'] =$lname; //Stores last name into session variable

    //Email
     $em = strip_tags($_POST['reg_email']); //remove Html Tags
     $em = str_replace(' ', '', $em); //remove whitespaces
     $_SESSION['reg_email'] =$em; //Stores email into session variable

     //Email2
     $em2 = strip_tags($_POST['reg_email2']); //remove Html Tags
     $em2 = str_replace(' ', '', $em2); //remove whitespaces
     $_SESSION['reg_email2'] =$em2; //Stores email2 into session variable

     //Password
     $password = strip_tags($_POST['reg_password']); //remove Html Tags
    //Password2
     $password2 = strip_tags($_POST['reg_password2']); //remove Html Tags
    //Date
    $date = date("Y-m-d"); //Gets Current Date

    if($em == $em2) {
        //Check if email is in valid format
        if(filter_var($em, FILTER_VALIDATE_EMAIL)) {

            $em = filter_var($em, FILTER_VALIDATE_EMAIL);

            //Check if email already exists
            $e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");

            //Count the number of rows returned
            $num_rows = mysqli_num_rows($e_check);

            if($num_rows > 0) {
                array_push($error_array, "Email already exists<br>");
            }
        }
        else {
            array_push($error_array, "Invalid email format<br>");
        }
    }
    else {
        array_push($error_array, "Emails don't match<br>"); //thinking of adding a line break <br>
    }
    if(strlen($fname) > 25 || strlen($fname) <2) {
        array_push($error_array, "Please use a real first name<br>");
    } 

    if(strlen($lname) > 25 || strlen($lname) <2) {
        array_push($error_array, "Please use a real last name<br>");
    }

    if($password != $password2) {
        array_push($error_array, "Your passwords do not match<br>");
    }
    else {
        if(preg_match('/[^A-Za-z0-9]/', $password)) {
            array_push($error_array, "Your passwords can only be in english letters and numbers<br>");
        }
    }

    if(strlen($password > 30 || strlen($password) < 5)) { 
        array_push($error_array, "Password too long or short<br>");
    }

    if(empty($error_array)) {
        $password = md5($password); //encrypts passwords before sending to database

    

        //Generate username with first name and last name
        $username = strtolower($fname . "_" . $lname);
        $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
    
        $i = 0;
        // add number if username exists
        while(mysqli_num_rows($check_username_query) != 0) {
            $i++; //add 1 to i
        $username = $username . "_" . $i;
        $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
        
        }

        //profile picture assignment
        $rand = rand(1, 2); //random number between 1, 2 and 3

        if($rand == 1)
            $profile_pic = "assets/images/profile_pics/defaults/avatar.png";
        else if($rand == 2)
            $profile_pic = "assets/images/profile_pics/defaults/avatar1.png";
        $query = mysqli_query($con, "INSERT INTO users VALUES ('', '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')");
        array_push($error_array, "<span style='color: #000000;'>Successful registration, you can now login!</span><br>");

        //clear session variables
        $_SESSION['reg_fname'] = "";
        $_SESSION['reg_lname'] = "";
        $_SESSION['reg_email'] = "";
        $_SESSION['reg_email2'] = "";

    }

} 
?>