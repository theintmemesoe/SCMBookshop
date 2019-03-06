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
       $name = $request['name'];
       $history = $request['history'];
       $description = $request['description'];
       //check validation
       $validator = Validator::make($request->all(), [
         'name' => 'required|unique:authors',
         'history' => 'required',
         'description' => 'required',
     ]);
     $aut = new Author();
     $aut->name=$name;
     $aut->history=$history;
     $aut->description=$description;
     $aut->create_user_id=1;
     $aut->updated_user_id=1;
     $aut->save();
     return $this->authorDao->addAuthor($name,$history,$description); 
   }

}