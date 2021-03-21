<?php
require 'db_connection.php';
// function for getting data from database
function get_all_data($conn){
    $get_data = mysqli_query($conn,"SELECT * FROM `users_data`");
    if(mysqli_num_rows($get_data) > 0){
        echo '<table>
              <tr>
                <th>Id</th>
                <th>First Name</th>
                <th>Second Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Registration Date</th>
                <th>Action</th> 
              </tr>';
        while($row = mysqli_fetch_assoc($get_data)){

            echo '<tr>
            <td>'.$row['id'].'</td>
            <td>'.$row['First_name'].'</td>
            <td>'.$row['Second_name'].'</td>
            <td>'.$row['username'].'</td>
            <td>'.$row['user_email'].'</td>
            <td>'.$row['Registration_date'].'</td>
            <td>
            <a href="update.php?id='.$row['id'].'">Edit</a> |
            <a href="delete.php?id='.$row['id'].'">Delete</a>
            </td>
            </tr>';

        }
        echo '</table>';
    }else{
        echo "<h3>No records found. Please insert some records</h3>";
    }
}
?>
<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Application</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<div class="container">

    <!-- INSERT DATA -->
    <div class="form">
        <h2>Insert Data</h2>
        <form action="insert.php" method="post">
            <strong>First Name</strong><br>
            <input type="text" name="firstname" placeholder="Enter your first name" required><br>
            <strong>Second Name</strong><br>
            <input type="text" name="secondname" placeholder="Enter your second name" required><br>
            <strong>Username</strong><br>
            <input type="text" name="username" placeholder="Enter your username" required><br>
            <strong>Email</strong><br>
            <input type="email" name="email" placeholder="Enter your email" required><br>
            <input type="submit" value="Insert">
        </form>
    </div>
    <!-- END OF INSERT DATA SECTION -->
    <hr>
    <!-- SHOW DATA -->
    <h2>Show Data</h2>
    <?php
    // calling get_all_data function
    $conn = mysqli_connect("localhost", "root", "", "crud_app");
    get_all_data($conn);
    ?>
    <!-- END OF SHOW DATA SECTION -->
</div>
</body>

</html>