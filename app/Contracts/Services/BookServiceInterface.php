<?php

namespace App\Contracts\Services;
use Illuminate\Http\Request;

interface BookServiceInterface
{
  public function addBook(Request $request);
  public function bookList();
  public function searchBook($name);
}