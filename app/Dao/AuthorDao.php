<?php

namespace App\Dao;

use App\Contracts\Dao\AuthorDaoInterface;
use App\Contracts\Services\AuthorServiceInterface;
use App\Author;

class AuthorDao implements AuthorDaoInterface
{
  /**
   * Get Operator List
   * @param Object
   * @return $operatorList
   */
  public function delete($request)
  {
    // $author = Author::find($request);
    // $author->delete();
  }
}