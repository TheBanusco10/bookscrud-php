<?php


class Book
{

    private $id;
    private $isbn;
    private $title;
    private $author;
    private $publisher;
    private $pages;

    /**
     * Book constructor.
     * @param $id
     * @param $isbn
     * @param $title
     * @param $author
     * @param $publisher
     * @param $pages
     */
    public function __construct($id, $isbn, $title, $author, $publisher, $pages)
    {
        $this->id = $id;
        $this->isbn = $isbn;
        $this->title = $title;
        $this->author = $author;
        $this->publisher = $publisher;
        $this->pages = $pages;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }


    /**
     * @return mixed
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * @return mixed
     */
    public function getPages()
    {
        return $this->pages;
    }




}