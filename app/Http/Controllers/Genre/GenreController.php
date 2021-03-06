<?php

namespace App\Http\Controllers\Genre;

use App\Contracts\Services\GenreServiceInterface;
use App\Genre;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class GenreController extends Controller
{
    private $genreService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(GenreServiceInterface $genreService)
    {
        $this->genreService = $genreService;
    }

    /**
     * call genre page
     *
     * @param Request $request
     * @return
     */
    public function getGenre(Request $request)
    {

        $name = Input::get('name');
        if (count($name) > 0) {
            $gen = $this->genreService->searchGenre($name);
            return view('genre.genreList')->with('gen', $gen);
        } elseif (count($name) == null) {
            $gen = $this->genreService->genreList();
            return view('genre.genreList')->with('gen', $gen);
        } else {
            return view('genre.genreList')->withMessage('No Details found. Try to search again !');
        }

    }

    /**
     * Create a new genre
     *
     * @param Request $request
     * @return
     */
    public function addGenre(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:genres',
        ]);
        $this->genreService->addGenre($request);
        return redirect('genre/genreList');
    }

    /**
     * edit genre
     *
     * @param $genEdit_id
     * @return
     */
    public function edit(Genre $genEdit_id)
    {
        $gen = $this->genreService->edit();
        return view('genre.editGenre', compact('gen', 'genEdit_id'));
    }

    /**
     * Update genre
     *
     * @param  Request $request
     * @return
     */
    public function update(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required',
        ]);

        $this->genreService->update($request);
        return redirect('genre/genreList');
    }

    /**
     * Remove genre
     *
     * @param $id
     * @return
     */
    public function delete($id)
    {
        $this->genreService->delete($id);
        return redirect('genre/genreList');
    }

}
