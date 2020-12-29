<?php

if (isset($_SESSION['error'])) {
    $errorMessage = $_SESSION['error'];
    unset($_SESSION['error']);
}

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
    <link rel="stylesheet" href="../css/footer.css">
</head>
<body>

<div class="container">
    <div class="row">
        <h3>New book</h3>

        <h5 class="error"><?= $errorMessage?></h5>

        <form method="POST">
            <label for="isbn">ISBN</label>
            <input type="text" name="isbn">

            <label for="isbn">Title</label>
            <input type="text" name="title">

            <label for="isbn">Author</label>
            <input type="text" name="author">

            <label for="isbn">Publisher</label>
            <input type="text" name="publisher">

            <label for="isbn">Pages</label>
            <input type="text" name="pages">
            <hr>
            <input type="submit" class="button-primary" name="add" value="Add">
            <input type="submit" name="cancel" value="Cancel">
        </form>

    </div>
</div>

<?php

include('Views/footer.php');

?>
