<?php

namespace App\Contracts\Services;

use Illuminate\Http\Request;

interface AuthorServiceInterface
{
  //add author
  public function addAuthor(Request $request);

  
}