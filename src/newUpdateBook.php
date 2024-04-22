<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Book</title>
    <link rel="stylesheet" href="./styles/main.css">
    <link rel="stylesheet" href="./styles/add_books.css">

    <script>
        function addAuthorField() {
            const authorFields = document.getElementById('authorFields');
            const authorFieldTemplate = `
                <div class="author-field">
                    <label>Author's First Name:</label>
                    <input type="text" name="a_first_name[]">
                    <label>Author's Last Name:</label>
                    <input type="text" name="a_last_name[]">
                </div>
            `;
            authorFields.insertAdjacentHTML('beforeend', authorFieldTemplate);
        }
    </script>

</head>

<body>
    <?php include 'adminNav.php'; ?>
    <main>
        <div class="main">
            <h2>Update Book Information</h2>
            <?php
            include 'config.php';

            if (isset($_GET['book_id'])) {
                $bookId = $_GET['book_id'];

                // Fetch existing book details based on book ID
                $selectBookQuery = "SELECT b.book_id, b.book_name, b.description, b.language, b.image_url, b.no_of_copies, b.year_of_publication, GROUP_CONCAT(a.a_first_name, ' ', a.a_last_name SEPARATOR ', ') AS authors
                        FROM book b
                        LEFT JOIN writes w ON b.book_id = w.book_id
                        LEFT JOIN author a ON w.author_id = a.author_id
                        WHERE b.book_id = ?
                        GROUP BY b.book_id";
                $stmt = mysqli_prepare($conn, $selectBookQuery);
                mysqli_stmt_bind_param($stmt, "i", $bookId);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $bookId, $bookTitle, $description, $language, $imageUrl, $numOfCopies, $yearOfPublication, $authors);
                mysqli_stmt_fetch($stmt);

                ?>
                <form action="./newProcessUpdateBook.php" method="post">
                    <input type="hidden" name="book_id" value="<?php echo $bookId; ?>">
                    <label for="bookId">Book ID:</label>
                    <input id="bookId" type="text" placeholder="Book ID" name="book_id" value="<?php echo $bookId; ?>"
                        readonly>
                    <label for="bookTitle">Book Title:</label>
                    <input id="bookTitle" type="text" placeholder="Book's title" name="book_title"
                        value="<?php echo $bookTitle; ?>">
                    <label for="authors">Authors:</label>
                    <input id="authors" type="text" placeholder="Authors" name="authors" value="<?php echo $authors; ?>"
                        readonly>

                    <div id="authorFields">
                        <div class="author-field"></div>
                    </div>
                    <button type="button" id="addAuthor" onclick="addAuthorField()">Add Another Author</button><br>

                    
                    <label for="yop">Year of Publication:</label>
                    <input id="yop" type="year" placeholder="Year of Publication" name="yearOfPublication"
                        value="<?php echo $yearOfPublication; ?>">
                    <label for="lang">Language:</label>
                    <input id="lang" type="text" placeholder="Language" name="language" value="<?php echo $language; ?>">
                    <label for="numofcopy">Number of copies:</label>
                    <input type="number" id='numofcopy' placeholder="Number of copy" name='numofcopy'
                        value="<?php echo $numOfCopies; ?>"> <BR>
                    <label for="linkofcover">Book Cover Page Location:</label>
                    <input id="linkofcover" type="text" name="cover_page" id="book_cover"
                        placeholder='Link of the cover page' value="<?php echo $imageUrl; ?>">
                    <label id="description_label" for="description">Book description:</label>
                    <textarea name="description" style="width: 100%;" id="description" rows="4" cols="15"
                        placeholder="Describe this book"><?php echo $description; ?></textarea>
                    <button type="submit" style="margin: 0 auto;">Update Book Information</button>
                </form>
                <?php
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
            }
            ?>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 370 Project. Group 9.</p>
    </footer>
</body>

</html>