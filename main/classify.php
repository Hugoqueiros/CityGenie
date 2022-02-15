<?php
include "../db.connection.php";
session_start();
$buy_id = $_POST['buy_id'];
$partner_id = $_POST['partner_id'];
$rating = $_POST["rating"];
$comments = $_POST["comments"];
$user_id = $_SESSION['user_id'];

$sql = "UPDATE `users_partners_points` SET `classification`='$rating',`comments`='$comments' WHERE users_partners_points='$buy_id'";
$result = mysqli_query($conn, $sql);

$sql_user = "UPDATE `users` SET `user_points`= user_points + 10 WHERE user_id='$user_id'";
$result_user = mysqli_query($conn, $sql_user);

$sql_partner = "SELECT (CAST(AVG(classification) AS DECIMAL(10,1))) AS classification_partner FROM users_partners_points WHERE partner_id='$partner_id'";
$result_partner = mysqli_query($conn, $sql_partner);

while ($value_query = mysqli_fetch_assoc($result_partner)) {
    $classification = $value_query["classification_partner"];
}

$sql_partner_classification = "UPDATE `partners` SET `classification`='$classification' WHERE partner_id='$partner_id'";
$result_partner_classification = mysqli_query($conn, $sql_partner_classification);

if ($result) {

    header("Refresh:0; url=http://citygenie.great-site.net/main/profile.php");
    
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
