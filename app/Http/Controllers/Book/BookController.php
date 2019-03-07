<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Contracts\Services\BookServiceInterface;
use App\Book;
use Illuminate\Support\Facades\Input;
use lluminate\Pagination\Paginator;
use Auth;
use App\User;
use Log;
use DB;


class BookController extends Controller
{
    private $bookService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BookServiceInterface $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
     public function getBook()
     {
         $book = Book::all();
         return view('book.bookList')->with(['book'=>$book]);
     }
    // public function getAuthor(Request $request)
    // {

    //     $name=$request->name;
    //     if(count($name) > 0){
    //         $aut= DB::table('authors')->where('deleted_at', NULL)->where('name','LIKE','%'.$name.'%' )->paginate(1);
    //         return view('authorList')->with(['aut'=>$aut]);
    //     }
    //     elseif(count($name)==null){
    //         $aut=DB::table('authors')->where('deleted_at',NULL)->paginate(2);
    //         return view('authorList')->with(['aut'=>$aut]);
    //     }
    //     else
    //         return view('authorList')->withMessage('No Details found. Try to search again !');
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param Request $request
     * @return \App\Author
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
        //check validation
        $validator = Validator::make($request->all(), [
          'name' => 'required|unique:books',
          'price' => 'required',
          'author_id' => 'required',
          'genre_id' => 'required',
          'image' => 'required',
          'sample_pdf' => 'required',
          'published_date' => 'required',
          'description' => 'required',
      ]);
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
      return redirect('book/bookList');
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $autEdit_id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $bookEdit_id)
    {
        $book=Book::all();
        return view('book.editBook',compact('book','bookEdit_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request)
    // {
    //     //validate
    //     $this->validate(request(),[
    //         'name'=>'required',
    //         'history'=>'required',
            
    //     ]);
    //        $id=$request->id;
    //        $row=Author::find($id);
    //        $row->name=request('name');
    //        $row->history=request('history');
    //        $row->description=request('description');
    //        $row->save();
    //         return redirect('authorList');
    // }


     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function delete($id)
    // {
    //     $result = Author::find($id);
    //     $result->deleted_user_id = auth()->id();
    //     $result->deleted_at = now();
    //     $result->save();
    //     return redirect('authorList');  
    // }

}
