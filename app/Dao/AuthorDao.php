<?php

namespace App\Dao;

use App\Contracts\Dao\AuthorDaoInterface;
use App\Contracts\Services\AuthorServiceInterface;
use App\Author;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Log;
use DB;
use Config;

class AuthorDao implements AuthorDaoInterface
{
      /**
      * Get author
      * @param Request $request
      * @return 
      */
    public function addAuthor(Request $request)
    {
                
      $name = $request['name'];
      $history = $request['history'];
      $description = $request['description'];
      $aut = new Author();
      $aut->name=$name;
      $aut->history=$history;
      $aut->description=$description;
      $aut->create_user_id=1;
      $aut->updated_user_id=1;
      $aut->save();
       
    }

    /**
      * Get search author
      * @param $name 
      * @return 
      */
    public function searchAuthor($name)
    {  
      return $author = Author::where('deleted_at', NULL)->where('name','LIKE','%'.$name.'%' )->paginate(Config::get('constants.pagination.paginate'))->appends(['name' => $name]);
    }
  
    /**
      * Get author List
      * @param  
      * @return 
      */
    public function authorList()
    {
      return $author = Author::where('deleted_at', NULL)->paginate(Config::get('constants.pagination.paginate'));    
    }

    /**
      * Get author edit
      * @param  
      * @return 
      */
    public function edit()
    {
      return Author::get();
    }

    /**
      * Get author update
      * @param Request [$request] 
      * @return
      */
    public function update(Request $request)
    {
        $id=$request->id;
        $row=Author::find($id);
        $row->name=request('name');
        $row->history=request('history');
        $row->description=request('description');
        $row->save();
    }

    /**
      * Get author delete
      * @param $id 
      * @return 
      */
    public function delete($id)
    {
        $result = Author::find($id);
        $result->deleted_user_id = auth()->id();
        $result->deleted_at = now();
        $result->save();
    }  
}