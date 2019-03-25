<?php

namespace App\Http\Controllers\Author;

use App\Author;
use App\Contracts\Services\AuthorServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class AuthorController extends Controller
{
    private $authorService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AuthorServiceInterface $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function getAuthor()
    {
        $name = Input::get('name');
        if (count($name) > 0) {
            $aut = $this->authorService->searchAuthor($name);
            return view('author.authorList')->with('aut', $aut);
        } elseif (count($name) == null) {
            $aut = $this->authorService->authorList();
            return view('author.authorList')->with('aut', $aut);
        } else {
            return view('author.authorList')->withMessage('No Details found. Try to search again !');
        }

    }

    /**
     * Create a new author
     *
     * @param Request $request
     * @return \App\Author
     */
    public function addAuthor(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:authors',
            'history' => 'required',
            'description' => 'required',
        ]);
        $this->authorService->addAuthor($request);
        return redirect('author/authorList');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $autEdit_id
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $autEdit_id)
    {
        $aut = $this->authorService->edit();
        return view('author.editAuthor', compact('aut', 'autEdit_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //validate
        $this->validate(request(), [
            'name' => 'required',
            'history' => 'required',

        ]);
        $this->authorService->update($request);
        return redirect('author/authorList');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $this->authorService->delete($id);
        return redirect('author/authorList');
    }

}
