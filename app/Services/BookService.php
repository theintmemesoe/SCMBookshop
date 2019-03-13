<?php

namespace App\Services;

use App\Contracts\Dao\BookDaoInterface;
use App\Contracts\Services\BookServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Book;
use Auth;
use App\User;
use Log;
use DB;

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
   public function searchBook($name)
   {
     return $this->bookDao->searchBook($name);
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
   * Get file
   * @param 
   * @return 
   */
   public function getImage($file_name)
   {
     return $this->bookDao->getImage($file_name);
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

}