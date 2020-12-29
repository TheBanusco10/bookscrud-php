<?php

session_start();

if (isset($_SESSION['errorPage'])) {
    $message = $_SESSION['errorPage'];
    unset($_SESSION['errorPage']);
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/skeleton.css">
    <link rel="stylesheet" href="css/errorPage.css">
    <link rel="stylesheet" href="css/footer.css">
    <title>Error Page</title>

    <script src="https://kit.fontawesome.com/04702df722.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="container">

    <section id="error">
        <div class="row">

            <img src="imgs/error.svg" alt="error">

            <h4>Oops! Something went wrong!</h4>
            <?php

            if ($message)
                echo "<p>$message</p>"
            ?>

            <a href="index.php" class="button">Back to index</a>

        </div>
    </section>

</div>

<?php

include('Views/footer.php');

?>

