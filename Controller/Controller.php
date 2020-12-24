<?php

require_once ('Model/Book.php');

class Controller
{
    private $model;

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

        if (!$operation && !$id) {
            $books = $this->model->getBooks();
            include ('Views/booksList.php');

        }else if ($id && !$operation) {
            die('Operation is missing');

        }else if (!$id && $operation && $operation != 'new') {
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

    public function redirect($page) {
        header("Location: " . "../" . $page);
    }

}