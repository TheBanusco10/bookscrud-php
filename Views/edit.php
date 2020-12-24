<?php


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Books CRUD</title>

    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/skeleton.css">
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>

    <div class="container">
        <div class="row">
            <h3>Editing <?= $book->title?></h3>

            <form method="POST">
                <label for="isbn">ISBN</label>
                <input type="text" name="isbn" value="<?= $book->isbn?>">

                <label for="isbn">Title</label>
                <input type="text" name="title" value="<?= $book->title?>">

                <label for="isbn">Author</label>
                <input type="text" name="author" value="<?= $book->author?>">

                <label for="isbn">Publisher</label>
                <input type="text" name="publisher" value="<?= $book->publisher?>">

                <label for="isbn">Pages</label>
                <input type="text" name="pages" value="<?= $book->pages?>">
                <hr>
                <input type="submit" class="button-primary" name="edit" value="Edit">
                <input type="submit" name="cancel" value="Cancel">
            </form>

        </div>
    </div>

</body>
</html>
