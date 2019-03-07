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

class AuthorDao implements AuthorDaoInterface
{
      /**
       * Get Operator List
      * @param Object
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

    public function searchAuthor($name)
    {
      $author = new Author;
      
      return $author->where('deleted_at', NULL)->where('name','LIKE','%'.$name.'%' )->paginate(2)->appends(['name' => $name]);
    }
  
    public function authorList()
    {
      $author= new Author;
      return $author->where('deleted_at', NULL)->paginate(2);    
    }

    public function edit()
    {
      return Author::get();
    }

    public function update(Request $request)
    {
        $id=$request->id;
        $row=Author::find($id);
        $row->name=request('name');
        $row->history=request('history');
        $row->description=request('description');
        $row->save();
    }

    public function delete($id)
    {
        $result = Author::find($id);
        $result->deleted_user_id = auth()->id();
        $result->deleted_at = now();
        $result->save();
    }
       
    

  
}