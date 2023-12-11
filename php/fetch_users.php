<?php
include_once "config.php";


$sql = "SELECT unique_id, fname, lname FROM users";
$result = mysqli_query($conn, $sql);

if ($result) {
    $users = array();


    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }

    echo json_encode($users);
} else {
    echo "Failed to fetch users";
}

mysqli_close($conn);
?>
