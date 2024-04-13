<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $memberId = $_POST["member_id"];

    // Validate input (you can add more validation)
    if (empty($memberId)) {
        echo "Member ID is required";
        exit;
    }

    // Prepare and bind the statement
    $query = "DELETE FROM `member` WHERE `member_id` = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $memberId);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Member removed successfully";
        } else {
            echo "Member with ID $memberId not found";
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
