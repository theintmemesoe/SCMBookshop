<?php

namespace App\Services;

use App\Book;
use App\Contracts\Dao\BookDaoInterface;
use App\Contracts\Services\BookServiceInterface;
use Illuminate\Http\Request;

class BookService implements BookServiceInterface
{
    private $bookDao;

    /**
     * Class Constructor
     * @param OperatorBookDaoInterface
     * @return
     */
    public function __construct(BookDaoInterface $bookDao)
    {
        $this->bookDao = $bookDao;
    }

    /**
     * Get Book List
     * @param Request $request
     * @return $request
     */
    public function addBook(Request $request)
    {
        return $this->bookDao->addBook($request);
    }

    /**
     * Get Book List
     * @param $name
     * @return $name
     */
    public function searchBook(array $data)
    {
        return $this->bookDao->searchBook($data);
    }

    /**
     * Get Book List
     * @param
     * @return
     */
    public function bookList()
    {
        return $this->bookDao->bookList();
    }

    /**
     * Get Book List
     * @param
     * @return
     */
    public function getGenreList()
    {
        return $this->bookDao->getGenreList();
    }

    /**
     * Get Book List
     * @param
     * @return
     */
    public function getBookList()
    {
        return $this->bookDao->getBookList();
    }

    /**
     * Get Book List
     * @param
     * @return
     */
    public function getAuthorList()
    {
        return $this->bookDao->getAuthorList();
    }

    /**
     * Get file
     * @param
     * @return
     */
    public function getImage($file_name)
    {
        return $this->bookDao->getImage($file_name);
    }

    /**
     * Get file
     * @param
     * @return
     */
    public function getPDF($file_name)
    {
        return $this->bookDao->getPDF($file_name);
    }

    /**
     * Get book List
     * @param Request $request
     * @return $request
     */
    public function update(Request $request)
    {
        return $this->bookDao->update($request);
    }

    /**
     * Get Book List
     * @param $id
     * @return
     */
    public function delete($id)
    {
        return $this->bookDao->delete($id);
    }

    /**
     * Get csv
     * @param
     * @return
     */
    public function downloadCSV()
    {
        return $this->bookDao->downloadCSV();
    }

}
