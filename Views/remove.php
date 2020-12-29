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
    <link rel="stylesheet" href="../css/remove.css">
    <link rel="stylesheet" href="../css/footer.css">
</head>
<body>

    <div class="container removeContent">
        <div class="row">
            <h3>Confirm remove: <?= $book->title?></h3>

            <form method="POST" class="u-full-width">
                <div class="removeContent">
                    <h5>Are you sure?</h5>
                </div>
                <div class="removeContent">
                    <input type="submit" class="button-danger" name="remove" value="Remove">
                    <input type="submit" name="cancel" value="Cancel">
                </div>
            </form>

        </div>
    </div>

<?php

include('Views/footer.php');
