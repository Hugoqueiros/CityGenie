<?php
include "db.connection.php";
    session_start();
    $prize_id = $_POST['prize_id'];
    $user_id = $_SESSION["user_id"];
    $query_points = "SELECT * FROM prizes WHERE prize_id = '$prize_id'";
	$result_points = mysqli_query($conn, $query_points);
    while ($value_query = mysqli_fetch_assoc($result_points)) {
        $prize_points = $value_query["prize_points"];
    }
    $query= "UPDATE users SET user_points=user_points - '$prize_points' WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $query);
    $query_prize= "UPDATE prizes SET prize_stock= prize_stock - '1' WHERE prize_id = '$prize_id'";
    $result = mysqli_query($conn, $query_prize);
    $updated = true;
    
    echo $updated;

    ?>
