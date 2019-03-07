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
   * @param OperatorUserDaoInterface
   * @return
   */
  public function __construct(BookDaoInterface $bookDao)
  {
    $this->bookDao = $bookDao;
  }

  /**
   * Get User List
   * @param Object
   * @return $userList
   */
  //  public function addAuthor(Request $request)
  //  {
  //      $name = $request['name'];
  //      $history = $request['history'];
  //      $description = $request['description'];
  //      //check validation
  //      $validator = Validator::make($request->all(), [
  //        'name' => 'required|unique:authors',
  //        'history' => 'required',
  //        'description' => 'required',
  //    ]);
  //    $aut = new Author();
  //    $aut->name=$name;
  //    $aut->history=$history;
  //    $aut->description=$description;
  //    $aut->create_user_id=1;
  //    $aut->updated_user_id=1;
  //    $aut->save();
  //    return $this->authorDao->addAuthor($name,$history,$description); 
  //  }

}