<?php

namespace App\Contracts\Services;
use Illuminate\Http\Request;

interface BookServiceInterface
{
  public function addBook(Request $request);
  public function bookList();
  public function searchBook(array $data);
  public function getGenreList();
  public function getAuthorList();
  public function getBookList();
  public function delete($id);
  public function getImage($file_name);
  public function getPDF($file_name);
  public function downloadCSV();
  
}