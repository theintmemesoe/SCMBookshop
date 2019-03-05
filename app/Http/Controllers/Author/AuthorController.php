<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Contracts\Services\AuthorServiceInterface;
use App\Author;
use Auth;
use App\User;
use Log;
use DB;


class AuthorController extends Controller
{
    private $authorService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function _construct(AuthorServiceInterface $authorService)
    {
        $this->authorService=$authorService;
    }

    public function getAuthor()
    {
        $aut=Author::paginate(3);
        // $aut=Author::all();
        return view("authorList")->with(['aut'=>$aut]);
    }

    public function addAuthor(Request $request)
    {
        $name = $request['name'];
        $history = $request['history'];
        $description = $request['description'];
        //check validation
        $validator = Validator::make($request->all(), [
          'name' => 'required',
          'history' => 'required',
          'description' => 'required',
      ]);
      $aut = new Author();
      $aut->name=$name;
      $aut->history=$history;
      $aut->description=$description;
      $aut->create_user_id=1;
      $aut->updated_user_id=1;
      $aut->save();
      return redirect('authorList');
    }

    public function edit(Author $autEdit_id)
    {
        $aut=Author::all();
        return view('editAuthor',compact('aut','autEdit_id'));
    }

    public function update(Request $request)
    {
        //validate
        $this->validate(request(),[
            'name'=>'required',
            'history'=>'required',
            
        ]);
           $id=$request->id;
           $row=Author::find($id);
           $row->name=request('name');
           $row->history=request('history');
           $row->description=request('description');
           $row->save();
            return redirect('authorList');
    }

    public function delete($id)
    {
        // $result = Author::find($id)->delete(); 
        // return redirect('authorList');
        $result = Author::find($id);
        $result->deleted_user_id = auth()->id();
        $result->deleted_at = now();
        $result->save();
        return redirect('authorList');  
    }

    public function search(Request $request){
        $name=$request->name;
        $aut=Author::where('name','like','%'.$name.'%')->get();
        return view("authorList")->with(['aut'=>$aut]);
    }

}
