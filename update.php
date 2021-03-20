<?php
require 'db_connection.php';
if(isset($_GET['id']) && is_numeric($_GET['id'])){

    $userid = $_GET['id'];
    $conn = mysqli_connect("localhost", "root", "", "crud_app");
    $get_user = mysqli_query($conn,"SELECT * FROM `users_data` WHERE id='$userid'");

    if(mysqli_num_rows($get_user) === 1){

        $row = mysqli_fetch_assoc($get_user);

        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Update data</title>
            <link rel="stylesheet" href="style.css">
        </head>

        <body>
        <div class="container">

            <!-- UPDATE DATA -->
            <div class="form">
                <h2>Update Data</h2>
                <form action="" method="post">
                    <strong>First Name</strong><br>
                    <input type="text" autocomplete="off" name="firstname" placeholder="Enter your first name" value="<?php echo $row['First_name'];?>" required><br>
                    <strong>Second Name</strong><br>
                    <input type="text" autocomplete="off" name="secondname" placeholder="Enter your second name" value="<?php echo $row['Second_name'];?>" required><br>
                    <strong>Username</strong><br>
                    <input type="text" autocomplete="off" name="username" placeholder="Enter your full name" value="<?php echo $row['username'];?>" required><br>
                    <strong>Email</strong><br>
                    <input type="email" autocomplete="off" name="email" placeholder="Enter your email" value="<?php echo $row['user_email'];?>" required><br>
                    <input type="submit" value="Update">
                </form>
            </div>
            <!-- END OF UPDATE DATA SECTION -->
        </div>
        </body>
        </html>
        <?php

    }else{
        // set header response code
        http_response_code(404);
        echo "<h1>404 Page Not Found!</h1>";
    }

}else{
    // set header response code
    http_response_code(404);
    echo "<h1>404 Page Not Found!</h1>";
}


/* ---------------------------------------------------------------------------
------------------------------------------------------------------------------ */


// UPDATING DATA

if(isset($_POST['username']) && isset($_POST['email'])){

    // check username and email empty or not
    if(!empty($_POST['username']) && !empty($_POST['email'])){

        // Escape special characters.
        $conn = mysqli_connect("localhost", "root", "", "crud_app");
        $firstname = mysqli_real_escape_string($conn, htmlspecialchars($_POST['firstname']));
        $secondname = mysqli_real_escape_string($conn, htmlspecialchars($_POST['secondname']));
        $username = mysqli_real_escape_string($conn, htmlspecialchars($_POST['username']));
        $user_email = mysqli_real_escape_string($conn, htmlspecialchars($_POST['email']));

        //CHECK EMAIL IS VALID OR NOT
        if (filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
            $user_id = $_GET['id'];
            // CHECK IF EMAIL IS ALREADY INSERTED OR NOT
            $check_email = mysqli_query($conn, "SELECT `user_email` FROM `users_data` WHERE user_email = '$user_email' AND id != '$user_id'");

            if(mysqli_num_rows($check_email) > 0){

                echo "<h3>This Email Address is already registered. Please Try another.</h3>";
            }else{

                // UPDATE USER DATA
                $update_query = mysqli_query($conn,"UPDATE `users_data` SET First_name='$firstname',Second_name='$secondname', username='$username',user_email='$user_email' WHERE id=$user_id");

                //CHECK DATA UPDATED OR NOT
                if($update_query){
                    echo "<script>
                    alert('Data Updated');
                    window.location.href = 'index.php';
                    </script>";
                    exit;
                }else{
                    echo "<h3>Opps something wrong!</h3>";
                }
            }
        }else{
            echo "Invalid email address. Please enter a valid email address";
        }

    }else{
        echo "<h4>Please fill all fields</h4>";
    }
}

// END OF UPDATING DATA

?>
