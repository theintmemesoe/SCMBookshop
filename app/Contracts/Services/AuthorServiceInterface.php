<?php

namespace App\Contracts\Services;

use Illuminate\Http\Request;
use App\Author;

interface AuthorServiceInterface
{
  public function addAuthor(Request $request);
  public function authorList();
  public function searchAuthor($name);
  public function edit();
  public function update(Request $request);
  public function delete($id);

}
