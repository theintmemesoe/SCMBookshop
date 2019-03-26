<?php

namespace App\Services;

use App\Contracts\Dao\GenreDaoInterface;
use App\Contracts\Services\GenreServiceInterface;
use App\Genre;
use Illuminate\Http\Request;

class GenreService implements GenreServiceInterface
{
    private $genreDao;

    /**
     * Class Constructor
     * @param GenreDaoInterface
     * @return
     */
    public function __construct(GenreDaoInterface $genreDao)
    {
        $this->genreDao = $genreDao;
    }

    public function addGenre(Request $request)
    {
        return $this->genreDao->addGenre($request);
    }

    public function searchGenre($name)
    {
        return $this->genreDao->searchGenre($name);
    }

    public function genreList()
    {
        return $this->genreDao->genreList();
    }

    public function edit()
    {
        return $this->genreDao->edit();
    }

    public function update(Request $request)
    {
        return $this->genreDao->update($request);
    }

    public function delete($id)
    {
        return $this->genreDao->delete($id);
    }
}
