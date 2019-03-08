<?php

namespace App\Contracts\Dao;

use Illuminate\Http\Request;

interface BookDaoInterface
{
  public function addBook(Request $request);
  public function bookList();
  public function searchBook($name);
  // public function edit();
  // public function update();
  // public function delete();
}