<?php

namespace App\Contracts\Dao;

use Illuminate\Http\Request;

interface RegisterDaoInterface
{
  public function create(array $data);
}