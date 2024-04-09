<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>remove_books</title>

    <link rel="stylesheet" href="./styles/main.css">
</head>
<body>

<div class="container">
        <h2>Remove Books</h2>
        <?php if ($result->num_rows > 0): ?>
            <ul>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <li>
                        <?php echo $row['title']; ?> (ISBN: <?php echo $row['ISBN']; ?>)
                        <a href="remove_books.php?book_id=<?php echo $row['book_id']; ?>" onclick="return confirm('Are you sure you want to delete this book?')">Remove</a>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>No books found.</p>
        <?php endif; ?>
    </div>
    
</body>
</html>