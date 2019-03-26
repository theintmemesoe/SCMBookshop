<?php

namespace App\Services;

use App\Author;
use App\Contracts\Dao\AuthorDaoInterface;
use App\Contracts\Services\AuthorServiceInterface;
use App\User;
use Auth;
use Illuminate\Http\Request;

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
     * Get Author List
     * @param Request $request
     * @return $request
     */
    public function addAuthor(Request $request)
    {
        return $this->authorDao->addAuthor($request);
    }

    /**
     * Get Author List
     * @param $name
     * @return $name
     */
    public function searchAuthor($name)
    {
        return $this->authorDao->searchAuthor($name);
    }

    /**
     * Get Author List
     * @param
     * @return
     */
    public function authorList()
    {
        return $this->authorDao->authorList();
    }

    /**
     * Get Author List
     * @param
     * @return
     */
    public function edit()
    {
        return $this->authorDao->edit();
    }

    /**
     * Get Author List
     * @param Request $request
     * @return $request
     */
    public function update(Request $request)
    {
        return $this->authorDao->update($request);
    }

    /**
     * Get Author List
     * @param $id
     * @return $id
     */
    public function delete($id)
    {
        return $this->authorDao->delete($id);
    }

}
