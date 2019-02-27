<?php

namespace App\Contracts\Services\Auth;

interface RegisterServicesInterface
{
    /**
     * Authenticate register
     *
     * Authenticate for adding user
     * @param [id] $id
     */
    public function getRegister($id);
}