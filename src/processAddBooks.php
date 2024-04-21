<?php
include 'config.php'; // Include database configuration file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookId = $_POST['book_id'];
    $bookTitle = $_POST['book_title'];
    $description = $_POST['description'];
    $language = $_POST['language'];
    $authorFirstName = $_POST['a_first_name'];
    $authorLastName = $_POST['a_last_name'];
    // $publisher = $_POST['publisher'];
    $yearOfPublication = $_POST['yearOfPublication'];
    $numOfCopies = $_POST['numofcopy'];
    $coverPage = $_POST['cover_page'];

    // Check if author exists in the database
    $authorQuery = "SELECT author_id FROM author WHERE a_first_name = ? AND a_last_name = ?";
    $stmt = mysqli_prepare($conn, $authorQuery);
    mysqli_stmt_bind_param($stmt, "ss", $authorFirstName, $authorLastName);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    // If author does not exist, add the author to the authors table
    if (mysqli_stmt_num_rows($stmt) == 0) {
        $insertAuthorQuery = "INSERT INTO author (a_first_name, a_last_name) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $insertAuthorQuery);
        mysqli_stmt_bind_param($stmt, "ss", $authorFirstName, $authorLastName);
        mysqli_stmt_execute($stmt);
        $authorId = mysqli_insert_id($conn); // stores the last inserted author_id in this variable
    } else {
        // If author already exists, retrieve the author_id
        mysqli_stmt_bind_result($stmt, $authorId);
        mysqli_stmt_fetch($stmt);
        // echo mysqli_stmt_fetch($stmt);
    }

    // Insert book into the books table
    $insertBookQuery = "INSERT INTO book (book_id, book_name, description, language, author_id, year_of_publication, no_of_copies, image_url)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insertBookQuery);
    mysqli_stmt_bind_param($stmt, "isssiiis", $bookId, $bookTitle, $description, $language, $authorId, $yearOfPublication, $numOfCopies, $coverPage);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        // echo "Book '" . $bookTitle . "' added successfully";
        echo '<script>
        
                alert("Book name '.$bookTitle. ' added successfully");
                
                setTimeout(function() {
                    window.location.href = "./man ageBooks.php";
                }, 1000);
              </script>';
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo "Invalid request method";
}


// sabid
