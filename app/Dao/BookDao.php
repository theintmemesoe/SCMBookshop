<?php

namespace App\Dao;

use App\Contracts\Dao\BookDaoInterface;
use App\Contracts\Services\BookServiceInterface;
use App\Book;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Log;
use DB;

class BookDao implements BookDaoInterface
{
    /**
    * Get Book List
    * @param Request $request
    * @return 
    */
    public function addBook(Request $request)
    {
        $name = $request['name'];
        $price = $request['price'];
        $author_id = $request['author_id'];
        $genre_id = $request['genre_id'];
        $image = $request['image'];
        $sample_pdf = $request['sample_pdf'];
        $published_date = $request['published_date'];
        $description = $request['description'];
        $book = new Book();
        $book->name=$name;
        $book->price=$price;
        $book->author_id=$author_id;
        $book->genre_id=$genre_id;
        $book->image=$image;
        $book->sample_pdf=$sample_pdf;
        $book->published_date=$published_date;
        $book->description=$description;
        $book->create_user_id=1;
        $book->updated_user_id=1;
        $book->save();
    }

    /**
    * Get Book List
    * @param $name
    * @return $name
    */
    public function searchBook($name)
    {
      $book = new Book;  
      return $book->where('deleted_at', NULL)->where('name','LIKE','%'.$name.'%' )->paginate(2)->appends(['name' => $name]);
    }
  
    /**
    * Get Book List
    * @param 
    * @return 
    */
    public function bookList()
    {
      $book = new Book;
      return $book->where('deleted_at', NULL)->paginate(2);    
    }
}