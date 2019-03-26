<?php

namespace App\Contracts\Services;

use Illuminate\Http\Request;

interface GenreServiceInterface
{
    public function addGenre(Request $request);
    public function genreList();
    public function searchGenre($name);
    public function edit();
    public function update(Request $request);
    public function delete($id);
}
