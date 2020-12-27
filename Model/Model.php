<?php

require_once('DB.php');

class Model {

    private $books = [];
    private $db;

    /**
     * @return array
     */
    public function getBooks($offset, $maxRow, $order = 'title', $type = 'ASC')
    {
        $pdo = DB::connect();

        $order = htmlentities($order);
        $type = htmlentities($type);

        $stmt = $pdo->query("Select * from books ORDER BY $order $type LIMIT $offset, $maxRow");
        $stmt->execute();

        if ($stmt->rowCount() != 0) {

            return $stmt->fetchAll(PDO::FETCH_OBJ);

        }else {
            return null;
        }



    }


    public function getBookByID($id) {

        $pdo = DB::connect();

        $stmt = $pdo->prepare("Select * from books WHERE id = :id");

        $stmt->execute(array(
           ':id'=>htmlentities($id)
        ));

        return $stmt->fetch(PDO::FETCH_OBJ);


    }

    public function editBook(Book $book) {

        $pdo = DB::connect();

        $stmt = $pdo->prepare("UPDATE books SET isbn = :isbn, title = :title, author = :author, publisher = :publisher,
                                    pages = :pages WHERE id = :id LIMIT 1");

        $stmt->execute(array(
            ':isbn'=>htmlspecialchars($book->getIsbn()),
            ':title'=>htmlspecialchars($book->getTitle()),
            ':author'=>htmlspecialchars($book->getAuthor()),
            ':publisher'=>htmlspecialchars($book->getPublisher()),
            ':pages'=>htmlspecialchars($book->getPages()),
            ':id'=>htmlspecialchars($book->getId())
        ));

    }

    public function removeBook($id) {

        $pdo = DB::connect();

        $stmt = $pdo->prepare("DELETE FROM books WHERE id = :id LIMIT 1");

        $stmt->execute(array(
            ':id'=>htmlspecialchars($id)
        ));

    }

    public function insertBook(Book $book) {

        $pdo = DB::connect();

        $stmt = $pdo->prepare("INSERT INTO books VALUES (NULL, :isbn, :title, :author, :publisher, :pages)");

        $stmt->execute(array(
            ':isbn'=>htmlspecialchars($book->getIsbn()),
            ':title'=>htmlspecialchars($book->getTitle()),
            ':author'=>htmlspecialchars($book->getAuthor()),
            ':publisher'=>htmlspecialchars($book->getPublisher()),
            ':pages'=>htmlspecialchars($book->getPages())
        ));

    }



}
