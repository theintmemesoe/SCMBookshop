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
use App\Genre;
use App\Author;
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
        $genre = Genre::all();
        $author = Author::all();
        // $genre = Genre::OrderBy('id','desc')->get();
        // $author = Author::OrderBy('id','desc')->get();
        $name = Input::get ( 'name' );
        if(count($name) > 0){
            $book =$this->bookService->searchBook($name);
            return view('book.bookList')->with('book', $book)->with(['author'=>$author])->with(['genre'=>$genre]);
        }
        elseif(count($name)==null){
            $book = $this->bookService->bookList();
            return view('book.bookList')->with('book', $book)->with(['author'=>$author])->with(['genre'=>$genre]);
        }
        else
            return view('book.bookList')->withMessage('No Details found. Try to search again !'); 
    }

    // public function search(Request $request)
    // {
    //     $name=$request['name'];
    //     Author::where('name','LIKE','%'.$name.'%' )->get();
    //     return redirect('book/bookList');
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param Request $request
     * @return \App\Author
     */
    public function addBook(Request $request)
    {
        //check validation
        $validator = Validator::make($request->all(), [
          'name' => 'required|unique:books',
          'price' => 'required',
          'author_id' => 'required',
          'genre_id' => 'required',
          'image' => 'required|mimes:jpg,png',
          'sample_pdf' => 'required|mines:pdf',
          'published_date' => 'required',
          'description' => 'required',
      ]);
      $this->bookService->addBook($request);
      return redirect('book/bookList');
    }

    public function getImage($file_name)
    {
        return $this->bookService->getFile($file_name);
    
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $bookEdit_id
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
    public function update(Request $request)
    {          
           $this->bookService->update($request);
            return redirect('book/bookList');
    }


     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $this->bookService->delete($id);
        return redirect('book/bookList');  
    }

}
