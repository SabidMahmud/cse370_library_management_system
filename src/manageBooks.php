<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Books</title>

    <link rel="stylesheet" href="./styles/add_books.css">
    <link rel="stylesheet" href="./styles/main.css">

</head>

<body>
    <?php include 'adminNav.php'; ?>

    <main>
        <div class="main">
            <h2>Add A book</h2>
            <form action="./processAddBooks.php" method="post">
                <input type="text" placeholder="Book ID" name='book_id'>
                <input type="text" placeholder="Book's title" name="book_title">
                <input type="text" placeholder="Author's First Name" name="a_first_name">
                <input type="text" placeholder="Author's Last Name" name='a_last_name'>
                <input type="text" placeholder="Publisher's Name" name='publisher'>
                <input type="year" placeholder="Year of Publication" name='yearOfPublication'>
                <input type="text" placeholder="Language" name="language">
                <label for="numofcopy">Number of copies:</label>
                <input type="number" id='numofcopy' placeholder="Number of copy" name='numofcopy' value="1">
                <input type="text" name="cover_page" id="book_cover" placeholder='Link of the cover page'>
                <label id="description_label" for="description">Book description:</label>
                <textarea name="description" id="description" rows="4" cols="70"
                    placeholder="Describe this book"></textarea>
                <button type="submit">Add Book</button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 370 Project. Group 9.</p>
    </footer>

</body>

</html>


<!-- sabid -->