<?php
include "db.connection.php";
    session_start();
    $monument_id = $_POST['monument_id'];
    $monument_points = $_POST['monument_points'];
    $user_id = $_SESSION["user_id"];
    $query= "INSERT INTO user_monuments_points(user_id, monument_id) VALUES ('$user_id', '$monument_id') ";
    $result = mysqli_query($conn, $query);
    $query_reedem= "UPDATE users SET user_points= user_points + '$monument_points' WHERE user_id='$user_id' ";
    $result_reedem = mysqli_query($conn, $query_reedem);
    $updated = true;
    
    echo $updated;

    ?>