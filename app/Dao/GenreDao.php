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
   * @param Request $request
   * @return 
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

   /**
   * Get Operator List
   * @param $name
   * @return 
   */
   public function searchGenre($name)
   {
     return $gen = Genre::where('deleted_at', NULL)->where('name','LIKE','%'.$name.'%' )->paginate(Config::get('constants.pagination.paginate'))->appends(['name' => $name]);
   }
 
   /**
   * Get Operator List
   * @param
   * @return 
   */
   public function genreList()
   {
     return $gen = Genre::where('deleted_at', NULL)->paginate(Config::get('constants.pagination.paginate'));    
   }

   /**
   * Get Operator List
   * @param 
   * @return 
   */
   public function edit()
   {
     return Genre::get();
   }

   /**
   * Get Operator List
   * @param Request $request
   * @return 
   */
   public function update(Request $request)
   {
        $id=$request->id;
        $row=Genre::find($id)->first();
        $row->name=request('name');
        $row->description=request('description');
        $row->save();
   }

   /**
   * Get Operator List
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