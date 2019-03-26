<?php

namespace App\Dao;

use App\Contracts\Dao\GenreDaoInterface;
use App\Genre;
use Config;
use Illuminate\Http\Request;
use Log;

class GenreDao implements GenreDaoInterface
{
    /**
     * Get newgenre
     * @param Request $request
     * @return
     */
    public function addGenre(Request $request)
    {

        $name = $request['name'];
        $description = $request['description'];
        $gen = new Genre();
        $gen->name = $name;
        $gen->description = $description;
        $gen->create_user_id = 1;
        $gen->updated_user_id = 1;
        $gen->save();
        Log::info($gen);
    }

    /**
     * Get search genre
     * @param $name
     * @return
     */
    public function searchGenre($name)
    {
        return $gen = Genre::where('deleted_at', null)->where('name', 'LIKE', '%' . $name . '%')->paginate(Config::get('constants.pagination.paginate'))->appends(['name' => $name]);
    }

    /**
     * Get genre List
     * @param
     * @return
     */
    public function genreList()
    {
        return $gen = Genre::where('deleted_at', null)->paginate(Config::get('constants.pagination.paginate'));
    }

    /**
     * Get edit genre
     * @param
     * @return
     */
    public function edit()
    {
        return Genre::get();
    }

    /**
     * Get update genre
     * @param Request $request
     * @return
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $row = Genre::find($id)->first();
        $row->name = request('name');
        $row->description = request('description');
        $row->save();
    }

    /**
     * Get delete genre
     * @param $id
     * @return
     */
    public function delete($id)
    {
        $result = Genre::find($id);
        $result->deleted_user_id = auth()->id();
        $result->deleted_at = now();
        $result->save();
    }
}
