<?php

namespace App\Services;

use App\Contracts\Dao\RegisterDaoInterface;
use App\Contracts\Services\RegisterServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\User;
use Log;
use DB;

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