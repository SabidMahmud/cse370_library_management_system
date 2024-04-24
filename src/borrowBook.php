<?php
include ("./config.php");
// Retrieve data from the HTML form
$borrowed_date = $_POST['borrowed_date'];
$return_date = $_POST['return_date'];
$member_id = $_POST['member_id'];
$book_id = $_POST['book_id'];

// Ensure there are copies available before borrowing
$check_copies_sql = "SELECT no_of_copies FROM book WHERE book_id = '$book_id'";
$copy_result = $conn->query($check_copies_sql);
if ($copy_result->num_rows > 0) {
    $copy_data = $copy_result->fetch_assoc();
    if ($copy_data['no_of_copies'] > 0) {
        // Insert data into the borrows table
        $sql = "INSERT INTO borrows (borrowed_date, return_date, member_id) VALUES ('$borrowed_date', '$return_date', '$member_id')";
        if ($conn->query($sql) === TRUE) {
            // Get the last inserted borrow_id
            $borrowed_id = $conn->insert_id;

            // Insert data into the borrow_info table
            $sql = "INSERT INTO borrow_info (borrowed_id, book_id) VALUES ('$borrowed_id', '$book_id')";
            if ($conn->query($sql) === TRUE) {
                // Decrement no_of_copies in the book table
                $update_copies_sql = "UPDATE book SET no_of_copies = no_of_copies - 1 WHERE book_id = '$book_id'";
                if ($conn->query($update_copies_sql) === TRUE) {
                    echo "Book borrowed successfully.";
                } else {
                    echo "Error updating book copies: " . $conn->error;
                }
            } else {
                echo "Error inserting into borrow_info: " . $conn->error;
            }
        } else {
            echo "Error inserting into borrows: " . $conn->error;
        }
    } else {
        echo "No copies available for borrowing.";
    }
} else {
    echo "Error checking available copies: " . $conn->error;
}

// Close database connection
$conn->close();
?>