<?php

namespace App\Http\Controllers\Book;

use App\Author;
use App\Book;
use App\Contracts\Services\BookServiceInterface;
use App\Genre;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Log;

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
     *Call new book page
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function callBookList()
    {
        $genre = Genre::all();
        $author = Author::all();
        $book = Book::all();
        return view('book.addBook')->with('book', $book)->with(['author' => $author])->with(['genre' => $genre]);
    }

    /**
     * call book list
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function getBook()
    {
        $name = Input::get('name');
        $aname = Input::get('aname');
        $gname = Input::get('gname');
        $data = array($name, $aname, $gname);
        $genre = $this->bookService->getGenreList();
        $author = $this->bookService->getAuthorList();
        $book = Book::all();
        if (count($data[0]) != null || count($data[1]) != null || count($data[2]) != null) {
            $book = $this->bookService->searchBook($data);
            return view('book.bookList')->with('book', $book)->with(['author' => $author])->with(['genre' => $genre]);
        } elseif ($data[0] == null || $data[1] == null || $data[2] == null) {
            $book = $this->bookService->bookList();
            return view('book.bookList')->with('book', $book)->with(['author' => $author])->with(['genre' => $genre]);
        } else {
            return view('book.bookList')->withMessage('No Details found. Try to search again !');
        }

    }

    /**
     * Create a new book
     *
     * @param Request $request
     * @return \App\Book
     */
    public function addBook(Request $request)
    {
        //check validation
        $this->validate($request, [
            'name' => 'required|unique:books',
            'price' => 'required',
            'author_id' => 'required',
            'genre_id' => 'required',
            'image' => 'required',
            'sample_pdf' => 'required',
            'published_date' => 'required',
        ]);
        $this->bookService->addBook($request);
        return redirect('book/bookList');
    }

    /**
     *get image file name
     * @param $file_name
     * @return \App\Book
     */
    public function getImage($file_name)
    {
        return $this->bookService->getFile($file_name);
    }

    /**
     * create edit book
     *
     * @param  int  $bookEdit_id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $bookEdit_id)
    {
        $book = Book::all();
        return view('book.editBook', compact('book', 'bookEdit_id'));
    }

    /**
     * create update book
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
     * create remove book
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $this->bookService->delete($id);
        return redirect('book/bookList');
    }

    /**
     * get CSV
     *
     * @param $read_file,$delimiter
     * @return \Illuminate\Http\Response
     */
    public function getCSVBook($read_file, $delimiter)
    {
        $this->bookService->getCSVBook($read_file, $delimiter);
    }

    /**
     *upload csv
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function uploadCSV(Request $request)
    {

        $file = $request->file('file');

        // File Details
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tempPath = $file->getRealPath();
        $fileSize = $file->getSize();
        $mimeType = $file->getMimeType();

        // Valid File Extensions
        $valid_extension = array("csv");

        // 2MB in Bytes
        $maxFileSize = 2097152;

        // Check file extension
        if (in_array(strtolower($extension), $valid_extension)) {

            // Check file size
            if ($fileSize <= $maxFileSize) {

                // File upload location
                $location = 'uploads';

                // Upload file
                $file->move($location, $filename);

                // Import CSV to Database
                $filepath = public_path($location . "/" . $filename);

                // Reading file
                $file = fopen($filepath, "r");

                $importData_arr = array();
                $i = 0;
                $u = 1;

                while (($filedata = fgetcsv($file, 1000, ",")) !== false) {
                    $num = count($filedata);

                    // Skip first row (Remove below comment if you want to skip the first row)
                    if ($i == 0) {
                        $i++;
                        continue;
                    }
                    for ($c = 0; $c < $num; $c++) {
                        $importData_arr[$i][] = $filedata[$c];
                    }
                    $i++;
                }

                fclose($file);
                Log::info($importData_arr);

                $this->bookService->getUploadCSV($importData_arr);
            }
        }
        return redirect('book/bookList');
    }

    /**
     *get book detail
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function getBookDetail($id)
    {
        $book = Book::where('id', $id)->first();
        return view('book.bookDetail')->with(['book' => $book]);
    }

    /**
     *download csv
     * @param
     * @return \Illuminate\Http\Response
     */
    public function downloadCSV()
    {
        $book = $this->bookService->downloadCSV();
        $record = 0;
        if (count($book) > 0) {
            $record = 1;

            $CsvData = array('ID,Book Name,Author Name,Gener Name,Image,Sample PDF,Published Date,Description');
            foreach ($book as $value) {
                $CsvData[] = $value->id . ',' . $value->name . ',' . $value->author_id . ',' . $value->genre_id . ',' . $value->image . ',' . $value->sample_pdf . ',' . $value->published_date . ',' . $value->description;
            }

            $filename = "book.csv";
            $file_path = base_path() . '/' . $filename;
            $file = fopen($file_path, "w+");
            foreach ($CsvData as $exp_data) {
                fputcsv($file, explode(',', $exp_data));
            }
            fclose($file);

            $headers = ['Content-Type' => 'application/csv'];
            return response()->download($file_path, $filename, $headers);
        }
        return view('download', ['record_found' => $record]);
    }

}
