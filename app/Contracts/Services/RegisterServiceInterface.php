<?php

namespace App\Contracts\Services;

use Illuminate\Http\Request;

interface RegisterServiceInterface
{
  public function create(array $data);
}
