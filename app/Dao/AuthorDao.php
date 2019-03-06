<?php

namespace App\Dao;

use App\Contracts\Dao\AuthorDaoInterface;
use App\Contracts\Services\AuthorServiceInterface;
use App\Author;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Log;
use DB;

class AuthorDao implements AuthorDaoInterface
{
  /**
   * Get Operator List
   * @param Object
   * @return $operatorList
   */
   public function addAuthor($name,$history,$description)
   {
     $aut = new Author();
     $aut->name=$name;
     $aut->history=$history;
     $aut->description=$description;
     $aut->create_user_id=1;
     $aut->updated_user_id=1;
     $aut->save();
     return redirect('authorList');
    //  return $this->authorDao->addAuthor($request); 

   }
}