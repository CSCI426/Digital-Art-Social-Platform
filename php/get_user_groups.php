<?php
session_start();
include_once "config.php";

if (isset($_SESSION['unique_id'])) {
    $userId = $_SESSION['unique_id'];

  
    $stmt = $conn->prepare("SELECT group_name FROM groups WHERE created_by = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    $groups = array();
    while ($row = $result->fetch_assoc()) {
        $groups[] = $row['group_name'];
    }

    echo json_encode($groups);
} else {
    echo "Invalid request!";
}
?>
