<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "config.php";
    $delete_id = mysqli_real_escape_string($conn, $_GET['delete_id']);
    if (isset($delete_id)) {
        $sql = mysqli_query($conn, "DELETE FROM users WHERE unique_id = {$delete_id}");
        if ($sql) {
            session_unset();
            session_destroy();
            header("location: ../login.php");
        } else {
            echo "Something went wrong. Please try again!";
        }
    } else {
        header("location: ../users.php");
    }
} else {
    header("location: ../login.php");
}
?>