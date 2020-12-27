<?php

require_once ('Model/Book.php');

class Controller
{
    private $model;
    private $maxRows = 10;

    /**
     * Controller constructor.
     * @param $model
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    public function invoke() {

        $operation = $_GET['op'] ?? null;
        $id = $_GET['id'] ?? null;
        $page = $_GET['page'] ?? 1;

        if (!$operation && !$id) {

            $offset = ($page-1) * $this->maxRows;
            $previous_page = $page - 1;
            $next_page = $page + 1;

            $pdo = DB::connect();

            $stmt = $pdo->query("SELECT COUNT(*) As total_records FROM books");

            $total_number_books = ceil($stmt->fetch(5)->total_records / $this->maxRows);

            $columnOrder = $_GET['columnOrder'] ?? 'id';
            $orderOption = $_GET['orderOption'] ?? 'ASC';

            if (isset($_GET['order'])) {

                $columnOrder = $_GET['columnOrder'];
                $orderOption = $_GET['orderOption'];
            }

            //  TODO crear php para mostrar errores
            if ($page <= 0)
                die ('Page must be 1 or greater');

            $books = $this->model->getBooks($offset, $this->maxRows, $columnOrder, $orderOption);

            include ('Views/booksList.php');

        }else if ($id && !$operation) {
            die('Operation is missing');

        }else if (!$id && $operation) {

            if ($operation != 'new' && $operation != 'pdf')
                die('Id is missing');
        }

        switch ($operation) {
            case 'edit':
                $this->editBook($id);
                break;

            case 'remove':
                $this->removeBook($id);
                break;

            case 'show':
                $this->showBook($id);
                break;

            case 'new':
                $this->newBook();
                break;

            case 'pdf':
                $this->generatePDF();
                break;
        }

    }

    public function editBook($id) {

        session_start();

        $book = $this->model->getBookByID($id);

        if (isset($_POST['edit'])) {
            $bookEdited = new Book($id, $_POST['isbn'], $_POST['title'], $_POST['author'],
                $_POST['publisher'], $_POST['pages']);

            $this->model->editBook($bookEdited);
            $_SESSION['success'] = 'Book edited';
            $_SESSION['class'] = 'success';
            $this->redirect('index.php');
            return;

        }else if (isset($_POST['cancel'])) {

            $this->redirect('index.php');
            return;
        }

        include $_SERVER['DOCUMENT_ROOT'] . '/Views/edit.php';

    }

    public function removeBook($id) {
        session_start();

        $book = $this->model->getBookByID($id);

        if (isset($_POST['remove'])) {
            $this->model->removeBook($id);
            $_SESSION['success'] = 'Book removed';
            $_SESSION['class'] = 'success';
            $this->redirect('index.php');
            return;

        }else if (isset($_POST['cancel'])) {

            $this->redirect('index.php');
            return;
        }

        include $_SERVER['DOCUMENT_ROOT'] . '/Views/remove.php';
    }

    public function showBook($id) {

        $book = $this->model->getBookByID($id);

        if (isset($_POST['cancel']))
            $this->redirect('index.php');

        include ('Views/show.php');

    }

    public function newBook() {

        session_start();

        if (isset($_POST['add'])) {
            $newBook = new Book(1, $_POST['isbn'], $_POST['title'], $_POST['author'],
                $_POST['publisher'], $_POST['pages']);

            $this->model->insertBook($newBook);
            $_SESSION['success'] = 'Book added';
            $_SESSION['class'] = 'success';
            $this->redirect('index.php');
            return;

        }else if (isset($_POST['cancel'])) {

            $this->redirect('index.php');
            return;
        }

        include $_SERVER['DOCUMENT_ROOT'] . '/Views/new.php';

    }

    //  TODO Añadir al PDF la página del usuario y el orden
    public function generatePDF() {
        $columnOrder = $_GET['columnOrder'] ?? 'title';
        $orderOption = $_GET['orderOption'] ?? 'ASC';

        include $_SERVER['DOCUMENT_ROOT'] . '/Views/generatePDF.php';
    }

    public function redirect($page) {
        header("Location: " . "../" . $page);
    }

}