<?php

namespace App\Dao;

use App\Contracts\Dao\BookDaoInterface;
use App\Contracts\Services\BookServiceInterface;
use App\Book;
use App\Author;
use App\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
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

        $image_name=$request['name'].'.'.$request->file('image')->getClientOriginalExtension();
        $image_file=$request->file('image');

        $sample_pdf_name=$request['name'].'.'.$request->file('sample_pdf')->getClientOriginalExtension();
        $sample_pdf_file=$request->file('sample_pdf');

        $published_date = $request['published_date'];
        $description = $request['description'];
        $book = new Book();
        $book->name=$name;
        $book->price=$price;
        $book->author_id=$author_id;
        $book->genre_id=$genre_id;
        $book->image=$image_name;
        $book->sample_pdf=$sample_pdf_name;
        $book->published_date=$published_date;
        $book->description=$description;
        $book->create_user_id=1;
        $book->updated_user_id=1;
        $book->save();
        $image_file->move(public_path('books/'.$book->id),$image_name);
        $sample_pdf_file->move(public_path('books/'.$book->id),$sample_pdf_name);
    }

     /**
    * Get Book List
    * @param $file_name
    * @return $file_name
    */
    public function getImage($file_name)
    {
      $file=Storage::disk('public')->get($filename);
      return response($file,200)->header('Content-type','jpg/png');
    }

    /**
    * Get Book List
    * @param $name
    * @return $name
    */
    public function searchBook($name)
    {
      // $author = Author::where('name','LIKE','%'.$name.'%' )->get();
      // $genre = Genre::where('name','LIKE','%'.$name.'%' )->get();
      $author = new Author;
      // Log::info($author->name);
      $genre = new Genre;
      $book = new Book;  
      return $book->where('deleted_at', NULL)->where('name','LIKE','%'.$name.'%' )->paginate(2)->appends(['name' => $name]);
      // $genre = Genre::OrderBy('id','desc')->where('name','LIKE','%'.$name.'%')->get();
      // $author = Author::OrderBy('id','desc')->where('name','LIKE','%'.$name.'%')->get();

      return $author->where('deleted_at', NULL)->where('name','LIKE','%'.$name.'%' )->paginate(2)->appends(['name' => $name]);
      return $genre->where('deleted_at', NULL)->where('name','LIKE','%'.$name.'%' )->paginate(2)->appends(['name' => $name]);
    }
  
    /**
    * Get Book List
    * @param 
    * @return 
    */
    public function bookList()
    {
      $book = new Book;
      $author = new Author;
      $genre = new Genre;
      return $book->where('deleted_at', NULL)->paginate(2);
      return $author->where('deleted_at', NULL)->paginate(2); 
      return $genre->where('deleted_at', NULL)->paginate(2);     
    }

    /**
    * Get Book List
    * @param 
    * @return 
    */
    public function edit()
    {
      return Book::get();
    } 

    /**
    * Get Book List
    * @param 
    * @return 
    */
    public function update(Request $request)
    {
      $id=$request->id;
      $row=Book::find($id);
      // $oldImage=$row->image;
      // $oldPdf=$row->sample_pdf;
      $image_file=$request->file('image');
      $sample_pdf_file=$request->file('sample_pdf');
      // if($image_file && $sample_pdf_file)
      // {
      //   // unlink(public_path("books"));
      //   // unlink(public_path("books"));
      //   $image_name=$request['name'].'.'.$request->file('image')->getClientOriginalExtension();
      //   $sample_pdf_name=$request['name'].'.'.$request->file('sample_pdf')->getClientOriginalExtension();
      //   $row->name=request('name');
      //   $row->price=request('price');
      //   $row->author_id=request('author_id');
      //   $row->genre_id=request('genre_id');
      //   $row->image=$image_name;
      //   $row->image=$sample_pdf_name;
      //   $image_file->move(public_path('books/'.$row->id),$image_name);
      //   $sample_pdf_file->move(public_path('books/'.$row->id),$sample_pdf_name);
      //   $row->published_date=request('published_date');
      //   $row->description=request('description');
      // }  
      // else{
      //   $row->name=request('name');
      //   $row->price=request('price');
      //   $row->author_id=request('author_id');
      //   $row->genre_id=request('genre_id');
      //   $row->sample_pdf=request('sample_pdf');
      //   $row->published_date=request('published_date');
      //   $row->description=request('description');
      // }
      // $row->save(); 
      
      if($image_file)
      {
        if($sample_pdf_file)
        {
          $image_name=$request['name'].'.'.$request->file('image')->getClientOriginalExtension();
          $sample_pdf_name=$request['name'].'.'.$request->file('sample_pdf')->getClientOriginalExtension();
          $row->name=request('name');
          $row->price=request('price');
          $row->author_id=request('author_id');
          $row->genre_id=request('genre_id');
          $row->image=$image_name;
          $row->sample_pdf=$sample_pdf_name;
          $image_file->move(public_path('books/'.$row->id),$image_name);
          $sample_pdf_file->move(public_path('books/'.$row->id),$sample_pdf_name);
          $row->published_date=request('published_date');
          $row->description=request('description');
        }
      }
      else{
        $row->name=request('name');
        $row->price=request('price');
        $row->author_id=request('author_id');
        $row->genre_id=request('genre_id');
        $row->published_date=request('published_date');
        $row->description=request('description');
      }
      $row->save(); 
    }

    /**
    * Get Book List
    * @param 
    * @return 
    */
    public function delete($id)
    {
        $result = Book::find($id);
        $result->deleted_user_id = auth()->id();
        $result->deleted_at = now();
        $result->save();
    }  
}