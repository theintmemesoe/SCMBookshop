<?php

namespace App\Dao;

use App\Contracts\Dao\GenreDaoInterface;
use App\Contracts\Services\GenreServiceInterface;
use App\Genre;
use Log;
use Illuminate\Http\Request;
use Config;

class GenreDao implements GenreDaoInterface
{
  /**
   * Get Operator List
   * @param Object
   * @return $operatorList
   */
   public function addGenre(Request $request)
   {
               
    $name = $request['name'];
    $description = $request['description'];
    $gen = new Genre();
    $gen->name=$name;
    $gen->description=$description;
    $gen->create_user_id=1;
    $gen->updated_user_id=1;
    $gen->save();
    Log::info($gen);
      
   }

   public function searchGenre($name)
   {
     $gen = new Genre;
     
     return $gen->where('deleted_at', NULL)->where('name','LIKE','%'.$name.'%' )->paginate(Config::get('constants.paginate'))->appends(['name' => $name]);
   }
 
   public function genreList()
   {
     $gen = new Genre;
     return $gen->where('deleted_at', NULL)->paginate(2);    
   }

   public function edit()
   {
     return Genre::get();
   }

   public function update(Request $request)
   {
        $id=$request->id;
        $row=Genre::find($id)->first();
        $row->name=request('name');
        $row->description=request('description');
        $row->save();
   }

   public function delete($id)
   {
       $result = Genre::find($id);
       $result->deleted_user_id = auth()->id();
       $result->deleted_at = now();
       $result->save();
   }
}