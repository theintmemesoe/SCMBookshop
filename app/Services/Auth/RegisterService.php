<?php

namespace App\Services\Auth;

use App\Contracts\Dao\Auth\RegisterDaoInterface;
use App\Contracts\Services\Auth\RegisterServicesInterface;

class RegisterService implements RegisterServicesInterface
{
    // auth dao for injecting RegisterDaoInterface
    private $registerDao;

    /**
     * Class Constructor
     * @param AuthDaoInterface
     * @return
     */
    public function __construct(RegisterDaoInterface $registerDao)
    {
        $this->registerDao = $registerDao;
    }

    /**
     * Authenticate Register
     *
     * Authenticate for admin register
     * @param
     * @return
     */
    public function getRegister($id)
    {
        return $this->registerDao->getRegister($id);
    }
}
