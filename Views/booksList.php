<?php

session_start();

if (isset($_SESSION['success'])) {
    $message = $_SESSION['success'];
    $class = $_SESSION['class'];
    unset($_SESSION['success']);
    unset($_SESSION['class']);
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/skeleton.css">
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/footer.css">
    <title>Books CRUD</title>

    <script src="https://kit.fontawesome.com/04702df722.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="container">
    <div class="row">
        <h1>Books list</h1>
    </div>
    <div class="row">
        <p class="new"><a href="index.php?op=new"><i class="fas fa-plus-circle"></i> Add a new book</a></p>
    </div>
    <div class="row">
        <h5 class="<?= $class?>"><?= $message?></h5>

            <?php

            if (!$books) {

                ?>

                <h5>No books founded</h5>

                <?php

            }else {
                ?>

                <table class="u-full-width">
                    <thead>
                    <tr>
                        <th>ISBN</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Editorial</th>
                        <th>Páginas</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    foreach ($books as $book) {
                        echo "<tr>";

                        echo "<td>$book->isbn</td>";
                        echo "<td>$book->title</td>";
                        echo "<td>$book->author</td>";
                        echo "<td>$book->publisher</td>";
                        echo "<td>$book->pages</td>";
                        echo "<td><a href='index.php?op=edit&id=$book->id'><i class='fas fa-edit'></i></a>
                            <a href='index.php?op=remove&id=$book->id'><i class='fas fa-trash'></i></a>
                            <a href='index.php?op=show&id=$book->id'><i class='fas fa-eye'></i></a></td>";

                        echo "</tr>";
                    }
                    ?>
                    </tbody>
                </table>

                <?php
            }

            ?>
    </div>
</div>

<?php

include ('footer.php');

?>

