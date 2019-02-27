<?php

namespace App\Contracts\Dao\Auth;

interface RegisterDaoInterface
{
    /**
     * Authenticate register
     *
     * Authenticate for adding user
     * @param [id] $id
     */
    public function getRegister($id);
}
