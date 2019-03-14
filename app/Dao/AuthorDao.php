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
      * Get Operator List
      * @param Request 
      * @return $operatorList
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
      * Get Operator List
      * @param $name 
      * @return $operatorList
      */
    public function searchAuthor($name)
    {
      $author = new Author;
      
      return $author->where('deleted_at', NULL)->where('name','LIKE','%'.$name.'%' )->paginate(Config::get('constants.paginate'))->appends(['name' => $name]);
    }
  
    /**
      * Get Operator List
      * @param  
      * @return $operatorList
      */
    public function authorList()
    {
      $author= new Author;
      return $author->where('deleted_at', NULL)->paginate(2);    
    }

    /**
      * Get Operator List
      * @param  
      * @return $operatorList
      */
    public function edit()
    {
      return Author::get();
    }

    /**
      * Get Operator List
      * @param Request [$request] 
      * @return $operatorList
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
      * Get Operator List
      * @param $id 
      * @return $operatorList
      */
    public function delete($id)
    {
        $result = Author::find($id);
        $result->deleted_user_id = auth()->id();
        $result->deleted_at = now();
        $result->save();
    }  
}