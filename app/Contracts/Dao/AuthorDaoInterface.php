<?php

namespace App\Contracts\Dao;

use Illuminate\Http\Request;

interface AuthorDaoInterface
{
    public function addAuthor(Request $request);
    public function authorList();
    public function searchAuthor($name);
    public function edit();
    public function update(Request $request);
    public function delete($id);

}
