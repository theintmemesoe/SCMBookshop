<?php

namespace App\Http\Controllers\Genre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Contracts\Services\GenreServiceInterface;
use App\Genre;
use lluminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Auth;
use App\User;
use Log;
use DB;


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
        $this->genreService=$genreService;
    }

   
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getGenre(Request $request)
    {

        $name = Input::get ( 'name' );
        if(count($name) > 0){
            $gen=$this->genreService->searchGenre($name);
            return view('genre.genreList')->with('gen', $gen);
        }

        elseif(count($name)==null){
            $gen=$this->genreService->genreList();
            return view('genre.genreList')->with('gen', $gen);
        }

        else
            return view('genre.genreList')->withMessage('No Details found. Try to search again !'); 

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param Request $request
     * @return \App\Genre
     */
    public function addGenre(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:genres',
        ]);
      $this->genreService->addGenre($request);
      return redirect('genre/genreList');
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $genEdit_id
     * @return \Illuminate\Http\Response
     */
    public function edit(Genre $genEdit_id)
    {
        $gen = $this->genreService->edit();
        return view('genre.editGenre',compact('gen','genEdit_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $this->validate(request(),[
            'name'=>'required',         
            ]);
               
         $this->genreService->update($request);
         return redirect('genre/genreList');
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function delete($id)
     {
        $this->genreService->delete($id);
        return redirect('genre/genreList'); 
       
         
     }

}
