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

            if (isset($_GET['generatePDF'])) {

                $records = $_GET['records'];

                if (!isset($records) || empty($records))
                    $records = $this->maxRows;

                if (!is_numeric($records))
                    $this->errorPage('Records to print bust be empty or numeric');
                else
                    $this->generatePDF($columnOrder, $orderOption, $page, $records);
            }

            if ($page <= 0 || $page > $total_number_books)
                $this->errorPage('Invalid page number');

            $books = $this->model->getBooks($offset, $this->maxRows, $columnOrder, $orderOption);

            include ('Views/booksList.php');

        }else if ($id && !$operation) {
            $this->errorPage('Operation parameter is needed');

        }else if (!$id && $operation) {

            if ($operation != 'new' && $operation != 'pdf')
                $this->errorPage('ID parameter is needed');
        }

        switch ($operation) {
            case 'edit':
                $pdo = DB::connect();

                $stmt = $pdo->query("SELECT COUNT(*) As total_records FROM books");

                if ($id != null && ($id < 1 || $id > $stmt->fetch(5)->total_records)) {
                    $this->errorPage('Book not found');

                }else {

                    $this->editBook($id);
                }

                $pdo = null;

                break;

            case 'remove':
                $pdo = DB::connect();

                $stmt = $pdo->query("SELECT COUNT(*) As total_records FROM books");

                if ($id != null && ($id < 1 || $id > $stmt->fetch(5)->total_records)) {
                    $this->errorPage('Book not found');

                }else {
                    $this->removeBook($id);
                }

                $pdo = null;

                break;

            case 'show':
                $pdo = DB::connect();

                $stmt = $pdo->query("SELECT COUNT(*) As total_records FROM books");

                if ($id != null && ($id < 1 || $id > $stmt->fetch(5)->total_records)) {
                    $this->errorPage('Book not found');
                }else {

                    $this->showBook($id);
                }

                $pdo = null;
                break;

            case 'new':
                $this->newBook();
                break;

            case 'pdf':
                $this->generatePDF();
                break;

            default:
                $this->errorPage('Page not found');
                break;
        }

    }

    public function editBook($id) {

        session_start();

        $book = $this->model->getBookByID($id);

        if (isset($_POST['edit'])) {

            $error = $this->verifyInputs($_POST['isbn'], $_POST['title'], $_POST['author'], $_POST['publisher'], $_POST['pages']);

            if ($error) {
                $this->redirect("index.php?op=edit&id=$id");
                return;
            }else {
                $bookEdited = new Book($id, $_POST['isbn'], $_POST['title'], $_POST['author'],
                    $_POST['publisher'], $_POST['pages']);

                $this->model->editBook($bookEdited);
                $_SESSION['success'] = 'Book edited';
                $_SESSION['class'] = 'success';
                $this->redirect('index.php');
                return;
            }


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

            $error = $this->verifyInputs($_POST['isbn'], $_POST['title'], $_POST['author'], $_POST['publisher'], $_POST['pages']);

            if ($error) {
                $this->redirect('index.php?op=new');
                return;
            }else {
                $newBook = new Book(1, $_POST['isbn'], $_POST['title'], $_POST['author'],
                    $_POST['publisher'], $_POST['pages']);

                $this->model->insertBook($newBook);
                $_SESSION['success'] = 'Book added';
                $_SESSION['class'] = 'success';
                $this->redirect('index.php');
                return;
            }


        }else if (isset($_POST['cancel'])) {

            $this->redirect('index.php');
            return;
        }

        include $_SERVER['DOCUMENT_ROOT'] . '/Views/new.php';

    }

    public function generatePDF($columnOrder, $orderOption, $page, $maxRows) {

        $offset = ($page-1) * $this->maxRows;

        include $_SERVER['DOCUMENT_ROOT'] . '/Views/generatePDF.php';
    }

    public function verifyInputs($isbn, $title, $author, $publisher, $pages) {

        $error = false;

        if (empty($title) || empty($author) || empty($publisher) || empty($isbn) || empty($pages)) {
            $_SESSION['error'] = 'All fields required';
            $error = true;
        }else if (!is_numeric($pages)) {
            $_SESSION['error'] = 'Pages must be numeric';
            $error = true;

        }

        return $error;
    }

    public function errorPage($error) {

        session_start();

        $_SESSION['errorPage'] = $error;
        $this->redirect('errorPage.php');
    }

    public function redirect($page) {
        header("Location: " . "../" . $page);
    }



}