<?php

namespace App\Dao;

use App\Contracts\Dao\BookDaoInterface;
use App\Contracts\Services\BookServiceInterface;
use App\Book;
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
        $image = $request['image'];

        // $extension = $image->getClientOriginalExtension();
        // $file=$request->file('image');
        // Storage::disk('public')->put($image->getFilename().'.'.$extension,  File::get($image));
    
  
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename =time().'.'.$extension;
        $file->move('books/',$filename);
        
        $sample_pdf = $request['sample_pdf'];

        // $extension = $sample_pdf->getClientOriginalExtension();
        // $file=$request->file('sample_pdf');
        // Storage::disk('public')->put($sample_pdf->getFilename().'.'.$extension,  File::get($sample_pdf));
        
    
        $file = $request->file('sample_pdf');
        $extension = $file->getClientOriginalExtension();
        $filenamePdf =time().'.'.$extension;
        $file->move('books/',$filenamePdf);

        $published_date = $request['published_date'];
        $description = $request['description'];
        $book = new Book();
        $book->name=$name;
        $book->price=$price;
        $book->author_id=$author_id;
        $book->genre_id=$genre_id;
        $book->image=$filename;
        $book->sample_pdf=$filenamePdf;
        $book->published_date=$published_date;
        $book->description=$description;
        $book->create_user_id=1;
        $book->updated_user_id=1;
        $book->save();

        // $image = time().'.'.request()->image->getClientOriginalExtension();
        // request()->image->move(public_path($book->id), $image);

        // $sample_pdf = time().'.'.request()->sample_pdf->getClientOriginalExtension();
        // request()->sample_pdf->move(public_path('books/',$book->id), $sample_pdf);
        // Log::info($book);
    }

  //   public function myUpload(Request $request){
  //     //$file_name=$request->file('myFile')->getClientOriginalName();->create folder in storage show data

  //     $name=$request['name'];
  //     $file_name=$request['name'].'.'.$request->file('myFile')->getClientOriginalExtension();
  //     $file=$request->file('myFile');

  //     $pd=new Product();
  //     $pd->name=$name;
  //     $pd->file_name=$file_name;
  //     $pd->save();

  //     Storage::disk('myFile')->put($file_name,file::get($file));
  //     return redirect()->back();
  // }
  // public function getFile($file_name){
  //     $file=Storage::disk('myFile')->get($file_name);
  //     return response($file,200)->header('Content-type','*');
  // }

  public function getFile($file_name)
  {
    $file=Storage::disk('public')->get($filename);
    return response($file,200)->header('Content-type','*');
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

    /**
    * Get Book List
    * @param 
    * @return 
    */
    public function edit()
    {
      
    } 

    /**
    * Get Book List
    * @param 
    * @return 
    */
    public function update(Request $request)
    {
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