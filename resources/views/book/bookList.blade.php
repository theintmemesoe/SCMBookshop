@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    <div class="col-md-4">

         <form action="/searchBook" method="post" enctype="multipart/form-data">

                    <div class="form-group row">
                        <div class="col-md-6">
                        <select name="aname" id="aname" class="form-control">
                        <option value=""></option>
                        @foreach($author as $ans)
                            <option>{{$ans->name}}</option>
                            @endforeach          
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                        <select name="gname" id="gname" class="form-control">
                        <option value=""></option>
                        @foreach($genre as $ans)
                            <option>{{$ans->name}}</option>
                            @endforeach            
                        </select>
                        </div>
                    </div>

                  <div class="form-group">
                      <div class="col-md-6">
                      <input id="name" type="text" class="form-control" name="name" placeholder="name" autofocus>
                      </div>
                  </div>  
                  <div class="form-group">
                      <div class="col-md-6">
                      <button type="submit" class="btn btn-primary btn-block">Search</button>
                      </div>
                  </div>   
              {{csrf_field()}}
         </form>   
             
        <div class="form-group">
            <div class="col-md-6">
            <a class="btn btn-primary btn-block" href="/addBook"> Add</a>            
            </div>
        </div>   
        <div class="form-group">
            <div class="col-md-6">
                <button type="submit" class="btn btn-info btn-block">Upload</button>
            </div>
        </div> 
        <div class="form-group">
            <div class="col-md-6">
                <button type="submit" class="btn btn-info btn-block">Download</button>
            </div>
        </div>                         
    </div>
 
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Book List') }}</div>
                <div class="card-body">
                <table class="table" id="myTable">
                <thead>
                <tr>
                    <td>Book Name</td>
                    <td>Author Name</td>
                    <td>Genre Name</td>
                    <td>Price</td>
                    <td>Sample PDF</td>
                    <td>Cart</td>
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>
                </thead>
                @foreach($book as $row)
                    <tr>
                        <td>{{$row->name}}</td>
                        <td>{{$row->author->name}}</td>
                        <td>{{$row->genre->name}}</td>
                        <td>{{$row->price}}</td>
                        <td><a href="#">{{$row->sample_pdf}}</a></td>
                        <td><a href="#">Add to cart</a></td>
                        <td><a href="/book/editBook/{{ $row->id }}">Edit</a></td>
                        <td><a href="/book/deleteBook/{{ $row->id }}">delete</a></td>
                    </tr>
                    @endforeach
                 
                </tbody>
             
                </table>
                
                </div>
            </div>
          {{$book->links()}}
        </div>
    </div>
 
</div>


@endsection
