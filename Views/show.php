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
    <link rel="stylesheet" href="../css/footer.css">
</head>
<body>

<div class="container">
    <div class="row">
        <h3>Showing book</h3>

        <section id="info">
            <p><b>ISBN:</b> <?= $book->isbn?></p>
            <p><b>Title:</b> <?= $book->title?></p>
            <p><b>Author:</b> <?= $book->author?></p>
            <p><b>Publisher:</b> <?= $book->publisher?></p>
            <p><b>Pages:</b> <?= $book->pages?></p>
        </section>

        <form method="POST">
            <input class="button-primary" type="submit" name="cancel" value="Back">
        </form>

    </div>
</div>

<?php

include('footer.php');

?>
