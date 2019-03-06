<?php

namespace App\Contracts\Services;

interface AuthorServiceInterface
{
  //add author
  public function addAuthor(Request $request);
}