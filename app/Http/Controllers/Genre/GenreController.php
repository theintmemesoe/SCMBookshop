<?php

namespace App\Http\Controllers\Genre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Contracts\Services\GenreServiceInterface;
use App\Genre;
use lluminate\Pagination\Paginator;
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
    public function _construct(GenreServiceInterface $genreService)
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
        $name=$request->name;
        if(count($name) > 0){
            $gen= DB::table('genres')->where('deleted_at', NULL)->where('name','LIKE','%'.$name.'%' )->paginate(1);
            return view('genreList')->with(['gen'=>$gen]);
        }
        elseif(count($name)==null){
            $gen=DB::table('genres')->where('deleted_at',NULL)->paginate(2);
            return view('genreList')->with(['gen'=>$gen]);
        }
        else
            return view('genreList')->withMessage('No Details found. Try to search again !');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param Request $request
     * @return \App\Genre
     */
    public function addGenre(Request $request)
    {
        $name = $request['name'];
        $description = $request['description'];
        //check validation
        $validator = Validator::make($request->all(), [
          'name' => 'required|unique:genres',
      ]);
      $gen = new Genre();
      $gen->name=$name;
      $gen->description=$description;
      $gen->create_user_id=1;
      $gen->updated_user_id=1;
      $gen->save();
      return redirect('genreList');
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $genEdit_id
     * @return \Illuminate\Http\Response
     */
    public function edit(Genre $genEdit_id)
    {
        $gen=Genre::all();
        return view('editGenre',compact('gen','genEdit_id'));
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
        //validate
        $this->validate(request(),[
            'name'=>'required',            
        ]);
           $id=$request->id;
           $row=Genre::find($id)->first();
           $row->name=request('name');
           $row->description=request('description');
           $row->save();
            return redirect('genreList');
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function delete($id)
     {
         $result = Genre::find($id);
         $result->deleted_user_id = auth()->id();
         $result->deleted_at = now();
         $result->save();
         return redirect('genreList');  
     }

}
