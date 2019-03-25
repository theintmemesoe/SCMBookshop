<?php

namespace App\Services;

use App\Contracts\Dao\RegisterDaoInterface;
use App\Contracts\Services\RegisterServiceInterface;
use App\User;

class RegisterService implements RegisterServiceInterface
{
    private $registerDao;

    /**
     * Class Constructor
     * @param OperatorUserDaoInterface
     * @return
     */
    public function __construct(RegisterDaoInterface $registerDao)
    {
        $this->registerDao = $registerDao;
    }

    /**
     * Get User List
     * @param Object
     * @return $userList
     */
    public function create(array $data)
    {
        return $this->registerDao->create($data);
    }

}
