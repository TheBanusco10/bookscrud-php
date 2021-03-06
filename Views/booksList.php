<?php

session_start();

if (isset($_SESSION['success'])) {
    $message = $_SESSION['success'];
    unset($_SESSION['success']);
}

$columns = ['id', 'isbn', 'title', 'author', 'publisher', 'pages'];

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
    <div class="row" id="order">
        <h4>Order type</h4>
        <form method="GET">
             <?php

             echo "<select name='columnOrder'>";
             foreach ($columns as $column) {

                 echo "<option value='$column'>$column</option>";

             }
             echo "</select>";
             ?>

            <select name="orderOption">
                <option value="ASC">ASC</option>
                <option value="DESC">DESC</option>
            </select>

            <input type="submit" name="order" value="Order">
        </form>
    </div>
    <div class="row">
        <h5 class="success"><?= $message?></h5>

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
        <section class="page">
            <p>

                <?php
                if ($page > 1) {

                    echo "<a href='?columnOrder=$columnOrder&orderOption=$orderOption&page=1'>First</a>";
                    echo " <a href='?columnOrder=$columnOrder&orderOption=$orderOption&page=$previous_page'>Previous</a>";

                }

                else
                    echo "";
                ?>

                | Page <?= $page ?> of <?= $total_number_books?> |

                <?php

                if ($page < $total_number_books) {
                    echo "<a href='?columnOrder=$columnOrder&orderOption=$orderOption&page=$next_page'>Next</a>";
                    echo " <a href='?columnOrder=$columnOrder&orderOption=$orderOption&page=$total_number_books'>Last</a>";
                }else {
                    echo "";
                }

                ?>

            </p>
        </section>
    </div>

    <div class="row">
        <form method="GET">
            <input type="text" name="records" placeholder="Number of records to print">
            <input type="hidden" name="page" value="<?= $page?>">
            <input type="hidden" name="columnOrder" value="<?= $columnOrder?>">
            <input type="hidden" name="orderOption" value="<?= $orderOption?>">
            <input type="submit" name="generatePDF" value="Generate PDF">
        </form>
    </div>
</div>

<?php

include('Views/footer.php');

?>

