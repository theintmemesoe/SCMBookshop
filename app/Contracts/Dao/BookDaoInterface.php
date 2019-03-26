<?php

namespace App\Contracts\Dao;

use Illuminate\Http\Request;

interface BookDaoInterface
{
    public function addBook(Request $request);
    public function bookList();
    public function searchBook(array $data);
    public function getGenreList();
    public function getAuthorList();
    public function getBookList();
    public function edit();
    public function update(Request $request);
    public function delete($id);
    public function getImage($file_name);
    public function getPDF($file_name);
    public function downloadCSV();
    public function getUploadCSV($importData_arr);

}
