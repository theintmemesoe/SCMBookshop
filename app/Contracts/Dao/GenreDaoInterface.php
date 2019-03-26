<?php

namespace App\Contracts\Dao;

use Illuminate\Http\Request;

interface GenreDaoInterface
{
    public function addGenre(Request $request);
    public function genreList();
    public function searchGenre($name);
    public function edit();
    public function update(Request $request);
    public function delete($id);
}
