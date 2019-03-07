<?php

namespace App\Services;

use App\Contracts\Dao\AuthorDaoInterface;
use App\Contracts\Services\AuthorServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Author;
use Auth;
use App\User;
use Log;
use DB;

class AuthorService implements AuthorServiceInterface
{
  private $authorDao;

  /**
   * Class Constructor
   * @param OperatorUserDaoInterface
   * @return
   */
  public function __construct(AuthorDaoInterface $authorDao)
  {
    $this->authorDao = $authorDao;
  }

  /**
   * Get User List
   * @param Object
   * @return $userList
   */
      public function addAuthor(Request $request)
      {
          
        return $this->authorDao->addAuthor($request); 
      }

      public function searchAuthor($name)
      {
        return $this->authorDao->searchAuthor($name);
      }
    
      public function authorList()
      {
        return $this->authorDao->authorList();
      }

      public function edit()
      {
        return $this->authorDao->edit();
      } 

      public function update(Request $request)
      {
        return $this->authorDao->update($request);
      } 

      public function delete($id)
      {
        return $this->authorDao->delete($id);
      } 


    
  


}