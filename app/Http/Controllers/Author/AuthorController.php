<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Contracts\Services\AuthorServiceInterface;
use App\Author;
use Illuminate\Support\Facades\Input;
use lluminate\Pagination\Paginator;
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
        $this->authorService = $authorService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getAuthor(Request $request)
    {

        $name=$request->name;
        if(count($name) > 0){
            $aut= DB::table('authors')->where('deleted_at', NULL)->where('name','LIKE','%'.$name.'%' )->paginate(1);
            return view('authorList')->with(['aut'=>$aut]);
        }
        elseif(count($name)==null){
            $aut=DB::table('authors')->where('deleted_at',NULL)->paginate(2);
            return view('authorList')->with(['aut'=>$aut]);
        }
        else
            return view('authorList')->withMessage('No Details found. Try to search again !');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param Request $request
     * @return \App\Author
     */
    public function addAuthor(Request $request)
    {
    //     $name = $request['name'];
    //     $history = $request['history'];
    //     $description = $request['description'];
    //     //check validation
    //     $validator = Validator::make($request->all(), [
    //       'name' => 'required|unique:authors',
    //       'history' => 'required',
    //       'description' => 'required',
    //   ]);
    //   $aut = new Author();
    //   $aut->name=$name;
    //   $aut->history=$history;
    //   $aut->description=$description;
    //   $aut->create_user_id=1;
    //   $aut->updated_user_id=1;
    //   $aut->save();
    //   return redirect('authorList');
    Log::info($request);
      return $this->authorService->addAuthor(); 
      
    //   return redirect('authorList');
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $autEdit_id
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $autEdit_id)
    {
        $aut=Author::all();
        return view('editAuthor',compact('aut','autEdit_id'));
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


     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $result = Author::find($id);
        $result->deleted_user_id = auth()->id();
        $result->deleted_at = now();
        $result->save();
        return redirect('authorList');  
    }

}
