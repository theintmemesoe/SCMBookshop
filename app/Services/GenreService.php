<?php

namespace App\Services;

use App\Contracts\Dao\GenreDaoInterface;
use App\Contracts\Services\GenreServiceInterface;
use App\Genre;

class GenreService implements GenreServiceInterface
{
  private $authorDao;

  /**
   * Class Constructor
   * @param OperatorUserDaoInterface
   * @return
   */
  public function __construct(GenreDaoInterface $GenreDao)
  {
    $this->genreDao = $genreDao;
  }

  /**
   * Get User List
   * @param Object
   * @return $userList
   */
  public function deleteGenre($id)
  {
    return $this->authorDao->delete($id);
  }
}