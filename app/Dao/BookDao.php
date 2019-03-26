<?php

namespace App\Dao;

use App\Author;
use App\Book;
use App\Contracts\Dao\BookDaoInterface;
use App\Genre;
use App\User;
use Auth;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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

        $image_name = $request['name'] . '.' . $request->file('image')->getClientOriginalExtension();
        $image_file = $request->file('image');

        $sample_pdf_name = $request['name'] . '.' . $request->file('sample_pdf')->getClientOriginalExtension();
        $sample_pdf_file = $request->file('sample_pdf');

        $published_date = $request['published_date'];
        $description = $request['description'];
        $book = new Book();
        $book->name = $name;
        $book->price = $price;
        $book->author_id = $author_id;
        $book->genre_id = $genre_id;
        $book->image = $image_name;
        $book->sample_pdf = $sample_pdf_name;
        $book->published_date = $published_date;
        $book->description = $description;
        $book->create_user_id = Auth::user()->id;
        $book->updated_user_id = Auth::user()->id;
        $book->save();
        $image_file->move(public_path('books/' . $book->id), $image_name);
        $sample_pdf_file->move(public_path('books/' . $book->id), $sample_pdf_name);
    }

    /**
     * Get image
     * @param $file_name
     * @return
     */
    public function getImage($file_name)
    {
        $file = Storage::disk('public')->get($file_name);
        return response($file, 200)->header('Content-type', 'jpg/png');
    }

    /**
     * Get pdf
     * @param $file_name
     * @return
     */
    public function getPDF($file_name)
    {
        $file = Storage::disk('public')->get($file_name);
        return response($file, 200)->header('Content-type', 'pdf');
    }

    /**
     * Get search book
     * @param $data
     * @return
     */
    public function searchBook(array $data)
    {
        $name = $data[0];
        $aname = $data[1];
        $gname = $data[2];
        return Book::whereNull('deleted_at')
            ->where('name', 'LIKE', '%' . $name . '%')
            ->where('author_id', 'LIKE', '%' . $aname . '%')
            ->where('genre_id', 'LIKE', '%' . $gname . '%')
            ->paginate(Config::get('constants.pagination.paginate'));
    }

    /**
     * Get Book List
     * @param
     * @return
     */
    public function bookList()
    {
        return $book = Book::where('deleted_at', null)->paginate(Config::get('constants.pagination.paginate'));
    }

    /**
     * Get Book List
     * @param
     * @return
     */
    public function getBookList()
    {
        return Book::get();
    }

    /**
     * Get Book List
     * @param
     * @return
     */
    public function getAuthorList()
    {
        return Author::get();
    }

    /**
     * Get Book List
     * @param
     * @return
     */
    public function getGenreList()
    {
        return Genre::get();
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
     * @param Request $request
     * @return
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $row = Book::find($id);
        $image_file = $request->file('image');
        $sample_pdf_file = $request->file('sample_pdf');

        if ($image_file && $sample_pdf_file) {
            $image_name = $request['name'] . '.' . $request->file('image')->getClientOriginalExtension();
            $sample_pdf_name = $request['name'] . '.' . $request->file('sample_pdf')->getClientOriginalExtension();
            $row->name = request('name');
            $row->price = request('price');
            $row->author_id = request('author_id');
            $row->genre_id = request('genre_id');
            $row->image = $image_name;
            $row->sample_pdf = $sample_pdf_name;
            $image_file->move(public_path('books/' . $row->id), $image_name);
            $sample_pdf_file->move(public_path('books/' . $row->id), $sample_pdf_name);
            $row->published_date = request('published_date');
            $row->description = request('description');
        } else {
            $row->name = request('name');
            $row->price = request('price');
            $row->author_id = request('author_id');
            $row->genre_id = request('genre_id');
            $row->published_date = request('published_date');
            $row->description = request('description');
        }
        $row->save();
    }

    /**
     * Get Book List
     * @param $id
     * @return
     */
    public function delete($id)
    {
        $result = Book::find($id);
        $result->deleted_user_id = auth()->id();
        $result->deleted_at = now();
        $result->save();
        if ($result) {
            echo "<div class='alert alert-success'>delete success</div>";
        }

    }

    /**
     * Get uploacsv
     * @param
     * @return
     */
    public function downloadCSV()
    {
        return Book::select('id', 'name', 'author_id', 'genre_id', 'image', 'sample_pdf', 'published_date', 'description')->get();
    }

}
